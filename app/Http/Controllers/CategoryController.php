<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    //
    public function getDanhsach(){
    	$category = Category::all();
    	return view("admin.category.danhsach",compact('category'));
    }
    public function getThem(){
    	return view("admin.category.them");
    }
    public function postThem(Request $req){
    	$this->validate($req,
    		[
    			'ten' => 'required|unique:Category,ten'
    		],
    		[
    			'ten.required' => 'Bạn chưa đặt tên cho danh mục sản phẩm',
    			'ten.unique' => 'Tên này đã tồn tại hãy chọn tên khác'
    		]);
    	$category = new Category();
    	$category->ten = $req->ten;
    	$category->tenkhongdau= changeTitle($req->ten);
    	$category->save();
    	return redirect()->back()->with("thanhcong","Thêm danh mục thành công ");
    }
    public function getSua($id){
        $category = Category::find($id);
    	return view("admin.category.sua",compact('category'));
    }
    public function postSua(Request $req,$id){
        $this->validate($req,
            [
                'ten' => 'required|unique:Category,ten'
            ],
            [
                'ten.required' => 'Bạn chưa đặt tên cho danh mục sản phẩm',
                'ten.unique' => 'Tên này đã tồn tại hãy chọn tên khác'
            ]);
        $category =Category::find($id);
        $category->ten = $req->ten;
        $category->tenkhongdau= changeTitle($req->ten);
        $category->save();
        return redirect()->back()->with("thanhcong","Sửa danh mục thành công ");
    }
    public function getXoa($id){
    	$category = Category::find($id);
    	$category->delete();
        return redirect()->back()->with("thanhcong","Xoá danh mục thành công");
    }
}
