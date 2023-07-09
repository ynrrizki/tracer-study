<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Major;
use App\Models\PersonalData;
use App\Models\Question;
use App\Models\User;

class AlumniController extends Controller
{


    public function index()
    {
        $alumni = User::userNow()->where('role', 'ALUMNI')->first();
        $answers = Answer::where('user_id', $alumni->id)->select('fill', 'question_id')->get();
        $personalData = PersonalData::where('user_id', $alumni->id)->first();
        $majors = Major::expired()->get();
        $questions = Question::with('optionInputs', 'answers', 'typeInput')
            ->orderBy('order', 'ASC')
            ->select('id', 'name', 'required', 'category_id', 'type_input_id', 'order')
            ->get();
        $isFinished = $alumni->answers->count() >= Question::count() ? true : false;

        return view('pages.alumni.index', compact(
            'personalData',
            'answers',
            'alumni',
            'majors',
            'questions',
            'isFinished'
        ));
    }
}
