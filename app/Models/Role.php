<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name", "slug"];

    public function files()
    {
        return $this->belongsToMany(File::class, 'role_file');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class,'role_permission');
    }


}
