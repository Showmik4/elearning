<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiFeedbackAttachment extends Model
{
    use HasFactory;
    protected $table = "kpi_feedback_attachment";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'fk_kpi_assign_id','fk_kpi_id','file',       
    ];
}
