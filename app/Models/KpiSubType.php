<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiSubType extends Model
{
    use HasFactory;
    protected $table = "kpi_subtype";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'fk_type_id','subtype_name',       
    ];

    public function type()
    {
        return $this->belongsTo(KpiType::class, 'fk_type_id', 'id');
    }
    public function topic()
    {
        return $this->hasMany(KpiSubTypeTopic::class, 'fk_subtype_id', 'id');
    }

}
