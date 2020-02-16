<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recensie extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'fotoId';

    protected $fillable = [
        'fotoId', 'userId', 'recensieTekst', 'starRating'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'userId', 'id');
    }

    public function foto()
    {
        return $this->belongsTo('App\Foto', 'fotoId', 'id');
    }
}