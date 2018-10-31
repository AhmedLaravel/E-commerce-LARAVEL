<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ProductsDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\Products;
use Storage;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDataTables $ProductsDataTables)
    {
        return $ProductsDataTables->render('admin.products.index', ['title'=>trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_product');
        return view('admin.products.create',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
        'name_ar',
        'name_en',
        'logo',
        'brand',
        'mall_id',
        'description',
        'price',
        'discount',
        'payment',
        'email',
     */
    public function store(Request $request)
    {
        $rule = [
            'name_ar' => 'required',
            'color_name_ar' => 'required',
            'color_name_en' => 'required',
            'color' => 'required',
            'parent' => 'required',
            'name_en' => 'required',
            'model' => 'required',
            'catalog' => 'sometimes|nullable|file|mimes:pdf,rar,zip',
            'size' => 'required',
            'file_name' => 'sometimes|nullable',
            'price' => 'required|numeric',
            'email' => 'sometimes|nullable|email',
            'shipping_cost' => 'sometimes|nullable|numeric',
            'brand' => 'required|string',
            'discount' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|min:5',
            'logo' => 'required|'.v_image(),
        ];
        $niceName = [
            'color_name_ar' => trans('admin.color_name_ar'),
            'color_name_en' => trans('admin.color_name_en'),
            'color' => trans('admin.color'),
            'name_ar' => trans('admin.products_name_ar'),
            'parent' => trans('admin.dep'),
            'name_en' => trans('admin.products_name_en'),
            'model' => trans('admin.products_model'),
            'catalog' => trans('admin.catalog'),
            'file_name' => trans('admin.file_name'),
            'size' => trans('admin.products_size'),
            'email' => trans('admin.email'),
            'shipping_cost' => trans('admin.shipping_cost'),
            'brand' => trans('admin.brand'),
            'discount' =>trans('admin.discount'),
            'description' => trans('admin.desc'),
            'logo' => trans('admin.products_logo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(!empty(request()->file('catalog'))){
            $data['file_name'] = request()->file('catalog')->getClientOriginalName();
        }
        if(request()->hasfile('catalog')){
            $data['catalog'] = up()->upload(
               [
               'new_name'=>$data['file_name'],
                  'file'=>'catalog',
                  'upload_type'=>'single',
                  'path'=>'products',
                  'delete_file'=>'',
               ]
            );
         }
         if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'products',
                  'delete_file'=>'',
               ]
            );
         }
        Products::create($data);
        session()->flash('message', trans('admin.success_data_products'));
        return redirect(aurl('products'));
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
        $products = Products::find($id);
        $department = $products->department()->first();
        $title = trans('admin.edit_products');
        return view('admin.products.edit', ['products'=>$products, 'title' => $title,'department'=>$department]);
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
            'color_name_ar' => 'required',
            'color_name_en' => 'required',
            'color' => 'required',
            'parent' => 'required',
            'name_en' => 'required',
            'model' => 'required',
            'catalog' => 'sometimes|nullable|file|mimes:pdf,rar,zip',
            'size' => 'required',
            'file_name' => 'sometimes|nullable',
            'price' => 'required|numeric',
            'email' => 'sometimes|nullable|email',
            'shipping_cost' => 'sometimes|nullable|numeric',
            'brand' => 'required|string',
            'discount' => 'sometimes|nullable|string',
            'description' => 'sometimes|nullable|min:5',
            'logo' => 'sometimes|nullable|'.v_image(),
        ];
        $niceName = [
            'color_name_ar' => trans('admin.color_name_ar'),
            'color_name_en' => trans('admin.color_name_en'),
            'color' => trans('admin.color'),
            'name_ar' => trans('admin.products_name_ar'),
            'parent' => trans('admin.dep'),
            'name_en' => trans('admin.products_name_en'),
            'model' => trans('admin.products_model'),
            'catalog' => trans('admin.catalog'),
            'file_name' => trans('admin.file_name'),
            'size' => trans('admin.products_size'),
            'email' => trans('admin.email'),
            'shipping_cost' => trans('admin.shipping_cost'),
            'brand' => trans('admin.brand'),
            'discount' =>trans('admin.discount'),
            'description' => trans('admin.desc'),
            'logo' => trans('admin.products_logo'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(!empty(request()->file('catalog'))){
            $data['file_name'] = request()->file('catalog')->getClientOriginalName();
        }
        if(request()->hasfile('catalog')){
            $data['catalog'] = up()->upload(
               [
                    'new_name'=>request()->file('catalog')->getClientOriginalName(),
                    'file'=>'catalog',
                    'upload_type'=>'single',
                    'path'=>'products',
                    'delete_file'=>Products::find($id)->catalog,
               ]
            );
         }
         if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
                    'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'products',
                  'delete_file'=>Products::find($id)->logo,
               ]
            );
         }
        Products::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_products'));
        return redirect(aurl('products'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        storage::delete($products->logo);
        $products->delete();
        session()->flash('message', trans('admin.success_delete_one_products'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $products = Products::find($id);
            Storage::delete($products->logo);
            $products->delete();
           }
        }else{
            $products = Products::find(request('item'));
            Storage::delete($products->logo);
            $products->delete();
        }
        session()->flash('message', trans('admin.success_delete_products'));
        return back();
    }
}
