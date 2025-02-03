<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    use HasFactory;
    protected $table = "course_material";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'course_id',   
        'file',
        'description', 
        'status',      
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
