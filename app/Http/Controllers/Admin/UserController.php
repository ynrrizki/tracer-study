<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlumniRequest;
use App\Mail\AlumniPPMail;
use App\Mail\ContactUsMail;
use App\Models\Answer;
use App\Models\Question;
use App\Models\TypeSchool;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $alumni = User::where('role', 'ALUMNI');
        $questions = Question::all();
        $type_schools = TypeSchool::all();
        // dd($questions->count());
        $currently_filling = User::where('role', 'ALUMNI')->has('personalData', '>', 0)->has('answers', '<', 3)->count();
        $finished_filling = User::where('role', 'ALUMNI')->has('answers', '>=', $questions->count())->count();

        $users = User::where('role', 'ALUMNI')->get();
        $headers = ['Status', 'Name', 'Nik', 'Email', 'Jurusan', 'Angkatan'];
        $data = [];

        foreach ($users as $user) {
            $data[] = [
                $user->id,
                $user->answers->count() >= $questions->count() ? '<span class="badge bg-label-success me-1">Completed</span>' : '<span class="badge bg-label-warning me-1">Pending</span>',
                $user->name,
                $user->nik,
                // "<a data-user='$user' data-bs-toggle='modal' data-bs-target='#attachMailModal' class='btn btn-label-dark sendMail'>" . $user->email . "</a>",
                $user->email,
                $user->personalData->major->name ?? '-',
                $user->grade_at,
                'active' => $user->answers->count() >= $questions->count() ? true : false,
            ];
        }
        return view('pages.admin.user.index', compact('headers', 'data', 'type_schools', 'currently_filling', 'finished_filling'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumniRequest $request): RedirectResponse
    {
        $data = $request->only(['name', 'nik', 'email', 'type_school_id', 'grade_at']);
        // dd($data);
        $data['password'] = bcrypt($data['nik']);
        $data['role'] = 'ALUMNI';

        // dd($data);

        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

        return view('pages.admin.user.show', compact('alumni', 'surveyQuestions', 'feedBackQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $user = User::findOrFail($id);
        // $type_schools = TypeSchool::all();
        // return view('pages.admin.user.edit', compact('user', 'type_schools'));

        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'nik', 'email', 'type_school_id']);
        $user = User::findOrFail($id);
        // $data['password'] = bcrypt($data['password']);
        if ($request->has('nik')) {
            $data['password'] = bcrypt($data['nik']);
        }
        $user->update($data);
        return redirect()->route('user.index');
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

    public function sendMail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $dataArray = [
            'name' => $user->name,
            'message' => $request->message
        ];
        $send = new AlumniPPMail($dataArray);
        $sendToEmail = $request->email;
        if (isset($sendToEmail) && !empty($sendToEmail) && filter_var($sendToEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($sendToEmail)->send($send);
        }

        return response()->json(['success' => true]);
    }
}
