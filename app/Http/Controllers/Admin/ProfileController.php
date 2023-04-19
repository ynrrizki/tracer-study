<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pages.admin.profile.index', compact('user'));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if ($request->has('name') && $request->has('email')) {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);
            $data = $validated;
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
        } else {
            $validated = $request->validate([
                'currentPass' => 'required',
                'password' => 'required|confirmed',
            ]);
            $data = $validated;
            if (Hash::check($data['currentPass'], $user->password)) {
                dd($data['password']);
                $data['password'] = bcrypt($data['password']);
                $user->update(['password' => $data['password']]);
            }
        }

        return redirect()->route('profile.admin')->with('message', 'Akun berhasil diupdate!!');
    }
}
