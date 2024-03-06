<?php

namespace App\Http\Controllers;

use App\Mail\SurvayInvitationMail;
use App\Mail\SurvayReminderMail;
use App\Models\Role;
use App\Models\Survey;
use App\Models\SurveyCategory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;

class superadminController extends Controller
{
    public function index()
    {
        $allUsers = User::where('role_id', '!=', 1)->get();

        return view('superAdmin.dashboard', compact(['allUsers']));
    }

    public function allUsers(Request $request)
    {
        $role_id = $request->role_id;
        $roleName = Role::findOrFail($role_id)->role_name;
        return view('superAdmin.userManagement', compact(['role_id', 'roleName']));
    }

    public function addUser()
    {
        return view('dashboard.adduser');
    }

    public function editUser(Request $request)
    {
        $userId = $request->userId;
        return view('dashboard.edituser', compact(['userId']));
    }


    public function allSurvay(Request $request)
    {
        return view('superAdmin.survayManagemnet');
    }

    public function viewSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('superAdmin.viewSurvay', compact(['survey']));
    }

    public function createSurvay(Request $request)
    {
        $survayCategories = SurveyCategory::all();

        return view(
            'superAdmin.createSurvay',
            compact([
                'survayCategories'
            ])
        );
    }

    public function sendSurvayInvite(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $survay = Survey::first();

        if ($user->inviteSend){
            Mail::to($user)->send(new SurvayReminderMail());
            return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        }

        $response = Password::sendResetLink(["email" => $user->email]);

        if ($response == Password::RESET_LINK_SENT) {
            $user->update(['inviteSend' => true]);
            return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay link sent to ' . $user->name . ' email (' . $user->email . ')');
        } else {
            return redirect()->route('UserManagement', ['role_id' => 1])->with('error_message', 'Unable to send  link');
        }
    }
}
