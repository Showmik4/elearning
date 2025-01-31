<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = "about";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'banner_description',   
        'about_description', 
        'image',      
    ];
}
