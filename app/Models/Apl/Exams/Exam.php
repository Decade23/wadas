<?php

namespace App\Models\Apl\Exams;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
      'id', 'product_id', 'title', 'price', 'slug', 'desc', 'written_by', 'updated_by', 'visibility', 'created_at', 'updated_at'
    ];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = preg_replace('/[^0-9-.]+/', '', $value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function examDetails() {
        return $this->hasMany(ExamQuestion::class, 'exam_id','id');
    }

    public function examSingleDetails() {
        return $this->hasOne(ExamQuestion::class, 'exam_id','id')->orderBy('created_at', 'ASC');
    }

    public function products() {
        return $this->hasMany(Product::class,'id','product_id');
    }

    public function singleProduct() {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function scopeWithProduct($query) {
        return $query->join('products','products.id','=','exams.product_id');
    }

    public function scopeWithExamQuestionAndAnswer($query) {
        return $query->join('exam_question','exam_question.exam_id','=','exams.id')
                    ->join('exam_answer','exam_answer.exam_question_id','=','exam_question.id')
                    ->where('exams.visibility','publish')
                    ->orwhere('exam_question.visibility','publish')
                    ->orwhere('exam_answer.visibility','publish');
    }

    public function scopeByVisibility($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }
}
