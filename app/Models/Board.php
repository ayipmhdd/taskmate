<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'visibility', 'user_id'];

    // Relasi ke pemilik board
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relasi ke user yang dishare
    public function sharedUsers()
    {
        return $this->belongsToMany(User::class, 'board_user');
    }
}