<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesPermission extends Model
{
    public $table = 'roles_permission';
    
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

}
