<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AccessoriesDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Accessories;
use App\Models\Products;
use Storage;
class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccessoriesDataTables $AccessoriesDataTables)
    {
        return $AccessoriesDataTables->render('admin.accessories.index', ['title'=>trans('admin.accessories')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_accessories');
        return view('admin.accessories.create',['title'=>$title]);
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
            'prod_name_ar' => 'required',
            'prod_name_en' => 'required',
            'name_en' => 'required',
            'photo' => 'required|'.v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.accesso_name_ar'),
            'prod_name_ar' => trans('admin.prod_name_ar'),
            'prod_name_en' => trans('admin.prod_name_en'),
            'name_en' => trans('admin.accesso_name_en'),
            'photo' => trans('admin.accesso_photo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('photo')){
            $data['photo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'photo',
                  'upload_type'=>'single',
                  'path'=>'accessories',
                  'delete_file'=>'',
               ]
            );
         }
         $prods = Products::orderBy('id','desc')->get();
         $counter1 = 0;
         $counter2 = 0;
         $counter3 = 0;
         foreach ($prods as $prod) {
             if($prod->name_en == $data['prod_name_en']){
                $counter1++;
             }
         }
         if($counter1 ==  0){
            session()->flash('error',trans('admin.noProductNamedInEnglish'));
            return back();
         }
         foreach ($prods as $prod) {
             if($prod->name_ar == $data['prod_name_ar']){
                $counter2++;
             }
         }
         if($counter2 == 0){
            session()->flash('error',trans('admin.noProductNamedInArabic'));
            return back();
         }
         foreach ($prods as $prod) {
             if($prod->name_en == $data['prod_name_en'] and $prod->name_ar == $data['prod_name_ar']){
                $counter3++;
             }
         }
         if($counter3 == 0){
            session()->flash('error',trans('admin.NoProductWithArabicAndEnglish'));
            return back();
         }

        Accessories::create($data);
        session()->flash('message', trans('admin.success_data_accessories'));
        return redirect(aurl('accessories'));
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
        $accessories = Accessories::find($id);
        $title = trans('admin.edit_accessory');
        return view('admin.accessories.edit', ['accessories'=>$accessories, 'title' => $title]);
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
            'prod_name_ar' => 'required',
            'prod_name_en' => 'required',
            'name_en' => 'required',
            'photo' => 'sometimes|nullable|'.v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.accesso_name_ar'),
            'prod_name_ar' => trans('admin.prod_name_ar'),
            'prod_name_en' => trans('admin.prod_name_en'),
            'name_en' => trans('admin.accesso_name_en'),
            'photo' => trans('admin.accesso_photo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('photo')){
            $data['photo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'photo',
                  'upload_type'=>'single',
                  'path'=>'accessories',
                  'delete_file'=>Accessories::find($id)->photo,
               ]
            );
         }
         $prods = Products::orderBy('id','desc')->get();
         $counter1 = 0;
         $counter2 = 0;
         foreach ($prods as $prod) {
             if($prod->name_en == $data['prod_name_en']){
                $counter1++;
             }
         }
         if($counter1 ==  0){
            session()->flash('error',trans('admin.noProductNamedInEnglish'));
            return back();
         }
         foreach ($prods as $prod) {
             if($prod->name_ar == $data['prod_name_ar']){
                $counter2++;
             }
         }
         if($counter2 == 0){
            session()->flash('error',trans('admin.noProductNamedInArabic'));
            return back();
         }
        Accessories::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_accessories'));
        return redirect(aurl('accessories'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessories = Accessories::find($id);
        storage::delete($accessories->photo);
        $accessories->delete();
        session()->flash('message', trans('admin.success_delete_one_accessories'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $accessories = Accessories::find($id);
            Storage::delete($accessories->photo);
            $accessories->delete();
           }
        }else{
            $accessories = Accessories::find(request('item'));
            Storage::delete($accessories->photo);
            $accessories->delete();
        }
        session()->flash('message', trans('admin.success_delete_accessories'));
        return back();
    }
}
