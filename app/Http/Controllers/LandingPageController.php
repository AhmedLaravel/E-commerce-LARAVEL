<?php

namespace App\Http\Controllers;
use \App\Models\Products;
use \App\Models\TradeMarks;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $recently = session('productss.recently_viewed');
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
            //return $best_selling;
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
            //return $best_selling;
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
                if(sizeof($best_selling_final) > 2){
                    $best_selling_final = [$best_selling_final[sizeof($best_selling_final)-1],$best_selling_final[sizeof($best_selling_final)-2],$best_selling_final[sizeof($best_selling_final)-3]];
                }
                // $recent = best_sellingViews::orderBy('id','desc')->get();
                $best_selling_products = Products::whereIn('id',$best_selling_final)->latest()->take(3)->get();
            }
            $recentProducts = [];
            if(!empty($recently)){

                // return $recently;
                // $recenltyViews = RecentlyViews::create(['key'=>$recently]);
                if(sizeof($recently) > 2){
                    $recently = [$recently[sizeof($recently)-1],$recently[sizeof($recently)-2],$recently[sizeof($recently)-3]];
                }
                // $recent = RecentlyViews::orderBy('id','desc')->get();
                $recentProducts = Products::whereIn('id',$recently)->latest()->take(3)->get();
            }
       $productNew = Products::orderBy('id','desc')->take(8)->get();
       $new = Products::orderBy('id','desc')->take(3)->get();
       $trads = TradeMarks::inRandomOrder()->get();
       return view('style.home',['newProducts'=> $productNew, 'trads'=>$trads,'recents'=>$recentProducts,'newests'=>$new,'best_selling_products' => $best_selling_products]);
    }
}
