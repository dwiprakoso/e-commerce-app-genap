<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return view('member.page.home');
    }

    public function dashboard()
    {
        return view('member.page.dashboard');
    }
}
