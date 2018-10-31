<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Products;
use \App\Models\Department;
use \App\Models\TradeMarks;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::orderBy('id','desc')->get();
        return view('style.shop',['products'=>$products]);
    }
    public function show($id)
    {
        session()->push('productss.recently_viewed', $id);
        $product = Products::where('id',$id)->firstOrFail();
        $recent = Products::orderBy('id', 'desc')->take(5)->get();
        $departmentId = Department::where('id',$product->parent)->firstOrFail()->id;
        $department = session('lang') == 'ar'? Department::where('id',$product->parent)->firstOrFail()->dep_name_ar:Department::where('id',$product->parent)->firstOrFail()->dep_name_en;
        $products = Products::inRandomOrder()->take(5)->get();
        $related = products::where('brand',$product->brand)->inRandomOrder()->take(7)->get();
        return view('style.singleProduct',['product'=>$product, 'related'=>$related,'department'=>$department,'products'=>$products,'recent'=>$recent,'departmentId'=>$departmentId]);
    }
    public function showTradeProducts($id){
        $title = trans('admin.trademark_products');
        $prod = Products::where('brand',$id)->get();
        $tradname = session('lang') == 'ar'? TradeMarks::find($id)->name_ar:TradeMarks::find($id)->name_en;
        return view('style.tradeProdPage',['prod'=>$prod ,'title'=>$title,'tradname'=>$tradname]);
    }

  
}

