<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Moderator;
use App\Models\Uploader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
}
