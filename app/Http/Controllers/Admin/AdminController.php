<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlumniExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelImportRequest;
use App\Imports\AlumniImport;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $alumnus = User::where('role', 'ALUMNI')
            ->select('grade_at')
            ->get();
        $questions = Question::with(['optionInputs', 'answers', 'answers.user'])
            ->latest()
            ->filter(request(['search_grade_at']))
            ->whereHas('typeInput', function ($query) {
                return $query
                    ->where('name', 'radio')
                    ->orWhere('name', 'select');
            })
            ->select('id', 'name')
            ->get();

        // Menghitung jumlah total baris dalam tabel `answers` dan menyimpannya dalam variabel
        $totalAnswers = Answer::count();

        // Menggunakan variabel $totalAnswers di beberapa bagian kode
        $currently_filling = User::where('role', 'ALUMNI')
            ->has('personalData', '>', 0)
            ->has('answers', '<', $totalAnswers)
            ->count();

        $finished_filling = User::where('role', 'ALUMNI')
            ->has('answers', '>=', $totalAnswers)
            ->count();


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
        $feedBackQuestions = Question::where('category_id', 5)->get();

        return view('pages.admin.show', compact('alumni', 'surveyQuestions', 'feedBackQuestions'));
    }
}
