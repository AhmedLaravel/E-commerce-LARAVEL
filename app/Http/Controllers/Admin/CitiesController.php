<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CitiesDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Cities;
use Storage;
class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDataTables $citiesDataTable)
    {
        return $citiesDataTable->render('admin.cities.index', ['title'=>trans('admin.cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_city');
        return view('admin.cities.create',['title'=>$title]);
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
            'country_id' =>'required',
        ];
        $niceName = [
            'name_ar' => trans('admin.city_name_ar'),
            'name_en' => trans('admin.city_name_en'),
            'country_id' => trans('admin.country_id'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        
       Cities::create($data);
        session()->flash('message', trans('admin.success_data_cities'));
        return redirect(aurl('cities'));
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
        $cities =Cities::find($id);
        $title = trans('admin.edit_city');
        return view('admin.cities.edit', ['city'=>$cities, 'title' => $title]);
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
            'country_id' =>'required',
        ];
        $niceName = [
            'name_ar' => trans('admin.city_name_ar'),
            'name_en' => trans('admin.city_name_en'),
            'country_id' => trans('admin.country_id'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
       Cities::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_city'));
        return redirect(aurl('cities'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country =Cities::find($id);
        $country->delete();
        session()->flash('message', trans('admin.success_delete_one_cities'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $country =Cities::find($id);
            $country->delete();
           }
        }else{
            $country =Cities::find(request('item'));
            $country->delete();
        }
        session()->flash('message', trans('admin.success_delete_cities'));
        return back();
    }
}
