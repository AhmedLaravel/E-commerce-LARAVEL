<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDataTables;
use Illuminate\Http\Request;
use Validator;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTables $adminDataTable)
    {
        return $adminDataTable->render('admin.users.index', ['title'=>trans('admin.users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_user');
        return view('admin.users.create',['title'=>$title]);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
        $niceName = [
            'name' => trans('admin.nam_user'),
            'email' => trans('admin.email_user'),
            'password' => trans('admin.pass_user'),
            
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $data['password'] = bcrypt(request('password'));
        User::create($data);
        session()->flash('message', trans('admin.success_data_user'));
        return redirect(aurl('users'));
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
        $admin = User::find($id);
        $title = trans('admin.edit_user');
        return view('admin.users.edit', ['user'=>$admin, 'title' => $title]);
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
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|confirmed|min:6',
        ];
        $niceName = [
            'name' => trans('admin.nam'),
            'email' => trans('admin.email'),
            'password' => trans('admin.pass'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        $data['password'] = bcrypt(request('password'));
        User::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_user'));
        return redirect(aurl('users'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('message', trans('admin.success_delete_one_user'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item'))){
            User::destroy(request('item'));
        }else{
            User::find(request('item'))->delete();
        }
        session()->flash('message', trans('admin.success_delete_user'));
        return back();
    }
}
