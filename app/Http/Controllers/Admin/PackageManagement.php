<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\PackageItem;
use Session;
use Hash;
use Validator;

class PackageManagement extends Controller
{
	public function index(Request  $request)
	{
		//echo 'a';
		$package = Package::orderBy('id','desc')->get();
		return view('admin.package-list',compact('package'));
		//$education = EducationModel::orderBy('id','desc')->get();
		//return view('admin.education-list',compact('education'));
	}

	public function Add_package(){
		return view('admin.add-package-form');
	}

	public function Add_packageData(Request $request){
		//print_r($_REQUEST);
		$rules = [
			'title' => ['required'],
			'coins' => ['required'],
			'price'=>['required'],
			'item'=>['required'],
		];

		
		/*if(blank($request->item)){
			$b = $request->item;
			foreach ($b as $b_value) {

				if(empty($b_value)){
					$json['status']=0;
					$json['message']='<div class="alert alert-danger">One item is required</div>';
				//Session::flash('error', '<div class="alert alert-danger">One item is required</div>');
				echo json_encode($json); exit();
			}
		}
			
	}*/

		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$json['validation'] = $validator->errors();
			$json['status'] = 0;
			echo json_encode($json); exit();
		}else{
			$title = $request->title;
			$coins = $request->coins;
			$price = $request->price;
			$create_at = date('Y-m-d H:i:s');
			//echo $request->item;
			$insert =array(
				"title"=>$title,
				"coins"=>$coins,
				"price"=>$price,
				"created_at"=>$create_at,
			);
			$run =Package::insertGetId($insert);
			if($run){
				$package_item = $request->item;
				foreach ($package_item as $package_item_val) {

					$Package_item_arr =array(
						"item"=>$package_item_val,
						"package_id"=>$run,
						"created_at"=>$create_at
					);
					$insert_package_item = PackageItem::insert($Package_item_arr);
					if($insert_package_item){
						$json['status']=1;
						Session::flash('message', '<div class="alert alert-success">Package has been inserted successfully.</div>');
					}else{
						$json['status']=0;
						Session::flash('error', '<div class="alert alert-danger">Something went wrong.</div>');
					}
					
				}
			}
		} 
		echo json_encode($json);
	}

public function delete_package(Request $request){
	$rules = [
			'id' => ['required']
		];
    $id = $request->id;
    $run = Package::where(['id'=>$id])->delete();
    if($run){
    	$delete_data = PackageItem::where(['package_id'=>$id])->delete();
    	
    		$json['status']=1;
				Session::flash('message', '<div class="alert alert-success">Package has been deleted successfully.</div>'); 
			
			return back()->with('message','<div class="alert alert-success">Package has been deleted successfully</div>');
    }
}



public function delete_packagelist_Item(Request $request){
		
		/*$rules = [
			'id' => ['required']
		];*/
	$id = $request->id;
		
		$run = PackageItem::where(['id'=>$id])->delete();
		if($run){
			
			$json['status']=1;
			Session::flash('message', '<div class="alert alert-success">Package has been updated successfully.</div>');

			//return back()->with('message','<div class="alert alert-success">Package has been deleted successfully</div>');
		}

		echo json_encode($json);
}

	public function edit_package(Request $request){

		$value = Package::where('id',$request->id)->first();
		return view('admin.edit_package',compact('value'));
	}

	public function update_package(Request $request){
		//print_r($_REQUEST);
		//echo $request->id;
		$rules = [
			'title' => ['required'],
			'coins' => ['required'],
			'price'=>['required'],
		];
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()) {
			$json['validation'] = $validator->errors();
			$json['status'] = 0;
			echo json_encode($json); exit();
			//echo json_encode($json); exit();
		}else{

			$title = $request->title;
			$coins = $request->coins;
			$price = $request->price;
			$updated_at = date('Y-m-d H:i:s');
			$update =array(
				"title"=>$title,
				"coins"=>$coins,
				"price"=>$price ,
				"updated_at"=>$updated_at,
			);
			$run = Package::where('id',$request->id)->update($update);
			$package_item = $request->item;
			$package_item_id = $request->package_list_id;
			if($run){

				foreach($package_item_id as $key => $package_item_val) {
					
					//print_r($package_item);
				/*
				foreach ($package_item_id as $package_item_id_val){
						//print_r($package_item_id_val);
					$update_package_list = PackageItem::where('id',$package_item_id_val)->update($arr);

					}*/

					$package_ite1m['item'] = $package_item[$key];
						//print_r($package_item[$key]);die;
					$package_ite1m['updated_at'] = date('Y-m-d H:i:s');
						$update_package_list = PackageItem::where('id',$package_item_val)->update($package_ite1m);

					if($update_package_list){
						$json['status']=1;
					Session::flash('message', '<div class="alert alert-success">Package has been updated successfully.</div>'); 
					}else{
						$json['status']=0;
				Session::flash('message', '<div class="alert alert-danger">Something went wrong.</div>');
					}
					
				}
				

	}
	//	print_r($request->additem);die;

		if(!blank($request->additem)){
					$additem = $request->additem;

					foreach($additem as $additem_val){
						if(!empty($additem_val)){

						$package_item_array = array(
						"item"=>$additem_val,
						"package_id"=>$request->id,
						"created_at"=>$updated_at
						);
						$insert_package_item = PackageItem::insert($package_item_array);

						}
						
					}	
			}
	}

		echo json_encode($json);
	}


	
}
