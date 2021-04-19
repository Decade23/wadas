<?php

namespace App\Models\Apl\Exams;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $table = 'exam_question';

    protected $fillable = [
        'exam_id', 'question', 'answer', 'written_by', 'updated_by', 'visibility', 'created_at', 'updated_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function examAnswer() {
        return $this->hasMany(ExamAnswer::class,'exam_question_id','id')
    }

    public function scopeByVisibility($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }
}
