<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'fotoTitel', 'fotoFileName', 'userId', 'fotoOmschrijving', 'cameraId', 'fotoBeheerderBlock', 'keywords'
    ];
    
    public function camera()
    {
        return $this->belongsTo('App\Camera', 'cameraId', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'userId', 'id');
    }

    public function recensies()
    {
        return $this->hasMany('App\Recensie');
    }
}
