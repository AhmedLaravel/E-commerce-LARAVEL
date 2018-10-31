<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTables $adminDataTable)
    {
        return $adminDataTable->render('admin.admins.index', ['title'=>trans('admin.Admin_Control')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_admin');
        return view('admin.admins.create',['title'=>$title]);
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
            'name' => 'required|min:4',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6',
        ];
        $niceName = [
            'name' => trans('admin.nam'),
            'email' => trans('admin.email'),
            'password' => trans('admin.pass'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $data['password'] = bcrypt(request('password'));
        Admin::create($data);
        session()->flash('message', trans('admin.success_data'));
        return redirect(aurl('admin'));
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
        $admin = Admin::find($id);
        $title = trans('admin.edit_admin');
        return view('admin.admins.edit', ['admin'=>$admin, 'title' => $title]);
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
         $rule = [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'required|confirmed|min:6',
        ];
        $niceName = [
            'name' => trans('admin.nam'),
            'email' => trans('admin.email'),
            'password' => trans('admin.pass'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $data['password'] = bcrypt(request('password'));
        Admin::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated'));
        return redirect(aurl('admin'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        session()->flash('message', trans('admin.success_delete_one'));
        return redirect(aurl('admin'));
    }
    public function multi_delete(){
        if(is_array(request('item'))){
            Admin::destroy(request('item'));
        }else{
            Admin::find(request('item'))->delete();
        }
        session()->flash('message', trans('admin.success_delete'));
        return redirect(aurl('admin'));
    }
}
