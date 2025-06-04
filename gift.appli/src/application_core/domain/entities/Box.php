<?php
namespace giftbox\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends Model {
    use HasUuids;

    protected $table = 'box';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'token', 'libelle', 'description', 'montant', 'kdo', 'message_kdo', 'statut', 'createur_id'
    ];

    public $timestamps = true;

    public function prestations() {
        return $this->belongsToMany(
            Prestation::class,
            'box_prestations',
            'box_id',
            'prestation_id'
        )->withPivot('quantite');
    }

    public function createur() {
        return $this->belongsTo(User::class, 'createur_id');
    }
}
