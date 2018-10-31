<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ReviewsDataTable;
use Illuminate\Http\Request;
use Validator;
use App\Review;
class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReviewsDataTable $ReviewsDataTable)
    {
        return $ReviewsDataTable->render('admin.review.index', ['title'=>trans('admin.review')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_review');
        return view('admin.review.create',['title'=>$title]);
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
            'name' => 'required',
            'review' => 'required',
            'rate' =>'required',
            'email' =>'required|email',
        ];
        $niceName = [
            'name' => trans('admin.user_name'),
            'review' => trans('admin.review'),
            'rate' => trans('admin.ur_rate'),
            'email' => trans('admin.email'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        
       Review::create($data);
        session()->flash('message', trans('admin.success_data_review'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = trans('admin.review');
       $review = Review::find($id);
       return view('admin.review.show',['title'=>$title,'review'=>$review]);
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
        $review =Review::find($id);
        $review->delete();
        session()->flash('message', trans('admin.success_delete_one_reviews'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $review =Review::find($id);
            $review->delete();
           }
        }else{
            $review =Review::find(request('item'));
            $review->delete();
        }
        session()->flash('message', trans('admin.success_delete_review'));
        return back();
    }
}
