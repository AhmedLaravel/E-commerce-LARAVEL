<?php

namespace App\Http\Controllers;
use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/*
	'name',
		'path',
		'file',
		'size',
		'full_file',
		'file_type',
		'mimes_type',
		'relation_id'
*/

class Upload extends Controller
{
	public static function upload($data = []){
		if(in_array('new_name', $data)){
			$name = $data['new_name']  == null? time():$data['new_name'];
		}
		if(request()->hasFile($data['file']) and $data['upload_type'] == 'single'){
			if(!empty($data['delete_file'])){
				\Storage::delete($data['delete_file']);
			}
			if($data['new_name']  == null){
				return request()->file($data['file'])->store($data['path']);
			}else {
				return request()->file($data['file'])->storeAs($data['path'],$data['new_name']);
			}
		}

	}

}
