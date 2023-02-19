<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    public function files()
    {
        return $this->belongsTo(File::class, 'status_id');
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class);
    }
}
