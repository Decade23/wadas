<?php

namespace App\Models\Apl\Exams;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $table = 'exam_question';

    protected $fillable = [
        'id', 'exam_question_id', 'answer_type', 'answer_desc', 'written_by', 'updated_by', 'visibility', 'created_at', 'updated_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function scopeByVisibility($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }
}
