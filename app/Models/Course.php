<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;   
    protected $table = "course";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'title',   
        'short_details', 
        'long_details', 
        'category_id', 
        'trainer_id', 
        'total_seat', 
        'available_seat', 
        'schedule', 
        'details_page_banner_description',      

    ];
}
