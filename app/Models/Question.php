<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'category_id', 'type_input_id', 'name', 'order', 'required'];

    protected $with = ['category', 'typeInput'];

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

    public function scopeFilter($query, array $filters)
    {
        // dd($filters['search_grade_at'] ? true : false);
        $query->when(
            $filters['search_grade_at'] ?? false,
            fn ($query, $search) => $query->whereHas(
                'answers',
                fn ($query) => $query->whereHas(
                    'user',
                    fn ($query) => $query->where('grade_at', $search)
                ),
            )
        );

        // return dd($query->whereHas('answers', function ($query) use ($search_grade_at) {
        //     $query->whereHas('user', function ($query) use ($search_grade_at) {
        //         $query->where('grade_at', $search_grade_at);
        //     });
        // })->toSql());

        // select * from `questions` where exists (select * from `answers` where `questions`.`id` = `answers`.`question_id` and
        // exists (select * from `users` where `answers`.`user_id` = `users`.`id` and `grade_at` = 2015)) order by `created_at`
        // desc;

        // select * from `questions` where exists (select * from `answers` where `questions`.`id` = `answers`.`question_id`) order by `created_at`
        // desc;
    }
}
