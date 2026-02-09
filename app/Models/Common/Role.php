<?php

namespace App\Models\Common;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'mst_role';
    protected $fillable = ['logical_code', 'role_name', 'is_active'];
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
