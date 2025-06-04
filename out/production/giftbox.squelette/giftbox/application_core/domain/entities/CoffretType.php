<?php
namespace giftbox\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class CoffretType extends Model {
    protected $table = 'coffret_type';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'libelle',
        'description'
    ];

    public function prestations(){
        return $this->belongsToMany(
            Prestation::class,
            'coffret2presta',
            'coffret_id',
            'presta_id'
        );
    }
}