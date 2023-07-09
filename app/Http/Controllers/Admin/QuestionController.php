<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionInput;
use App\Models\Question;
use App\Models\TypeInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(): View
    {
        $surveyQuestions = Question::with('optionInputs')->orderBy('order', 'ASC')->where('category_id', '4')->get();
        $feedBackQuestions = Question::with('optionInputs')->orderBy('order', 'ASC')->where('category_id', '5')->get();
        $typeInputs = TypeInput::all();
        return view('pages.admin.questions.index', compact('surveyQuestions', 'feedBackQuestions', 'typeInputs'));
    }

    public function save(Request $request)
    {
        $question = Question::updateOrCreate(['id' => $request->id], [
            'category_id' => $request->category ?? 4,
            'type_input_id' => $request->type_input,
            'name' => $request->name,
            'required' => $request->required,
        ]);
        $question->update(['order' => $question->id]);
        $option_input = OptionInput::where('question_id', $question->id);

        // membuat opsi input apabila opsi input tidak tersedia
        if (count($option_input->get()) < 1 && in_array($question->type_input_id, [2, 3, 4])) {
            for ($i = 1; $i <= 2; $i++) {
                OptionInput::create([
                    'question_id' => $question->id,
                    'name' => 'option input ' . $i,
                ]);
            }
        }

        // tersedia opsi input lalu type input text dan date, maka opsi input harus dihapus
        if (count($option_input->get()) > 0 && in_array($question->type_input_id, [1, 5])) {
            $option_input->delete();
        }

        return redirect()->route('admin.question');
    }

    public function destroy(Request $request)
    {
        $question = Question::findOrFail($request->id);
        if (in_array($question->type_input_id, [2, 3, 4])) {
            $optionInput = OptionInput::where('question_id', $question->id);
            $optionInput->delete();
        }
        $question->delete();

        return redirect()->back();
    }

    public function order(Request $request)
    {
        $data = Question::all();
        foreach ($data as $row) {
            foreach ($request->order as $order)
                if ($order['id'] == $row->id) {
                    $row->update(['order' => $order['position']]);
                }
        }

        return response()->json(['success' => true]);
    }
}
