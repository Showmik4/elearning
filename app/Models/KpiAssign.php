<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiAssign extends Model
{
    use HasFactory;

    protected $table = "kpi_assign";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'fk_kpi_id','fk_user_id','status','date','target','total_complete','assigned_by'       
    ];

    public function kpi()
    {
        return $this->belongsTo(KPI::class, 'fk_kpi_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'userId');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'userId');
    }

    public function documents()
    {
        return $this->hasMany(KpiFeedbackAttachment::class, 'fk_kpi_assign_id', 'id');
    }


}
