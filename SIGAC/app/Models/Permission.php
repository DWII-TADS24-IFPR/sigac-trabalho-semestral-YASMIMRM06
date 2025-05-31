<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Resource;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['role_id', 'resource_id', 'permission'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

}
