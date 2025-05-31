<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Resource extends Model
{
    protected $table = "resources";
    protected $fillable = ['nome'];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

}
