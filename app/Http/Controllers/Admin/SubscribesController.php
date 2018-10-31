<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\SubscribeDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Subscribe;
use Mail;
use App\Mail\SubscribersMail;
use App\Jobs\SubscribeMails;
use Storage;
class SubscribesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscribeDataTables $subscribeDataTables)
    {
        return $subscribeDataTables->render('admin.subscribe.index', ['title'=>trans('admin.subscribe')]);
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
            'email' => 'required|email',
            'name' => 'sometimes|nullable',
        ];
        $niceName = [
            'email' => trans('admin.email'),
            'name' => trans('admin.nam_user'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(auth()->guard('user')->user()){   
            $data['name'] = auth()->guard('user')->user()->name;
        }else{
            $data['name'] = trans('admin.not_user');
        }
        
       Subscribe::create($data);
        session()->flash('message', trans('admin.success_data_subscribe'));
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
        //
    }

    /////////////////////Email The Subscribers /////////////////////
    public function email_get(){
        $title = trans('admin.email');
        return view('admin.subscribe.email',['title' => $title]);
    }

    /////////////////////Email The Subscribers /////////////////////
    

    /////////////////////Email The Subscribers /////////////////////
    public function email_post(){
        $subs = Subscribe::inRandomOrder()->get();
        foreach ($subs as $sub) {
            $data['name'] = $sub->name;
            $data['message'] = request('mail');
            $jopOp =  new \App\Jobs\SubscribeMails($data,$sub->email);
            $jop = $jopOp;
            dispatch($jop);
        }
        /*foreach ($subs as $sub) {
            $data['name'] = $sub->name;
            $data['message'] = request('mail');
            Mail::to($sub->email)->send(new SubscribersMail($data));

        }*/
        session()->flash('message',trans('admin.message_sent_successfuly'));
        return back();
    }
    /////////////////////Email The Subscribers /////////////////////

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
        $subscibe =Subscribe::find($id);
        $subscibe->delete();
        session()->flash('message', trans('admin.success_delete_one_subscribe'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $subscibe =Subscribe::find($id);
            $subscibe->delete();
           }
        }else{
            $subscibe =Subscribe::find(request('item'));
            $subscibe->delete();
        }
        session()->flash('message', trans('admin.success_delete_subscribe'));
        return back();
    }
}
