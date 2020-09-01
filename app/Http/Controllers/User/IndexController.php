<?php

namespace App\Http\Controllers\User;

use App\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{

    public function index(){
        $product = Product::orderBy('created_at','DESC')->get();
        if(session('success_message')){
            Alert::success('Success Title', 'Success Message');
        }
        return view('user.home')->with(['product' => $product]);
    }

    public function gen_session(){
        if (!Cookie::get('unique_session')) {
            Cookie::queue('unique_session', md5(date('Y-m-d H:i:s')), config('sp.cookie_time'));
        }
    }

    public function remove_session(){

        if (Cookie::get('unique_session')) {
            Cookie::queue('unique_session', null, 0);
        }

        return redirect()->back();
    }
}
