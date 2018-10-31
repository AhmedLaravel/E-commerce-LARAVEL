<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\contactDataTable;
use Illuminate\Http\Request;
use Validator;
use App\Contact;
class Contact_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(contactDataTable $contactDataTable)
    {
        return $contactDataTable->render('admin.contact.index', ['title'=>trans('admin.contact')]);
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
       //  $rule = [
       //      'name' => 'required',
       //      'email' => 'required|email',
       //      'subject' =>'required',
       //      'message' =>'required',
       //  ];
       //  $niceName = [
       //      'name' => trans('admin.nam_user'),
       //      'subject' => trans('admin.subject'),
       //      'message' => trans('admin.message'),
       //      'email' => trans('admin.email'),
       //  ];
       //  $data = $this->validate(request(),$rule,[],$niceName);
        
       // Contact::create($data);
       //  session()->flash('message', trans('admin.success_contact'));
       //  return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = trans('admin.contact');
       $contact = Contact::find($id);
       return view('admin.contact.show',['title'=>$title,'contact'=>$contact]);
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
        $contact =Contact::find($id);
        $contact->delete();
        session()->flash('message', trans('admin.success_delete_one_contact'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $contact =Contact::find($id);
            $contact->delete();
           }
        }else{
            $contact =Contact::find(request('item'));
            $contact->delete();
        }
        session()->flash('message', trans('admin.success_delete_contact'));
        return back();
    }
}
