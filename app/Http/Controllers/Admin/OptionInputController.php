<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionInput;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OptionInputController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        $optionNames = $request->optionName;
        $typeInputIds = $request->typeInputId;
        foreach ($optionNames as $index => $optionName) {
            OptionInput::updateOrCreate(['id' => $typeInputIds[$index], 'question_id' => $request->question_id], [
                'name' => $optionName,
            ]);
        }
        return back();
    }

    public function destroy(Request $request)
    {
        $optionInput = OptionInput::findOrFail($request->id);
        $optionInput->delete();

        return back();
    }
}
