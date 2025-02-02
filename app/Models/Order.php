<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'course_id', 
        'user_id',
        'total_price',
        'payment_method',
        'note'      
    ];
}
