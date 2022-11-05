<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function dashboard()
    {
        return view('admin.home');
    }

    public function changelog()
    {
        return view('admin.changelog.other_changelog');
    }
}
