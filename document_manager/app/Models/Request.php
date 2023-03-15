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
    public function approver()
    {
        return $this->belongsTo(User::class, 'request_to');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
