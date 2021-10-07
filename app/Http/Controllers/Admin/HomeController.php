<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        if(Auth::check()){
            return view('admin.home.index');
        }

        return redirect()->route('admin.login');

        
    }
}
