<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_school_id', 'expired_year'];
    protected $with = ['typeSchool'];

    public function personalData()
    {
        return $this->hasMany(PersonalData::class);
    }

    public function typeSchool()
    {
        return $this->belongsTo(TypeSchool::class);
    }

    public function scopeExpired($query)
    {
        if (!$query->where('type_school_id', auth()->user()->type_school_id)
            ->where('expired_year', '>=', auth()->user()->grade_at)) {
            $query->where('type_school_id', auth()->user()->type_school_id)
                ->where('expired_year', 'NOW');
        }

        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     return $query->where(function ($query) use ($search) {
        //         $query->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('body', 'like', '%' . $search . '%');
        //     });
        // });
    }
}
