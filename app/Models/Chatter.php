<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'sent_at',
        'class_name',
        'class_record_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
