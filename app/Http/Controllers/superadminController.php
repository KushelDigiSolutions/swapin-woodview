<?php

namespace App\Http\Controllers;

use App\Mail\SurvayInvitationMail;
use App\Mail\SurvayReminderMail;
use App\Models\Question;
use App\Models\Role;
use App\Models\Survey;
use App\Models\SurveyCategory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSurvay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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

    public function responseSurvay(Request $request)
    {
        $usersurveys = UserSurvay::all();
        return view('superAdmin.survayResponse', compact(['usersurveys']));
    }

    public function editSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('superAdmin.editSurvey', compact(['survey']));
    }

    public function updateQuestion(Request $request)
    {

        try {
            $question = Question::findOrFail($request->id);
            $question->update($request->all());
            return back()->with('success_message', 'Question updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Failed to update question.');
        }
    }

    public function updateSurvay(Request $request)
    {

        $survey = Survey::findOrFail($request->id);
        $survey->update($request->all());
        return redirect()->route('editSurvay', ['Id' => $request->id]);
    }

    public function storeQuestion(Request $request)
    {

        Question::create($request->all());
        return back()->with('success_message', 'Question Added successfully.');
    }

    public function deleteQuestion(Request $request, $id)
    {

        $a = Question::destroy($id);
        if ($a) {
            return back()->with('success_message', 'Question deleted successfully.');
        }
        return back()->with('error_message', 'Something went worng.');
    }

    public function viewSurvay(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        return view('superAdmin.viewSurvay', compact(['survey']));
    }

    // public function viewSurvayStepOne(Request $request)
    // {
    //     $survey = Survey::findOrFail($request->Id);
    //     $part = "Part II"
    //     $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
    //     //dd($part,$questions);
    //     return view('survey.stepone', compact(['survey', 'part', 'questions']));
    // }

    public function viewSurvaySteptwo(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part II";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        //dd($part,$questions);
        return view('survey.steptwo', compact(['survey', 'part', 'questions']));
    }

    public function viewSurvayStepthree(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part III";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        //dd($part,$questions);
        return view('survey.stepthree', compact(['survey', 'part', 'questions']));
    }

    public function viewSurvayStepfour(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part IV";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        //dd($part,$questions);
        return view('survey.stepfour', compact(['survey', 'part', 'questions']));
    }

    public function viewSurvayStepfive(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part V";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        //dd($part,$questions);
        return view('survey.stepfive', compact(['survey', 'part', 'questions']));
    }

    public function viewSurvayStepsix(Request $request)
    {
        $survey = Survey::findOrFail($request->Id);
        $part = "Part VI";
        $questions = Question::where('survey_id', $survey->id)->where('part', $part)->get();
        //dd($part,$questions);
        return view('survey.stepsix', compact(['survey', 'part', 'questions']));
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


    public function createNewSurvay(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'integer', 'exists:survey_categories,id'], // Ensure category_id exists in the SurveyCategory model
            'title' => 'required|string',
            'description' => 'nullable|string', // Allow description to be nullable

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $a = Survey::create($request->all() + ['status' => "active", "user_id" => Auth::user()->id]);
        $survayCategories = SurveyCategory::all();

        if ($a) {
            return back()->with('success_message', 'Survey Created successfully.');
        }
        return back()->with('error_message', 'Something went worng.');
    }



    public function sendSurvayInvite(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $surveys = Survey::all();

        return view('superAdmin.assignSurvey', compact(['user', 'surveys']));



        // if ($user->inviteSend) {
        //     Mail::to($user)->send(new SurvayReminderMail());
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        // }

        // $response = Password::sendResetLink(["email" => $user->email]);

        // if ($response == Password::RESET_LINK_SENT) {
        //     $user->update(['inviteSend' => true]);
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay link sent to ' . $user->name . ' email (' . $user->email . ')');
        // } else {
        //     return redirect()->route('UserManagement', ['role_id' => 1])->with('error_message', 'Unable to send  link');
        // }
    }

    public function assignSurvey(Request $request)
    {
        try {
            // Assigning survey to the user
            UserSurvay::create([
                'user_id' => $request->user_id,
                'survey_id' => $request->survey_id,
                'percentCompleted' => 0
            ]);

            // Finding the user by their ID
            $user = User::find($request->user_id);

            // Updating inviteSend to true for the user
            $user->update(['inviteSend' => true]);

            // Sending a reminder email to the user
            Mail::to($user)->send(new SurvayReminderMail());

            // Return success response
            return redirect()->route('UserManagement', ['role_id' => 1])->with('success_message', 'Survay Reminder sent to ' . $user->name . ' email (' . $user->email . ')');
        } catch (\Exception $e) {
           
            // Return error response
            return redirect()->route('UserManagement', ['role_id' => 1])->with('error_message', 'Unable to send  link');
        }
    }
}
