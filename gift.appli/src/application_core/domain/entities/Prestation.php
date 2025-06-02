<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Model;

class Prestation extends Model {
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['libelle', 'description', 'tarif', 'unite', 'url', 'img', 'cat_id'];

    public function coffrets() {
        return $this->belongsToMany(
            CoffretType::class,
            'coffret2presta',
            'presta_id',
            'coffret_id'
        );
    }

    public function categorie() {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }
}