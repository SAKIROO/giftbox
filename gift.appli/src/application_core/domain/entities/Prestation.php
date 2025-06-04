<?php

namespace giftbox\application_core\domain\entities;

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

    public function boxes() {
        return $this->belongsToMany(
            Box::class,
            'box2presta',
            'presta_id',
            'box_id'
        )->withPivot('quantite');
    }


    public function categorie() {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }
}