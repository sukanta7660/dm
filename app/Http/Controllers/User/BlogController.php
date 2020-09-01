<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(){
        return view('user.blog');
    }


    public function single_blog(){
        return view('user.singleblog');
    }
}
