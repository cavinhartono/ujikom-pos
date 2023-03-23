<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = [
        'type',
        'user_id',
        'title',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
