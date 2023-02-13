<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "url", "owner_id", "folder_id", "category_id"
    ];

    public function categories()
    {
        return $this->belongsTo(FileCategory::class);
    }
}
