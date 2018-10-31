<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;
use Stripe;
use Cart;
use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('admin.checkoutTitle');
        $products = Products::inRandomOrder()->take(5)->get();
        $recent = Products::orderBy('id', 'desc')->take(5)->get();
        $related = products::inRandomOrder()->take(7)->get();
        $total = 0;
        foreach (Cart::content() as $item) {
            $prod = Products::find($item->id);
            $total += (($prod->price - ($prod->price*$prod->discount)/100)+$prod->shipping_cost)*$item->qty;
        }
        return view('style.checkout',['title'=>$title,'products' =>$products, 'total'=>$total ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        if(Cart::instance('default')->count() > 0){

            $contents = Cart::content()->map(function($item){
                return $item->name. ', '.$item->qty;
            })->values()->toJson();
            try {
                $charge = Stripe::charges()->create([
                    'amount' => Cart::total(),
                    'currency' => session('currc'),
                    'source' => $request->stripeToken,
                    'description' => 'Order',
                    'reciept_email' => $request->email,
                    'metadata'=>[
                        'content' => $contents,
                        'quantity' => Cart::instance('default')->count(),
                    ],
                ]);
                $best_selling = [];
                foreach (Cart::instance('default')->content() as $item) {
                    session()->push('products.best_selling',$item->id);
                }
                // session()->put('best_selling',$best_selling);
                Cart::instance('default')->destroy();
                session()->flash('message',trans('admin.success_checkout'));

                return back();
                
            } catch (CardErrorException $e) {
                return back()->withErrors('Error!! '.$e->getMessage()); 
            }
        }else{
            session()->flash('message',trans('admin.empty_cart'));
            return back();
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
