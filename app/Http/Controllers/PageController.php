<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{

    public function login() //Just redirection not a functionality
    {
        return view('pages/login');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function logout() //Just redirection not a functionality
    {
        return view('pages/login');
    }
}
