<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    //
	public function getDanhsach(){
		$slide = Slide::all();
		return view("admin.slide.danhsach",compact('slide'));
	}
	public function getThem(){
		return view("admin.slide.them");
	}
	public function postThem(Request $req){
    	// check ton tai file khong
		if($req->hasFile('file')){
			foreach ($req->file as $key) {
    			# code...
				$filename = $key->getClientOriginalName("file");
				$key->storeAs(
    				'upload/slide',// vi tri luu
    				$filename
    				);
				$slide = new Slide();
				$slide->hinh=  $filename;
				$slide->save();
			}
			return redirect()->back()->with("thanhcong","Thêm slide thành công ");
		}	
	}
	public function getSua($id){
		$slide = Slide::find($id);
		return view("admin.slide.sua",compact('slide'));
	}
	public function postSua(Request $req,$id){
		if($req->hasFile('file')){
    			# code...
			$file = $req->file("file");
			$filename = $file->getClientOriginalName("file");
			$file->storeAs(
    				'upload/slide',// vi tri luu
    				$filename
    				);
			$slide = Slide::find($id);
			$slide->hinh=  $filename;
			$slide->save();
			return redirect()->back()->with("thanhcong","Sửa slide thành công ");
		}	

	}
	public function getXoa($id){
		$slide = Slide::find($id);
		$slide->delete();
		return redirect()->back()->with("thanhcong","Xoá slide thành công");
	}
}
