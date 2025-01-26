<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class RolePermission extends Model
{
    use HasFactory;
    protected $table = "role_permission";
    protected $primaryKey = "role_permission_id";
    public $timestamps = false;
    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    public function permission()
    {
        return $this->hasOne('App\Models\Permission', 'id', 'permission_id');
    }
}
