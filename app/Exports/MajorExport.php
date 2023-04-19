<?php

namespace App\Exports;

use App\Models\Major;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MajorExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $majors = Major::with('typeSchool')->get();
        // $type_schools = TypeSchool::all();
        $headers = ['ID', 'Lembaga', 'Jurusan', 'Tahun Pergantian'];
        $data = [];

        foreach ($majors as $major) {
            $data[] = [
                $major->id,
                $major->typeSchool->name,
                $major->name,
                $major->expired_year == 'NOW' ? 'Masih Sampai Sekarang' : $major->expired_year,
            ];
        }
        return view('pages.admin.exports.major-excel', compact('headers', 'data'));
    }
}
