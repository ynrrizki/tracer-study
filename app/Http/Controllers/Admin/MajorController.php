<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MajorExport;
use App\Http\Controllers\Controller;
use App\Imports\MajorImport;
use App\Models\Major;
use App\Models\TypeSchool;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::with('typeSchool')->get();
        $type_schools = TypeSchool::all();
        $headers = ['Lembaga', 'Jurusan', 'Tahun Pergantian'];
        $data = [];

        foreach ($majors as $major) {
            $data[] = [
                $major->id,
                $major->typeSchool->name,
                $major->name,
                $major->expired_year == 'NOW' ? 'Masih Sampai Sekarang' : $major->expired_year,
            ];
        }
        return view('pages.admin.major.index', compact('data', 'headers', 'type_schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['type_school_id', 'name', 'expired_year']);
        $data['expired_year'] = $data['expired_year'] ?? 'NOW';
        Major::create($data);

        return redirect()->route('major.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $major = Major::findOrFail($id);

        return response()->json($major);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['type_school_id', 'name', 'expired_year']);
        $major = Major::findOrFail($id);

        $major->update($data);

        return redirect()->route('major.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = Major::findOrFail($id);

        $major->delete();

        return redirect()->route('major.index');
    }

    public function fileImport(Request $request)
    {
        Excel::import(new MajorImport, $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport()
    {

        return Excel::download(new MajorExport, 'Jurusan.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        // return Excel::download(new AlumniExport, 'alumni.csv', \Maatwebsite\Excel\Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
    }
}