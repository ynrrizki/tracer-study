<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function personalData()
    {
        return $this->hasMany(PersonalData::class);
    }

    public function typeSchool()
    {
        return $this->belongsTo(TypeSchool::class);
    }
}
