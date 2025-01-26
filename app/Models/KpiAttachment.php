<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiAttachment extends Model
{
    use HasFactory;
    protected $table = "kpi_attachment";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'fk_kpi_id','file',       
    ];
}
