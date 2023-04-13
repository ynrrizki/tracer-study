<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlumniExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelImportRequest;
use App\Imports\AlumniImport;
use App\Models\Answer;
use App\Models\OptionInput;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $alumnus = User::with('personalData', 'personalData.major', 'answers')->where('role', 'ALUMNI')->get();
        $answers = Answer::with('question', 'user')
            ->whereHas('question', function ($query) {
                return $query->whereHas('typeInput', function ($query) {
                    return $query
                        ->where('name', 'radio')
                        ->orWhere('name', 'select');
                });
            })
            ->get();
        $questions = Question::with(['optionInputs', 'answers', 'answers.user'])
            ->latest()
            ->filter(request(['search_grade_at']))
            ->whereHas('typeInput', function ($query) {
                return $query
                    ->where('name', 'radio')
                    ->orWhere('name', 'select');
            })
            ->get();

        // dd($questions);
        // return response()->json($questions);
        $currently_filling = User::where('role', 'ALUMNI')->has('personalData', '>', 0)->has('answers', '<', 3)->count();
        $finished_filling = User::where('role', 'ALUMNI')->has('answers', '>=', 3)->count();
        $survey_question = Question::where('category_id', 4)->count();
        $feedback_question = Question::where('category_id', 5)->count();
        $range_grade_at = [];
        foreach ($alumnus as $alumni) {
            array_push($range_grade_at, $alumni->grade_at);
        }

        $range_grade_at = array_unique($range_grade_at);
        $range_grade_at = array_reverse($range_grade_at);
        $range_grade_at = array_reverse($range_grade_at);

        $id = $request['id'] ?? 'null';

        return view('pages.admin.index', compact(
            'answers',
            'alumnus',
            'currently_filling',
            'finished_filling',
            'id',
            'questions',
            'range_grade_at',
            'survey_question',
            'feedback_question'
        ));
    }

    public function fileImport(ExcelImportRequest $request)
    {
        $file = $request->file('file')->store('public/import');

        $import = new AlumniImport;

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return back()->with('failures', $failures);
        }
        return redirect()->back()->with('notif', 'Data berhasil diimport!!');
    }

    public function fileExport()
    {

        return Excel::download(new AlumniExport, 'Alumni.xlsx', \Maatwebsite\Excel\Excel::XLSX);
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
