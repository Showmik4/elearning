<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $primaryKey = "settingId";
    public $timestamps = false;
    protected $fillable = [
        'companyName',
        'email',
        'logo',
        'logoDark',
        'address',
        'phone',
        'twitter_link',
        'facebook_link',
        'instagram_link',
        'linkedin_link',
        'footer_text',
        'google_map_link', 
        'contact_page_banner_text',
        'trainer_page_banner_text',
        'course_page_banner_text',    
    ];
}
