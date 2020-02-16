<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoCategorie extends Model
{
    public $timestamps = false;

    protected $table = 'foto_categorie';

    public function categorie()
    {
        return $this->hasOne(\App\Categorie::class, 'id', 'categorieId');
    }

    public function foto()
    {
        return $this->hasOne(\App\Foto::class, 'id', 'fotoId');
    }
}
