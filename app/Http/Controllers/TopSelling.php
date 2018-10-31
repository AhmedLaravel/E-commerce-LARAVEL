<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;

class TopSelling extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('admin.top_selling');
         $best_selling_1 = session('products.best_selling');
           // return $best_selling;
            $best_selling = [];
            for ($i=0; $i < sizeof($best_selling_1) ; $i++) { 
                $best_selling[$i] = $best_selling_1[$i][0];
            }
            $best_selling_count = [];
            for($i = 0;$i < sizeof($best_selling); $i++){
                $best_selling_count[$i] = count(array_keys($best_selling, $best_selling[$i]));
                // echo $best_selling_count[$i];
            }
            // return $best_selling;
            // return $best_selling_count;
            for ($k=0; $k <sizeof($best_selling) ; $k++) { 
                for ($i=0; $i <sizeof($best_selling); $i++) {
                    $temp1 = $best_selling_count[$i];                
                    for ($j=0; $j <sizeof($best_selling); $j++) { 
                        if($temp1 > $best_selling_count[$j]){
                            $temp2 = $best_selling_count[$i];
                            $best_selling_count[$i] = $best_selling_count[$j];
                            $best_selling_count[$j] = $temp2; 
                            $temp = $best_selling[$j];
                            $best_selling[$j] = $best_selling[$i];
                            $best_selling[$i] = $temp;
                            break;
                        }
                    }
                }
            }
            for($i = 0;$i < sizeof($best_selling); $i++){
                $best_selling_count[$i] = count(array_keys($best_selling, $best_selling[$i]));
                // echo $best_selling_count[$i];
            }
            // return $best_selling;
            $best_selling_final = [];
            for ($i=0; $i <sizeof($best_selling) ; $i++) { 
                $id = $best_selling[$i];
                for ($j=0; $j <sizeof($best_selling); $j+=$best_selling_count[$i]) { 
                    if($id ==$best_selling[$j] and $i == $j){
                        array_push($best_selling_final, $id);
                    }
                }
            }
            $best_selling_products = [];
            if(!empty($best_selling_final)){
                // $recent = best_sellingViews::orderBy('id','desc')->get();
                $best_selling_products = Products::whereIn('id',$best_selling_final)->latest()->take(20)->get();
            }
        return view('style.top_selling',['best_selling_products'=>$best_selling_products,'title'=>$title]);
        
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
    public function store(Request $request)
    {
        //
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
