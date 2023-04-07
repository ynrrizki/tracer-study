<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlumniExport;
use App\Http\Controllers\Controller;
use App\Imports\AlumniImport;
use App\Models\Answer;
use App\Models\OptionInput;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $alumnus = User::with('personalData', 'personalData.major', 'answers')->where('role', 'ALUMNI')->get();
        $answers = Answer::with('question')->get();
        $questions = Question::with(['optionInputs', 'answers'])->where('type_input_id', 4)->get();
        $currently_filling = User::where('role', 'ALUMNI')->has('answers', '>', 0)->has('answers', '<', 3)->count();
        $finished_filling = User::where('role', 'ALUMNI')->has('answers', '>=', 3)->count();

        $id = $request['id'] ?? 'null';

        // dd($alumnus);

        // return response()->json($alumnus);
        return view('pages.admin.index', compact('answers', 'alumnus', 'currently_filling', 'finished_filling', 'id', 'questions'));
    }

    public function fileImport(Request $request)
    {
        Excel::import(new AlumniImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport()
    {

        return Excel::download(new AlumniExport, 'Alumni.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new AlumniExport, 'alumni.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
    }

    public function show($id)
    {
        $alumni = User::with(['personalData', 'personalData.major', 'answers'])->findOrFail($id);
        $surveyQuestions = Question::whereNotIn('category_id', [5])->get();
        // $surveyQuestions = Question::all();
        $feedBackQuestions = Question::where('category_id', 5)->get();
        // $personalData = $alumni->personalData->where('user_id', $alumni->id)->first();

        // $data = [];
        // foreach ($surveyQuestions as $key => $question) {
        //     $data[] = [
        //         $alumni->answers[$key + 1]->fill
        //         // $key + 1
        //     ];
        // }

        // return response()->json($alumni);

        return view('pages.admin.show', compact('alumni', 'surveyQuestions', 'feedBackQuestions'));
    }
}
