<?php

namespace App\Models\Common;

use App\Models\User;
use App\Models\Common\Role;
use Illuminate\Database\Eloquent\Model;

class UserRoleMapping extends Model
{
    protected $table = 'mst_user_role_mapping';
    protected $fillable = ['user_id', 'role_id', 'is_active'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
