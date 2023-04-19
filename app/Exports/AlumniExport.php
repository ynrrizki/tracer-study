<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AlumniExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $alumnus = User::with('personalData', 'answers')->where('role', 'ALUMNI')->get();
        $survey = Question::where('category_id', 4)->orderBy('order', 'ASC')->get();
        $feedback = Question::where('category_id', 5)->orderBy('order', 'ASC')->get();
        return view('pages.admin.exports.alumni-excel', compact('alumnus', 'survey', 'feedback'));
    }
}
