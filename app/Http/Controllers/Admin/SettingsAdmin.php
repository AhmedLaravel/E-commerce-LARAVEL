<?php

namespace App\Http\Controllers\Admin;
use  App\Http\Controllers\Controller;
use \App\Models\Settings;
use Illuminate\Http\Request;
use Validator;
use Storage;

class SettingsAdmin extends Controller
{
   	public function setting_get(){
   		$title = trans('admin.settings');
   		return view('admin.admins.settings',['title'=>$title]);
   	}
   	public function setting_post(Request $request){
   		$data = $this->Validate(request(),[
   			'logo'=>v_image(),
   			'icon'=>v_image(),
            'sitename_en' =>'required',
            "mail" =>'required',
            'sitename_ar' =>'required',
            'description' =>'required',
            'main_lang' =>'required',
            'main_currency' =>'required',
            'dollar_egypt' =>'required',
            'euro_egypt' =>'required',
            'about_us' =>'sometimes|nullable',
            'time_to_deliver' =>'required',
            'address1' =>'required',
            'address2' =>'required',
            'country' =>'required',
            'phone' =>'required',
            'fax' =>'required',
            'manager' =>'required',
            'keywords' =>'required',
            'site_admin' =>'required',
            'wish' =>'required',
            'status' =>'required',
            'facebook' =>'required',
            'insta' =>'required',
            'twitter' =>'required',
            'message_maintenance' =>'required',

   		],[],[
   			'logo'=>trans('admin.logo'),
            'icon'=>trans('admin.icon'),
            'sitename_en'=>trans('admin.en_lang'),
            'sitename_ar'=>trans('admin.ar_lang'),
            'time_to_deliver'=>trans('admin.time_to_deliver'),
            'description'=>trans('admin.descr'),
   			'about_us'=>trans('admin.about'),
            'main_lang' =>trans('admin.main_language'),
            'main_currency' =>trans('admin.main_currency'),
            'dollar_egypt' =>trans('admin.dollar_egypt'),
            'euro_egypt' =>trans('admin.euro_egypt'),
            'address1' =>trans('admin.address1'),
            'address2' =>trans('admin.address2'),
            'country' =>trans('admin.country'),
            'phone' =>trans('admin.phone'),
            'fax' =>trans('admin.fax'),
            'facebook' =>trans('admin.facebook'),
            'insta' =>trans('admin.insta'),
            'twitter' =>trans('admin.twitter'),
            'manager' =>trans('admin.manager'),
            'keywords' =>trans('admin.key'),
            'site_admin' =>trans('admin.site_admin'),
            'wish' =>trans('admin.wish'),
            'mail' =>trans('admin.email'),
            'status' =>trans('admin.status'),
            'message_maintenance' =>trans('admin.maintenance'),
   		]);
         if(request()->hasfile('logo')){
            $data['logo'] = up()->upload(
               [
               'new_name'=>'',
                  'file'=>'logo',
                  'upload_type'=>'single',
                  'path'=>'settings',
                  'delete_file'=>settings()->logo,
               ]
            );
         }
         if(request()->hasfile('icon')){
            $data['icon'] = up()->upload(
               [
                  /*
               file
               upload_type
               delete_file
               path
                  */
               'new_name'=>'',
                  'file'=>'icon',
                  'upload_type'=>'single',
                  'path'=>'settings',
                  'delete_file'=>settings()->icon,
               ]
            );
         }
   		Settings::orderBy('id','desc')->update($data);
   		session()->flash('message', trans('admin.setting_session'));
   		return redirect(aurl('settings'));

   	}
}