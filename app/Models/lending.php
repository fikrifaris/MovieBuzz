<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lending extends Model
{
    use HasFactory;

    protected $table = "lending";

    protected $fillable = [
        'movie_id',
        'member_id',
        'lending_date',
        'lateness_charge'
    ];

    public function movies()
        {
            return $this->belongsTo('App\Models\movies', 'movie_id', 'id');
        }

        public function members()
        {
            return $this->belongsTo('App\Models\members', 'member_id', 'id');
        }
}
