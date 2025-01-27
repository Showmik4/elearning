<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $table = "trainer";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'name',   
        'field', 
        'description', 
        'image',           

    ];

}
