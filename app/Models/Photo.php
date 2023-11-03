<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'add_id',
        'filename',
    ];

    public function add()
    {
        return $this->belongsTo(Add::class);
    }
}