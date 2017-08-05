<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    //
    public function getDanhsach(){
    	$user = User::all();
    	return view('admin.user.danhsach',compact('user'));
    }
    public function getXoa($id){
    	$user = User::find($id);
    	$user->delete();
		return redirect()->back()->with("thanhcong","Xóa user thành công");
    }
}
