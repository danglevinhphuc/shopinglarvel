<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Category;
use App\Hinhproduct;
class ProductsController extends Controller
{
    //
	public function getDanhsach(){
		$product = Products::all();
		return view("admin.product.danhsach",compact('product'));
	}
	public function getThem(){
		$category = Category::all();
		return view("admin.product.them",compact('category'));
	}
	public function postThem(Request $req){
    	// ta co max_id
    	// khi tao sp moi hinh dk them thi se tang len 1
    	$max_id = 0;
    	$check = 0;
		$this->validate($req,
			[
				'ten' => 'required|unique:products,ten',
				'category' => 'required',
				'description' => 'required',
				'unit_price' => 'required|min:0',
				'promotion_price' => 'min:0'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên cho sản phẩm',
				'category.required' => 'Bạn chưa chọn danh mục cho sản phẩm',
				'description.required' => 'Bạn chưa nhập mô tả cho sản phẩm',
				'unit_price.required' => 'Bạn chưa nhập giá góc cho sản phẩm',
				'ten.unique' => 'Tên bạn nhập đã tồn tại',
				'unit_price.min'=>'Giá góc không được âm ',
				'promotion_price.min' => "Giá khuyến mãi không được âm"
			]);
		// luc dau thi them san pham truoc
		// tat co check = 0 
		// khi them san pham thanh cong thi bat co check =1
		if($check == 0){
			$productnew = new Products();
			$productnew->ten = $req->ten;
			$productnew->id_category = $req->category;
			$productnew->description = $req->description;
			$productnew->unit_price = $req->unit_price;
			if($req->promotion_price == null){
				$productnew->promotion_price = 0;
			}else{
				$productnew->promotion_price = $req->promotion_price;
			}
			$productnew->new = $req->new;
			$productnew->save();
			// lay max id de gan vao gia tri khoa ngoai cho hinh san pham
			$product = Products::find(Products::max('id'));
			$max_id =$product->id;
			echo $max_id;
			$check = 1;
		}
		// thuc hien thao tac them img
		// check ton tai file khong
		if($req->hasFile('file') && $check== 1){
			echo "maxhinh".$max_id;
			foreach ($req->file as $key) {
    			# code...
				$filename = $key->getClientOriginalName("file");
				$key->storeAs(
    				'upload/product',// vi tri luu
    				$filename
    				);
				$producthinh = new Hinhproduct();
				$producthinh->id_product = (int)($max_id);
				$producthinh->hinh= $filename;
				$producthinh->save();
			}
			$check = 0;
		}	
		return redirect()->back()->with("thanhcong","Thêm sản phẩm thành công");
	}
	public function getSua($id){
		$product = Products::find($id);
		$category= Category::all();
		return view("admin.product.sua",compact('product','category'));
	}
	public function postSua(Request $req,$id){
		$this->validate($req,
			[
				'ten' => 'required|unique:products,ten',
				'category' => 'required',
				'description' => 'required',
				'unit_price' => 'required|min:0',
				'promotion_price' => 'min:0'
			],
			[
				'ten.required' => 'Bạn chưa nhập tên cho sản phẩm',
				'category.required' => 'Bạn chưa chọn danh mục cho sản phẩm',
				'description.required' => 'Bạn chưa nhập mô tả cho sản phẩm',
				'unit_price.required' => 'Bạn chưa nhập giá góc cho sản phẩm',
				'ten.unique' => 'Tên bạn nhập đã tồn tại',
				'unit_price.min'=>'Giá góc không được âm ',
				'promotion_price.min' => "Giá khuyến mãi không được âm"
			]);
			$productnew =Products::find($id);
			$productnew->ten = $req->ten;
			$productnew->id_category = $req->category;
			$productnew->description = $req->description;
			$productnew->unit_price = $req->unit_price;
			if($req->promotion_price == null){
				$productnew->promotion_price = 0;
			}else{
				$productnew->promotion_price = $req->promotion_price;
			}
			$productnew->new = $req->new;
			$productnew->save();
			return redirect()->back()->with("thanhcong","Sửa sản phẩm thành công | Bạn có thể sửa tiếp tục hình ảnh của sản phẩm");
	}
	public function getSuahinh($id){
		$idHinh = $id;
		$hinhproduct = Hinhproduct::where('id_product','=',$id)->get();
		return view("admin.product.hinh",compact('hinhproduct','idHinh'));
	}
	public function postSuahinh(Request $req,$id){
		// thuc hien thao tac them img
		// check ton tai file khong
		if($req->hasFile('file')){
			$producthinh =Hinhproduct::where('id_product','=',$id)->get();
			// xoa tat ca cap nhat lai cai moi
			foreach ($producthinh as $key) {
				$producthinh_de = Hinhproduct::find($key->id);
				$producthinh_de->delete();
				unlink('storage/app/upload/product/'.$key->hinh);
			}
			foreach ($req->file as $key) {
    			# code...
				$filename = $key->getClientOriginalName("file");
				$key->storeAs(
    				'upload/product',// vi tri luu
    				$filename
    				);
				$producthinh = new Hinhproduct();
				$producthinh->id_product = $id;
				$producthinh->hinh= $filename;
				$producthinh->save();
			}
		}	
		return redirect()->back()->with("thanhcong","Sửa hình ảnh sản phẩm thành công");
	}
	public function getXoa($id){
		$product = Products::find($id);
		$product->delete();
		return redirect()->back()->with("thanhcong","Xoa product thanh cong");
	}
}
