<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    use HasFactory;
    protected $table = 'chat_groups';
    protected $fillable = [
        'messages','user_id','receiver_id','status'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
