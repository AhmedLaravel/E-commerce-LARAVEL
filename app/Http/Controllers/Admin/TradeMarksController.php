<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TradeMarksDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\TradeMarks;
use Storage;
class TradeMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradeMarksDataTables $TradeMarksDataTable)
    {
        return $TradeMarksDataTable->render('admin.trademarks.index', ['title'=>trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_trade_marke');
        return view('admin.trademarks.create',['title'=>$title]);
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
            'department' => 'required',
            'logo' => 'required|'.v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.trade_name_ar'),
            'name_en' => trans('admin.trade_name_en'),
            'department' => trans('admin.dep'),
            'logo' => trans('admin.trade_marke_logo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'trade_marks',
                  'delete_file'=>'',
               ]
            );
         }
        TradeMarks::create($data);
        session()->flash('message', trans('admin.success_data_tradeMark'));
        return redirect(aurl('trademarks'));
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
        $tradeMarke = TradeMarks::find($id);
        $title = trans('admin.edit_tradeMark');
        return view('admin.trademarks.edit', ['trademark'=>$tradeMarke, 'title' => $title]);
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
            'department' => 'required',
            'logo' => 'sometimes|nullable|'.v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.trade_name_ar'),
            'name_en' => trans('admin.trade_name_en'),
            'department' => trans('admin.dep'),
            'logo' => trans('admin.trade_marke_logo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'trade_marks',
                  'delete_file'=>TradeMarks::find($id)->logo,
               ]
            );
         }
        TradeMarks::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_trademark'));
        return redirect(aurl('trademarks'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = TradeMarks::find($id);
        storage::delete($country->logo);
        $country->delete();
        session()->flash('message', trans('admin.success_delete_one_trademark'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $country = TradeMarks::find($id);
            Storage::delete($country->logo);
            $country->delete();
           }
        }else{
            $country = TradeMarks::find(request('item'));
            Storage::delete($country->logo);
            $country->delete();
        }
        session()->flash('message', trans('admin.success_delete_trademarks'));
        return back();
    }
}
