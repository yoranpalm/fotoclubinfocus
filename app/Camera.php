<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cameraMerk', 'cameraType'
    ];

    public function fotos()
    {
        return $this->hasMany('App\Foto');
    }
}
