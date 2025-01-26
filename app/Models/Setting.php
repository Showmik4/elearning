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
    ];
}
