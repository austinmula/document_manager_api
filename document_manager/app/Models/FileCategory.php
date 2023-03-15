<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    use HasFactory;
    protected $table = 'file_categories';

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
