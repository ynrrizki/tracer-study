<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionInput;
use App\Models\Question;
use App\Models\TypeInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(): View
    {
        $surveyQuestions = Question::with('optionInputs')->where('category_id', '4')->get();
        $feedBackQuestions = Question::with('optionInputs')->where('category_id', '5')->get();
        $typeInputs = TypeInput::all();
        return view('pages.admin.questions.index', compact('surveyQuestions', 'feedBackQuestions', 'typeInputs'));
    }

    public function save(Request $request)
    {
        $question = Question::updateOrCreate(['id' => $request->id], [
            'category_id' => $request->category,
            'type_input_id' => $request->type_input,
            'name' => $request->name,
        ]);

        if (in_array($question->type_input_id, [2, 3, 4])) {
            for ($i = 1; $i <= 2; $i++) {
                OptionInput::create([
                    'question_id' => $question->id,
                    'name' => 'option input ' . $i,
                ]);
            }
        }
        return redirect()->route('admin.question');
        // return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $question = Question::findOrFail($request->id);
        if (in_array($question->type_input_id, [2, 3, 4])) {
            $optionInput = OptionInput::where('question_id', $question->id);
            $optionInput->delete();
        }
        $question->delete();

        return back();
    }
}
