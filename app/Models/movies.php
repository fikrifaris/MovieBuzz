<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    use HasFactory;

    protected $table = "movies";

    protected $fillable = [
        'title',
        'genre',
        'released_date'
    ];

    public function genres()
        {
            return $this->belongsTo('App\Models\genre', 'genre', 'id');
        }

}
