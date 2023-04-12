<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Major;
use App\Models\PersonalData;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormAlumni extends Component
{
    public $questions;
    public $fill;
    public $answers;
    public $personalData;
    public $majors;
    public $alumni;
    public $currentStep = 1;

    public $email;

    public $major = "";
    public $address;
    public $birth_date;
    public $phone;

    public $survey = [];

    protected $listeners = ['currentStepChanged'];

    public function updateData($data)
    {
        // $this->setCurrentStep();
    }


    public function mount()
    {

        $this->currentStep = session()->get('currentStep', 1);
        $this->email = Auth::user()->email;

        // dd($this->personalData);

        if ($this->personalData) {
            $this->major = $this->personalData->major_id;
            $this->address = $this->personalData->address;
            $this->birth_date = $this->personalData->birth_date;
            $this->phone = $this->personalData->phone;
        }

        if ($this->questions) {
            foreach ($this->questions as $question) {
                $answer = $this->answers->where('question_id', $question->id)->first();
                if (isset($answer->fill)) {
                    $fill = $answer->fill;
                    $this->survey[$question->id] = $fill;
                }
            }
        }
    }

    public function setCurrentStep($step)
    {
        $this->currentStep = $step;
        session()->put('currentStep', $step);
    }

    public function currentStepChanged($step)
    {
        $this->setCurrentStep($step);
    }

    public function back($step)
    {
        $this->setCurrentStep($step);
    }

    public function render()
    {
        $finished_filling = User::where('role', 'ALUMNI')->has('answers', '>=', Question::count())->count();

        return view('livewire.form-alumni', [
            'finish' => $finished_filling,
            'questions' => $this->questions,
            'answers' => $this->answers,
            'majors' => $this->majors,
            'alumni' => $this->alumni,
            'personalData' => $this->personalData,
        ]);
    }


    public function firstStepSubmit()
    {

        $this->validate([
            'email' => 'required',
            'major' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

        if (isset($this->email)) {
            $user = User::findOrFail(auth()->user()->id);
            $user->update(['email' => $this->email]);
        }

        PersonalData::updateOrCreate(
            ['user_id' => auth()->user()->id,],
            [
                'major_id' => $this->major,
                'address' => $this->address,
                'birth_date' => $this->birth_date,
                'phone' => $this->phone,
            ]
        );

        $this->setCurrentStep(2);
    }

    public function secondStepSubmit()
    {

        $this->validate([
            'survey.*' => 'required',
        ]);

        // dd($this->survey);

        $user = auth()->user();

        foreach ($this->survey as $question_id => $fill) {
            Answer::updateOrCreate([
                'user_id' => $user->id,
                'question_id' => $question_id,
            ], [
                'fill' => $fill,
            ]);
        }

        $this->setCurrentStep(3);
    }

    public function thirdStepSubmit()
    {

        $this->validate([
            'survey.*' => 'required',
        ]);

        // dd($this->survey);

        $user = auth()->user();

        foreach ($this->survey as $question_id => $fill) {
            Answer::updateOrCreate([
                'user_id' => $user->id,
                'question_id' => $question_id,
            ], [
                'fill' => $fill,
            ]);
        }

        // session(['message', 'Survey answers updated successfully!']);
        session()->flash('message', 'Data Berhasil Di Simpan.');
    }
}
