<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "url", "user_id", "deleted_by", "category_id", "role_id", "department_id",
    ];

    public function categories()
    {
        return $this->belongsTo(FileCategory::class);
    }

    public function departments()
    {
        return $this->belongsTo(Department::class);
    }

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

//    add deleted by
}
