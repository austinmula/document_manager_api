<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        "name", "status_id", "file_id", "user_id","message", "response", "approved_by", "rejected_by"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }
    public function approval()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
    public function rejection()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function status(){}
}
