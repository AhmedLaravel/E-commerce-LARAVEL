<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManifactDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Manifacturers;
use Storage;
class ManifactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManifactDataTables $ManifactDataTables)
    {
        return $ManifactDataTables->render('admin.manifact.index', ['title'=>trans('admin.manifacts')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_manifact');
        return view('admin.manifact.create',['title'=>$title]);
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'email' => 'sometimes|nullable|email',
            'mobile' => 'sometimes|nullable',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'lat' => 'sometimes|nullable',
            'lng' => 'sometimes|nullable',
            'icon' => v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.manifact_name_ar'),
            'name_en' => trans('admin.manifact_name_en'),
            'email' => trans('admin.email'),
            'mobile' => trans('admin.mobile'),
            'facebook' => trans('admin.manifact_facebook'),
            'twitter' => trans('admin.manifact_twitter'),
            'website' => trans('admin.manifact_website'),
            'address' => trans('admin.address'),
            'contact_name' => trans('admin.manifact_contact_name'),
            'lat' => trans('admin.manifact_contact_lat'),
            'lng' => trans('admin.manifact_contact_lng'),
            'icon' => trans('admin.manifact_icon'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('icon')){
            $data['icon'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'icon',
                  'upload_type'=>'single',
                  'path'=>'manifacturers',
                  'delete_file'=>'',
               ]
            );
         }
        Manifacturers::create($data);
        session()->flash('message', trans('admin.success_data_manifact'));
        return redirect(aurl('manifacts'));
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
        $manifact = Manifacturers::find($id);
        $title = trans('admin.edit_manifact');
        return view('admin.manifact.edit', ['manifact'=>$manifact, 'title' => $title]);
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'address' => 'sometimes|nullable|string',
            'contact_name' => 'sometimes|nullable|string',
            'lat' => 'sometimes|nullable',
            'lng' => 'sometimes|nullable',
            'icon' => 'sometimes|nullable|'.v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.manifact_name_ar'),
            'name_en' => trans('admin.manifact_name_en'),
            'facebook' => trans('admin.manifact_facebook'),
            'twitter' => trans('admin.manifact_twitter'),
            'website' => trans('admin.manifact_website'),
            'address' => trans('admin.address'),
            'contact_name' => trans('admin.manifact_contact_name'),
            'lat' => trans('admin.manifact_contact_lat'),
            'lng' => trans('admin.manifact_contact_lng'),
            'icon' => trans('admin.manifact_icon'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('icon')){
            $data['icon'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'icon',
                  'upload_type'=>'single',
                  'path'=>'manifacturers',
                  'delete_file'=>Manifacturers::find($id)->icon,
               ]
            );
         }
        Manifacturers::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_manifact'));
        return redirect(aurl('manifacts'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manifacts = Manifacturers::find($id);
        storage::delete($manifacts->icon);
        $manifacts->delete();
        session()->flash('message', trans('admin.success_delete_one_manifact'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $manifacts = Manifacturers::find($id);
            Storage::delete($manifacts->icon);
            $manifacts->delete();
           }
        }else{
            $manifacts = Manifacturers::find(request('item'));
            Storage::delete($manifacts->icon);
            $manifacts->delete();
        }
        session()->flash('message', trans('admin.success_delete_manifact'));
        return back();
    }
}
