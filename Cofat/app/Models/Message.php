<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    // app/Models/Message.php
protected $fillable = ['user_id', 'admin_id', 'message', 'reply', 'is_replied'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
}
