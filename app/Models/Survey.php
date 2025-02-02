<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = "survey";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'title',
        'description',      
    ];

    public function question()
    {
        return $this->hasMany(Question::class, 'survey_id', 'id');
    }
}
