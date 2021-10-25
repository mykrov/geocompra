<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int $IDTICKET
 * @property int $IDUSUARIO
 * @property string $COMENTARIO
 * @property string $IMAGENSOPORTE1
 * @property string $IMAGENSOPORTE2
 * @property string $IMAGENSOPORTE3
 * @property string $ATENDIDO
 * @property GEOUSUARIO $gEOUSUARIO
 * @property GEOEMPRESA[] $gEOEMPRESAs
 * @property GEOPARROQUIUM[] $gEOPARROQUIAs
 */
 class GEOSOPORTE extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'GEOSOPORTE';

/**
     * The primary key for the model.
     *
     * @var string
     */
     protected $primaryKey = 'IDTICKET';

    /**
     * @var array
     */
    protected $fillable = ['IDUSUARIO', 'COMENTARIO', 'IMAGENSOPORTE1', 'IMAGENSOPORTE2', 'IMAGENSOPORTE3','ATENDIDO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function gEOUSUARIO()
    {
        return $this->belongsTo('App\GEOUSUARIO', 'IDUSUARIO', 'IDUSUARIO');
    }
}
