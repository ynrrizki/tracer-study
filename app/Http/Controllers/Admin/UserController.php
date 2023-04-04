<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeSchool;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $users = User::where('role', 'ADMIN')->get();
        $users = User::where('role', 'ALUMNI')->get();
        return view('pages.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->only(['name', 'nik', 'email', 'type_school_id']);
        $data['password'] = bcrypt($data['nik']);
        $data['role'] = 'ALUMNI';

        // dd($data);

        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        $type_schools = TypeSchool::all();
        return view('pages.admin.users.edit', compact('user', 'type_schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'nik', 'email', 'type_school_id']);
        $user = User::findOrFail($id);
        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back();
    }
}
