<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name", "url", "user_id", "deleted_by", "category_id", "role_id", "department_id",
    ];

    public function categories()
    {
        return $this->belongsTo(FileCategory::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_file');
    }

    public function access_level()
    {
        return $this->belongsToMany(Role::class, 'role_file');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

//    add deleted by
}
