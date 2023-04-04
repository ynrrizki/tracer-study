<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// use Illuminate\Contracts\Support\Responsable;
// use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Excel;

// class AlumniExport implements FromCollection, Responsable, WithHeadings
// {
//     use Exportable;

//     /**
//      * It's required to define the fileName within
//      * the export class when making use of Responsable.
//      */
//     private $fileName = 'invoices.xlsx';

//     /**
//      * Optional Writer Type
//      */
//     private $writerType = Excel::XLSX;

//     /**
//      * Optional headers
//      */
//     private $headers = [
//         'Content-Type' => 'text/csv',
//     ];

//     public function headings(): array
//     {
//         return [
//             '#',
//             'Nama',
//             'Email',
//             'NIS',
//             'Level',
//             '',
//             'Created At',
//             'Updated At',
//         ];
//     }

//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         return User::with('personalData', 'answers')->where('level', 'ALUMNI')->get();
//     }
// }


class AlumniExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $alumnus = User::with('personalData', 'answers')->where('role', 'ALUMNI')->get();
        $questions = Question::all();
        return view('pages.admin.exports.alumni-excel', compact('alumnus', 'questions'));
    }
}
