<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Uploader;
use App\Models\Moderator;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Validation\Rule;
use App\Services\UploaderService;
use App\Services\ModeratorService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AdministratorService;

class ProfileController extends Controller
{

    private UploaderService $uploaderService;
    private ModeratorService $moderatorService;
    private AdministratorService $adminService;

    public function __construct(
        UploaderService $uploaderService,
        ModeratorService $moderatorService,
        AdministratorService $adminService
    ) {
        $this->uploaderService = $uploaderService;
        $this->adminService = $adminService;
        $this->moderatorService = $moderatorService;
    }



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

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', Rule::unique('users')->ignore($user->id)]
        ]);

        /**
         * @var Uploader|Administrator|Moderator $user
         */
        $user = $user->authUserSpecialisation();

        if ($user->isAdmin())
            $this->adminService->update($user, $data);
        elseif ($user->isModerator())
            $this->moderatorService->update($user, $data);
        else
            $this->uploaderService->update($user, $data);


        return redirect()->back();
    }
}
