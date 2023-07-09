<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\PersonalData;
use App\Models\Question;
use Livewire\Component;

class FormAlumni extends Component
{
    public $isFinished;
    public $questions;
    public $fill;
    public $answers;
    public $personalData;
    public $majors;
    public $alumni;
    public $currentStep = 0;

    public $email;

    public $major = "";
    public $address;
    public $birth_date;
    public $phone;

    public $survey = [];

    public $listeners = ['currentStepChanged'];

    public function mount()
    {
        $this->currentStep = !$this->isFinished ? 1 : 0;
        $this->email = $this->alumni->email;

        if ($this->personalData) {
            $this->major = $this->personalData->major_id;
            $this->address = $this->personalData->address;
            $this->birth_date = $this->personalData->birth_date;
            $this->phone = $this->personalData->phone;
        }

        if ($this->answers) {
            $this->answers->each(function ($answer) {
                $this->survey[$answer->question_id] = $answer->fill;
            });
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

    public function render()
    {
        return view('livewire.form-alumni', [
            'isFinished' => $this->isFinished,
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
            'major' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

        if (isset($this->email) && $this->email != $this->alumni->email) {
            $this->validate(['email' => 'required|unique:users']);
            $this->alumni->update(['email' => $this->email]);
        }

        $personalData = PersonalData::firstOrNew(['user_id' => $this->alumni->id]);
        $personalData->major_id = $this->major;
        $personalData->address = $this->address;
        $personalData->birth_date = $this->birth_date;
        $personalData->phone = $this->phone;

        if ($personalData->isDirty()) {
            $personalData->save();
        }

        $this->setCurrentStep(2);
    }

    public function secondStepSubmit()
    {

        $this->answerUpdateOrCreate();

        $this->setCurrentStep(3);
    }

    public function thirdStepSubmit()
    {
        $this->answerUpdateOrCreate();

        session()->flash('message', 'Tracer Study Telah Selesai!');

        $this->isFinished = true;
        $this->setCurrentStep(0);
    }

    protected function answerUpdateOrCreate()
    {
        $this->validate([
            'survey.*' => 'required',
        ]);

        foreach ($this->survey as $question_id => $fill) {
            Answer::updateOrCreate(
                ['user_id' => $this->alumni->id, 'question_id' => $question_id],
                ['fill' => $fill]
            );
        }
    }
}
// protected function answerUpdateOrCreate()
// {
//     $this->validate([
//         'survey.*' => 'required',
//     ]);

//     // foreach ($this->survey as $question_id => $fill) {
//     //     $answer = Answer::firstOrNew(['user_id' => $this->alumni->id, 'question_id' => $question_id]);
//     //     $answer->fill = $fill;
//     // }

//     // if ($answer->isDirty()) {
//     //     $answer->save();
//     // }

//     foreach ($this->survey as $question_id => $fill) {
//         Answer::updateOrCreate([
//             'user_id' => $this->alumni->id,
//             'question_id' => $question_id,
//         ], [
//             'fill' => $fill,
//         ]);
//     }
// }

// public function secondStepSubmit()
    // {

    //     $this->validate([
    //         'survey.*' => 'required',
    //     ]);

    //     // dd($this->survey);

    //     // $user = auth()->user();
    //     $answer = new Answer;
    //     foreach ($this->survey as $question_id => $fill) {
    //         $answer = $answer->firstOrNew(['user_id' => $this->alumni->id, 'question_id' => $question_id]);
    //         $answer->fill = $fill;
    //         // Answer::updateOrCreate([
    //         //     'user_id' => $this->alumni->id,
    //         //     'question_id' => $question_id,
    //         // ], [
    //         //     'fill' => $fill,
    //         // ]);
    //     }

    //     if ($answer->isDirty()) {
    //         $answer->save();
    //     }

    //     $this->setCurrentStep(3);
    // }

    // public function thirdStepSubmit()
    // {

    //     $this->validate([
    //         'survey.*' => 'required',
    //     ]);

    //     // dd($this->survey);

    //     // $user = auth()->user();

    //     foreach ($this->survey as $question_id => $fill) {
    //         Answer::updateOrCreate([
    //             'user_id' => $this->alumni->id,
    //             'question_id' => $question_id,
    //         ], [
    //             'fill' => $fill,
    //         ]);
    //     }

    //     // session(['message', 'Survey answers updated successfully!']);
    //     session()->flash('message', 'Data Berhasil Di Simpan.');
    // }
