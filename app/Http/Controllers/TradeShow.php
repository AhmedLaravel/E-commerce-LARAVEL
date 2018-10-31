<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\TradeMarks;

class TradeShow extends Controller
{
    public function showTrade(){
    	$title = trans('admin.trademarks');
    	$trades = TradeMarks::inRandomOrder()->get();
    	return view('style.tradeShowPage',['trades'=>$trades, 'title'=>$title]);
    }
}
