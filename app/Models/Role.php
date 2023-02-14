<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function files()
    {
        return $this->belongsToMany(File::class, 'role_file');
    }

    public function permissions() {

        return $this->belongsToMany(Permission::class,'role_permission');

    }


}
