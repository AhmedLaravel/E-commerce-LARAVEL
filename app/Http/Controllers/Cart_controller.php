<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;
use Cart;
use Validator;

class Cart_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('admin.cart');
        $products = Products::inRandomOrder()->take(5)->get();
        $related = products::inRandomOrder()->take(7)->get();
        $subtotal = 0;
        $total = 0;
        $tax = 0;
        foreach (Cart::content() as $item) {
            $prod = Products::find($item->id);
            $subtotal += ($prod->price - ($prod->price*$prod->discount)/100)*$item->qty;
            $total += (($prod->price - ($prod->price*$prod->discount)/100)+$prod->shipping_cost)*$item->qty;
            $tax += ($prod->shipping_cost *$item->qty );
        }
        return view('style.cart',['title'=>$title, 'related'=>$related, 'products'=>$products,'subtotal'=>$subtotal,'total'=>$total,'tax' =>$tax]);
    }
    public function callback(){
        foreach (Cart::instance('default')->content() as $item) {
            session()->push('products.best_selling',$item->id);
        }
        $hashSecretWord = 'NjczMTQ4NTMtZWY4Mi00Y2M5LTk4NWQtYjY4M2FkNGI2ZThh'; //2Checkout Secret Word
        $hashSid = 901394211; //2Checkout account number
        $hashTotal = $_REQUEST['total']; //Sale total to validate against
        $hashOrder = $_REQUEST['order_number']; //2Checkout Order Number
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));

        if ($StringToHash != $_REQUEST['key']) {
            $result = 'Fail - Hash Mismatch';
            session()->flash('message',trans('admin.fail_checkout'));
            return redirect('cart'); 
            } else { 
                Cart::destroy();
                session()->flash('message',trans('admin.success_checkout'));
                return redirect(url('cart'));
            }

        echo $result;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $alreadyExist = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });
        if($alreadyExist->isNotEmpty()){
            session()->put('userMessage', trans('admin.already_exist'));
            return redirect('cart');
        }
        $prod = Products::find($request->id);
        // $data = Cart::add($request->id, $request->name, 1, $request->price,['size'=>$prod->model])
        $data = Cart::add(['id' => $request->id, 'name' => $request->name, 'qty' => 1, 'price' =>$request->price, 'options' => ['size' => $prod->model,'color'=>$prod->color_name_en]])
        ->associate('App\Models\Products');
        if(Cart::instance('saveForLater')->content()->has($data->rowId)){ 

            if(!empty(Cart::instance('saveForLater')->get($data->rowId))){
                Cart::instance('saveForLater')->remove($data->rowId);
            }
        }
        session()->put('userMessage', trans('admin.success_add_to_car'));
        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $rules = [
            'itemQuantity'=>'required',
            'itemModel'=>'required',
            'itemColor'=>'required',
        ];
        $nice = [
            'itemColor'=>trans('admin.color'),
            'itemModel'=>trans('admin.model'),
            'itemQuantity'=>trans('admin.quantity'),
        ];
        $data = $this->validate(request(),$rules,[],$nice);
        $cont = Cart::get($rowId);
        $prod = Products::find($cont->id);
        Cart::update($rowId, [ 'qty' => $data['itemQuantity'], 'options' => ['size' => $data['itemModel'],'color'=>$data['itemColor']]]);
        session()->flash('message',trans('admin.success_update_cart'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        session()->put('userMessage',trans('admin.success_delete_item'));
        return redirect('cart');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeSaved($id)
    {
        Cart::instance('saveForLater')->remove($id);
        session()->put('userMessage',trans('admin.success_delete_item_from_saved'));
        return redirect('cart');
    }
    /**
     * Save For Later In The Cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveForLater($id)
    {
        $item = Cart::get($id);
        Cart::remove($id);
        $prod = Products::find($item->id);
        // Cart::instance('saveForLater')->add($item->id, $item->name,1,$item->price);
        Cart::instance('saveForLater')->add(['id' => $item->id, 'name' => $item->name, 'qty' => 1, 'price' =>$item->price, 'options' => ['size' => $prod->model,'color'=>$prod->color_name_en]]);
        session()->put('userMessage',trans('admin.savedForLater'));
        return redirect('cart');
    }
}
