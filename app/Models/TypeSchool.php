<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSchool extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function majors()
    {
        return $this->hasMany(Major::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
