<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExcelImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'ADMIN';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'file' => 'required|mimetypes:text/csv,text/plain,application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/comma-separated-values,text/x-csv,application/octet-stream',
            'file' => 'required|mimetypes:text/csv,text/plain,application/csv,application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/comma-separated-values,text/x-csv,application/octet-stream,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.ms-excel.addin.macroEnabled.12,application/vnd.ms-excel.template.macroEnabled.12,application/vnd.ms-excel.sheet.binary.macroEnabled.12',
        ];
    }
}
