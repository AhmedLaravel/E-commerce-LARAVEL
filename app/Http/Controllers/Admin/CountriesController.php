<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Countries;
use Storage;
class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDataTables $countriesDataTable)
    {
        return $countriesDataTable->render('admin.countries.index', ['title'=>trans('admin.countries')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_country');
        return view('admin.countries.create',['title'=>$title]);
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
            'logo' => v_image(),
            'mob' => 'required',
            'code' => 'required',
        ];
        $niceName = [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'logo' => trans('admin.country_flag'),
            'mob' => trans('admin.mob'),
            'code' => trans('admin.code'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'countries',
                  'delete_file'=>'',
               ]
            );
         }
        Countries::create($data);
        session()->flash('message', trans('admin.success_data_countries'));
        return redirect(aurl('countries'));
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
        $countries = Countries::find($id);
        $title = trans('admin.edit_country');
        return view('admin.countries.edit', ['country'=>$countries, 'title' => $title]);
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
            'logo' => 'sometimes|nullable|'.v_image(),
            'mob' => 'required',
            'code' => 'required',
        ];
        $niceName = [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
            'logo' => trans('admin.country_flag'),
            'mob' => trans('admin.mob'),
            'code' => trans('admin.code'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'countries',
                  'delete_file'=>Countries::find($id)->logo,
               ]
            );
         }
        Countries::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_country'));
        return redirect(aurl('countries'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Countries::find($id);
        storage::delete($country->logo);
        $country->delete();
        session()->flash('message', trans('admin.success_delete_one_countries'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $country = Countries::find($id);
            Storage::delete($country->logo);
            $country->delete();
           }
        }else{
            $country = Countries::find(request('item'));
            Storage::delete($country->logo);
            $country->delete();
        }
        session()->flash('message', trans('admin.success_delete_coutries'));
        return back();
    }
}
