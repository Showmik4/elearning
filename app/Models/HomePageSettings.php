<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSettings extends Model
{
    use HasFactory;
    protected $table = "home_page_settings";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'banner_image',   
        'banner_short_text', 
        'banner_large_text', 
        'about_image', 
        'about_description', 
        'why_chose_us_description', 
        'feature_1', 
        'feature_2',
        'feature_3', 
       
    ];
}
