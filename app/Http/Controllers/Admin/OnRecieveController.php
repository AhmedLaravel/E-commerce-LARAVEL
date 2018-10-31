<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\OnRecieveDataTables;
use Illuminate\Http\Request;
use Validator;
use Cart;
use App\OnRecieve;
class OnRecieveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OnRecieveDataTables $OnRecieveDataTables)
    {
        return $OnRecieveDataTables->render('admin.recieve.index', ['title'=>trans('admin.recieve')]);
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
        $rule = [
            'billing_country' => 'required',
            'billing_first_name' => 'required',
            'billing_email' =>'required|email',
            'billing_company' =>'required',
            'billing_address_1' =>'required',
            'billing_city' =>'required',
            'billing_address_2' =>'required',
            'billing_state' =>'required',
            'billing_postcode' =>'required',
            'billing_phone' =>'required',
            'cart_content' =>'sometimes|nullable',
            'total' =>'sometimes|nullable',
            'currency' =>'sometimes|nullable',
        ];
        $niceName = [
            'billing_first_name' => trans('admin.nam_user'),
            'billing_country' => trans('admin.country'),
            'billing_company' => trans('admin.company'),
            'billing_email' => trans('admin.email'),
            'billing_address_1' => trans('admin.address1'),
            'billing_address_2' => trans('admin.address2'),
            'billing_city' => trans('admin.city'),
            'billing_state' => trans('admin.state'),
            'billing_postcode' => trans('admin.Postal_code'),
            'billing_phone' => trans('admin.phone'),
            'cart_content' => trans('admin.cart'),
            'total' => trans('admin.total'),
            'currency' => trans('admin.currency'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $content = '';
        $tot = 0;
        foreach (Cart::content() as $cart) {
            $content = $content.$cart->model->name_en." ->".$cart->qty.", ";
            $tot = $tot + $cart->price;
        }
        $data['cart_content'] = $content;
        $data['total'] = $tot;
        $data['currency'] = session('currc');
        foreach (Cart::instance('default')->content() as $item) {
            session()->push('products.best_selling',$item->id);
        }
       OnRecieve::create($data);
       Cart::destroy();
        session()->flash('message', trans('admin.success_data_recieve'));
        return redirect('cart');
    }
    /*








*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = trans('admin.recieved');
       $recieve = OnRecieve::find($id);
       return view('admin.recieve.show',['title'=>$title,'recieve'=>$recieve]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recieve =OnRecieve::find($id);
        $recieve->delete();
        session()->flash('message', trans('admin.success_delete_one_recieve'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $recieve =OnRecieve::find($id);
            $recieve->delete();
           }
        }else{
            $recieve =OnRecieve::find(request('item'));
            $recieve->delete();
        }
        session()->flash('message', trans('admin.success_delete_recieve'));
        return back();
    }
}
