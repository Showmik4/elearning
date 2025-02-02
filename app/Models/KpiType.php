<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiType extends Model
{
    use HasFactory;
    protected $table = "kpi_type";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'type_name',       
    ];
}
