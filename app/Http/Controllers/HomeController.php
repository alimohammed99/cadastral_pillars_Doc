<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Category;

use App\Models\PillarInformation;

class HomeController extends Controller
{
    public function redirect(){
        $usertype = Auth::user()->usertype;
        $status = Auth::user()->status;

        if($usertype == '1'){
            $categories = Category::withCount('pillars')->get();
            return view('admin.home', compact('categories'));
        }else{
            return view('user.home');
        }

    }


    public function index(){
        return view('user.home');
    }
}