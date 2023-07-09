<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MajorExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelImportRequest;
use App\Http\Requests\MajorRequest;
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
    public function store(MajorRequest $request)
    {
        $data = $request->only(['type_school_id', 'name', 'expired_year']);
        $data['expired_year'] = $data['expired_year'] ?? 'NOW';
        Major::create($data);

        return redirect()->route('major.index')->with('success', 'Data berhasil ditambahkan!');
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
    public function update(MajorRequest $request, string $id)
    {
        $data = $request->only(['type_school_id', 'name', 'expired_year']);
        $major = Major::findOrFail($id);

        $major->update($data);

        return redirect()->route('major.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = Major::findOrFail($id);

        $major->delete();

        return redirect()->route('major.index')->with('success', 'Data berhasil dihapus!');
    }

    public function fileImport(ExcelImportRequest $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new MajorImport;

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return back()->with('failures', $failures);
        }
        return redirect()->route('major.index')->with('success', 'Data berhasil di import!');
    }

    public function fileExport()
    {
        return Excel::download(new MajorExport, 'Jurusan.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
