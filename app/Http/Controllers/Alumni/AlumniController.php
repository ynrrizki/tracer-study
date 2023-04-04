<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Major;
use App\Models\PersonalData;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AlumniController extends Controller
{
    // public function index(): View
    // {
    //     return view('pages.alumni.index');
    // }

    public function index(): View
    {
        $majors = Major::where('type_school_id', Auth::user()->type_school_id)->get();
        $alumni = User::where('role', 'ALUMNI')->find(Auth::user()->id);
        $personalData = PersonalData::with('user')->find(Auth::user()->id);
        $questions = Question::with(['optionInputs', 'answers', 'category', 'typeInput'])->get();
        $answers = Answer::where('user_id', auth()->user()->id)->get();

        return view('pages.alumni.index', compact('alumni', 'questions', 'majors', 'personalData', 'answers'));
    }

    public function updateAlumniSurveyAnswers(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $question_id => $fill) {
            if ($fill) {
                Answer::updateOrCreate([
                    'user_id' => $user->id,
                    'question_id' => $question_id,
                ], [
                    'fill' => $fill,
                ]);
            }
        }

        return redirect()->back();
    }

    public function updateAlumniProfile(Request $request): RedirectResponse
    {
        $alumni = User::find(auth()->user()->id);
        $personalData = PersonalData::where('user_id', auth()->user()->id)->first();


        if ($personalData) {
            $personalData->update([
                'major_id' => $request->major,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
            ]);
        } else {
            PersonalData::create([
                'user_id' => auth()->user()->id,
                'major_id' => $request->major,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
            ]);
        }

        if ($request->email != $alumni->email) {
            $alumni->update([
                'email' => $request->email,
            ]);
        }

        return redirect()->back();
    }
}
