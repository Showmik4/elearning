<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolePermission;

class UserType extends Model
{
    use HasFactory;
    protected $table = "user_type";
    protected $primaryKey = "userTypeId";
    public $timestamps = false;
    protected $fillable = [
        'typeName',
    ];

    public function rolepermission()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'userTypeId'); 
    }

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, RolePermission::class, 'role_id', 'id', 'userTypeId', 'permission_id');
    }
}
