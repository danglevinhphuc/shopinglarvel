<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Products;
use App\Category;
use App\Hinhproduct;
use App\User;
use Cart;
class ClientController extends Controller
{
    //Dua du lieu gom ra trang index
    //du lieu gom san pham trong kho va san pham moi
	public function getTrangchu(){
		$product = Products::where('new','=',0)->orderBy('id', 'desc')
                ->limit(10)->get();
		$productNew = Products::where('new','=',1)->orderBy('id', 'desc')
                ->limit(10)->get();
		return view('client.page.trangchu',compact('product','productNew'));
	}
	// lay chi tiet tu san pham thong qua id tren url
	public function getChitiet($id){
		// san pham chi tiet chinh
		$product = Products::find($id);
		// san pham lien quan
		$productOther = Products::where([
                ['id_category', '=', $product->id_category],
                ['id', '!=', $product->id]
            ])->orderBy('id', 'desc')->limit(3)->get();
		return view('client.page.chitiet',compact('product','productOther'));	
	}
	// lay du lieu tu category va cac san pham lien quan
	// thong qua id tu url
	public function getDanhmuc($slug){
		$category = Category::where("tenkhongdau","=",$slug)->get();

		foreach ($category as $key ) {
			# code...
			$id_category = $key->id;
			$ten = $key->ten;
		}
		$product= Products::where("id_category",'=',$id_category)->orderBy('id', 'desc')->get();
		return view('client.page.danhmuc',compact('product','ten'));
	}
	// Them san pham vao gio hang 
	public function addCart(Request $req){
		$productId = $req->id;
		$Qty = $req->quantity;
		$price = $req->price;
		$product = Products::find($productId);
		$hinh = Hinhproduct::where("id_product",'=',$productId)->get();
		// lay hinh
		foreach ($hinh as $hinh ) {
			# code...
			$firstImage = $hinh->hinh;
			break;
		}
		// dua gia tri vao cart
		Cart::add($productId,$product->ten,$Qty,$price,['size'=>'XL','hinh'=>$firstImage]);
		return redirect()->back();
	}
	// add cart theo tung so luong va size tu nguoi dung
	public function addCartChiTiet(Request $req){
		$this->validate($req,
			[
				'qty' => "required|min:1"
			],
			[
				'qty.required' => "Bạn chưa  nhập số lượng cho sản phẩm",
				'qty.min' => "Số lượng phải lớn hơn 0"
			]);
		$productId = $req->id;
		$Qty = $req->qty;
		$price = $req->price;
		$size = $req->size;
		$product = Products::find($productId);
		$hinh = Hinhproduct::where("id_product",'=',$productId)->get();
		// lay hinh
		foreach ($hinh as $hinh ) {
			# code...
			$firstImage = $hinh->hinh;
			break;
		}
		// dua gia tri vao cart
		Cart::add($productId,$product->ten,$Qty,$price,['size'=>$size,'hinh'=>$firstImage]);
		return redirect()->back();
	}
	// show gio hang
	public function getCart(){
		$cart = Cart::content();
		return view('client.page.cart',compact('cart'));
	}
	// xoa san pham theo id
	public function getXoaCart($id){
		Cart::remove($id);
		return redirect()->back();
	}
	// cap nhat lai so luong san pham
	public function updateCart($qty,$rowId){
		if($qty != 0){
			$rowId = $rowId;
			$qty =$qty;
			Cart::update($rowId,$qty);	
		}
	}
	// tim kiem san pham
	// theo ten san pham
	public function getTim(Request $req){
		$value = $req->get('q');
		$products = Products::where('ten','like','%'.$value.'%')->paginate(4);
		return view('client.page.tim',compact('products'));
	}
	// load trang gioi thieu
	public function getGioithieu(){
		return view("client.page.gioithieu");
	}
	// load trang dang ky
	public function getDangky(){
		return view("client.page.dangky");	
	}
	public function postDangky(Request $req){
		$this->validate($req,
			[
				'name' => 'required',
				'email' => 'required|unique:Users,email',
				'password'=>'required|min:5'
			],
			[
				'name.required' => 'Bạn chưa nhập tên',
				'email.required' => 'Bạn chưa nhập email',
				'email.unique' => 'Email đã tồn tại',
				'password.required' => 'Mật khẩu bạn chưa nhập',
				'password.min' => 'Mật khẩu phải lớn hơn 5 ký tự'
			]);
		$user = new User();
		$user->name = $req->name;
		$user->email = $req->email;
		$user->password = Hash::make($req->password);
		$user->remember_token = 0;
		$user->save();
		return redirect()->back()->with("thanhcong","Tạo tài khoản thành công");
	}
	// dang nhap
	public function getDangnhap(){
		return view("client.page.dangnhap");
	}
	// nhan va check du lieu de dang nhap
	public function postDangnhap(Request $req){
		$this->validate($req,
			[
				'email' => 'required',
				'password'=>'required|min:5'
			],
			[
				'email.required' => 'Bạn chưa nhập email',
				'password.required' => 'Mật khẩu bạn chưa nhập',
				'password.min' => 'Mật khẩu phải lớn hơn 5 ký tự'
			]);
		$email = $req->email;
		$password= $req->password;
		if(Auth::attempt(['email' => $email,'password'=>$password])){
            return redirect()->route('trangchu');
        }else{
            return redirect()->back()->with("thanhcong","Đăng nhập thất bại");
        }
	}
	// dang xuat 
	public function dangxuat(){
        Auth::logout();
        return redirect()->route('dangnhap');
    }
    public function getThanhtoan(){
    	$cart = Cart::content();
    	return view('client.page.thanhtoan',compact('cart'));
    }
}
