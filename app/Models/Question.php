<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = "question";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'title',
        'survey_id',      
    ];

    public function question_point()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }
}
