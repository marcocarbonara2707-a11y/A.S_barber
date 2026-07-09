<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Haircut extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image_path',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}