<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPI extends Model
{
    use HasFactory;
    protected $table = "kpi";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'fk_type_id','fk_subtype_id','fk_subtype_topic_id','date','added_by'       
    ];

    public function type()
    {
        return $this->belongsTo(KpiType::class, 'fk_type_id', 'id');
    }

    public function subtype()
    {
        return $this->belongsTo(KpiSubType::class, 'fk_subtype_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(KpiSubTypeTopic::class, 'fk_subtype_topic_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(KpiAttachment::class, 'fk_kpi_id', 'id');
    }



}
