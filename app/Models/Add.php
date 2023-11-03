<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'photo',
        'price',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
{
    return $this->hasMany(Photo::class);
}

}

