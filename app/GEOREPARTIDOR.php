<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDREPARTIDOR
 * @property int $IDUSUARIO
 * @property string $VEHICULO
 * @property string $PLACA
 * @property GEOUSUARIO $gEOUSUARIO
 */
class GEOREPARTIDOR extends Model
{
    public $timestamps =false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOREPARTIDOR';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDREPARTIDOR';

    /**
     * @var array
     */
    protected $fillable = ['IDUSUARIO', 'VEHICULO', 'PLACA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOUSUARIO()
    {
        return $this->belongsTo('App\GEOUSUARIO', 'IDUSUARIO', 'IDUSUARIO');
    }
}
