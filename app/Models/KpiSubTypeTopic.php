<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiSubTypeTopic extends Model
{
    use HasFactory;

    protected $table = "kpi_subtype_topic";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'fk_subtype_id','topic_name',       
    ];

    public function subtype()
    {
        return $this->belongsTo(KpiSubType::class, 'fk_subtype_id', 'id');
    }
}
