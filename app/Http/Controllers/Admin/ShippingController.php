<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingDataTables;
use Illuminate\Http\Request;
use Validator;
use App\Models\ShippingCompanies;
use Storage;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDataTables $ShippingDataTables)
    {
        return $ShippingDataTables->render('admin.shipping.index', ['title'=>trans('admin.shipps')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('admin.create_shipping_company');
        return view('admin.shipping.create',['title'=>$title]);
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
            'facebook' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'mobile' => 'sometimes|nullable',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'lat' => 'sometimes|nullable',
            'lng' => 'sometimes|nullable',
            'icon' => v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.shipp_name_ar'),
            'name_en' => trans('admin.shipp_name_en'),
            'email' => trans('admin.email'),
            'mobile' => trans('admin.mobile'),
            'facebook' => trans('admin.shipp_facebook'),
            'twitter' => trans('admin.shipp_twitter'),
            'website' => trans('admin.shipp_website'),
            'address' => trans('admin.address'),
            'contact_name' => trans('admin.shipp_contact_name'),
            'lat' => trans('admin.shipp_contact_lat'),
            'lng' => trans('admin.shipp_contact_lng'),
            'icon' => trans('admin.shipp_icon'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('icon')){
            $data['icon'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'icon',
                  'upload_type'=>'single',
                  'path'=>'shipping',
                  'delete_file'=>'',
               ]
            );
         }
        ShippingCompanies::create($data);
        session()->flash('message', trans('admin.success_data_shipp'));
        return redirect(aurl('shipping'));
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
        $shipping = ShippingCompanies::find($id);
        $title = trans('admin.edit_shipp');
        return view('admin.shipping.edit', ['shipping'=>$shipping, 'title' => $title]);
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
            'email' => 'sometimes|nullable|email',
            'mobile' => 'sometimes|nullable',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'address' => 'sometimes|nullable|string',
            'lat' => 'sometimes|nullable',
            'lng' => 'sometimes|nullable',
            'icon' => v_image(),
        ];
        $niceName = [
            'name_ar' => trans('admin.shipp_name_ar'),
            'name_en' => trans('admin.shipp_name_en'),
            'email' => trans('admin.email'),
            'mobile' => trans('admin.mobile'),
            'facebook' => trans('admin.shipp_facebook'),
            'twitter' => trans('admin.shipp_twitter'),
            'website' => trans('admin.shipp_website'),
            'address' => trans('admin.address'),
            'contact_name' => trans('admin.shipp_contact_name'),
            'lat' => trans('admin.shipp_contact_lat'),
            'lng' => trans('admin.shipp_contact_lng'),
            'icon' => trans('admin.shipp_icon'),
        ];
        $data = $this->validate(request(),$rule,[],$niceName);
        if(request()->hasfile('icon')){
            $data['icon'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'icon',
                  'upload_type'=>'single',
                  'path'=>'shipping',
                  'delete_file'=>ShippingCompanies::find($id)->icon,
               ]
            );
         }
        ShippingCompanies::where('id', $id)->update($data);
        session()->flash('message', trans('admin.success_updated_shipp'));
        return redirect(aurl('shipping'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = ShippingCompanies::find($id);
        storage::delete($shipping->icon);
        $shipping->delete();
        session()->flash('message', trans('admin.success_delete_one_shipp'));
        return back();
    }
    public function multi_delete(){
        if(is_array(request('item') )){ 
           foreach (request('item') as $id){
            $shipping = ShippingCompanies::find($id);
            Storage::delete($shipping->icon);
            $shipping->delete();
           }
        }else{
            $shipping = ShippingCompanies::find(request('item'));
            Storage::delete($shipping->icon);
            $shipping->delete();
        }
        session()->flash('message', trans('admin.success_delete_shipp'));
        return back();
    }
}
