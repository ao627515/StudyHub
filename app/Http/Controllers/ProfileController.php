<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Uploader;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user = Auth::user();
        /**
         * @var Uploader|Administrator|Moderator $user
         */
        $user = $user->authUserSpecialisation();
        $user->load('role:id,name');
        if ($user->isUploader()) {
            $user->load('academicProgramLevel:id.academicProgram:id,name.university:id,name', 'academicProgramLevel:id.academicProgram:id,name.level:id,name');
        }
        return view('admin.pages.profile', compact('user'));
    }
}
