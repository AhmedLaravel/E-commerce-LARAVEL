<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\DepartmentsDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Department;
use Storage;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentsDataTables $DepartmentsDataTables)
    {
        return $DepartmentsDataTables->render('admin.department.index', ['title'=>trans('admin.dep')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_dep');
        return view('admin.department.create',['title'=>$title]);
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
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'photo' => 'required|'.v_image(),
            'hint' => 'required',
        ];
        $niceName = [
            'dep_name_ar' => trans('admin.dep_name_ar'),
            'dep_name_en' => trans('admin.dep_name_en'),
            'photo' => trans('admin.photo'),
            'hint' => trans('admin.hint'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('photo')){
            $data['photo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'photo',
                  'upload_type'=>'single',
                  'path'=>'department',
                  'delete_file'=>'',
               ]
            );
         }
        Department::create($data);
        session()->flash('message', trans('admin.success_data_dep'));
        return redirect(aurl('department'));
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
        $department = Department::find($id);
        $title = trans('admin.edit_dep');
        return view('admin.department.edit', ['department'=>$department, 'title' => $title]);
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
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'photo' => 'sometimes|nullable|'.v_image(),
            'hint' => 'required',
        ];
        $niceName = [
            'dep_name_ar' => trans('admin.dep_name_ar'),
            'dep_name_en' => trans('admin.dep_name_en'),
            'photo' => trans('admin.photo'),
            'hint' => trans('admin.hint'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('photo')){
            $data['photo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'photo',
                  'upload_type'=>'single',
                  'path'=>'countries',
                  'delete_file'=>Department::find($id)->photo,
               ]
            );
         }
        Department::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_dep'));
        return redirect(aurl('department'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        storage::delete($department->photo);
        $department->delete();
        session()->flash('message', trans('admin.success_delete_one_dep'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $department = Department::find($id);
            Storage::delete($department->photo);
            $department->delete();
           }
        }else{
            $department = Department::find(request('item'));
            Storage::delete($department->photo);
            $department->delete();
        }
        session()->flash('message', trans('admin.success_delete_dep'));
        return back();
    }
}
