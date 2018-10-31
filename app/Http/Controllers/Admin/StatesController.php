<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StatesDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Cities;
use App\Models\States;
use Storage;
use Form;
class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDataTables $statesDataTables)
    {
        return $statesDataTables->render('admin.states.index', ['title'=>trans('admin.states')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if(request()->has('country_id')){
                $select = request()->has('select')?request('select'):'';
                return Form::select('city_id',Cities::where('country_id',request('country_id'))->pluck('name_'.settings()->main_lang,'id') ,$select,['class'=>'form-control', 'placeholder'=>'.............']);
            }
        }
        $title = trans('admin.create_state');
        return view('admin.states.create',['title'=>$title]);
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
            'city_id' =>'required',
        ];
        $niceName = [
            'name_ar' => trans('admin.state_name_ar'),
            'name_en' => trans('admin.state_name_en'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        
       States::create($data);
        session()->flash('message', trans('admin.success_data_states'));
        return redirect(aurl('states'));
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
        $state =States::find($id);
        $title = trans('admin.edit_states');
        return view('admin.states.edit', ['state'=>$state, 'title' => $title]);
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
            'city_id' =>'sometimes|nullable',
        ];
        $niceName = [
            'name_ar' => trans('admin.state_name_ar'),
            'name_en' => trans('admin.state_name_en'),
            'country_id' => trans('admin.country_id'),
            'city_id' => trans('admin.city_id'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
       States::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_state'));
        return redirect(aurl('states'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state =States::find($id);
        $state->delete();
        session()->flash('message', trans('admin.success_delete_one_states'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $state =States::find($id);
            $state->delete();
           }
        }else{
            $state =States::find(request('item'));
            $state->delete();
        }
        session()->flash('message', trans('admin.success_delete_states'));
        return back();
    }
}
