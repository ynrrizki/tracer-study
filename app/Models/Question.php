<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'type_input_id', 'name'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function optionInputs()
    {
        return $this->hasMany(OptionInput::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function typeInput()
    {
        return $this->belongsTo(TypeInput::class);
    }
}
