<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionInput extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'name'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
