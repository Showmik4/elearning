<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = "answer";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'survey_id',
        'question_id', 
        'offered_answer_id',
        'fk_user_id',  
        'reference_no', 
        'feedback',        
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function question_point()
    {
        return $this->belongsTo(QuestionOption::class, 'offered_answer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'userId');
    }


}
