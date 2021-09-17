<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDDETNCR
 * @property int $IDEMPRESA
 * @property int $IDSUCURSAL
 * @property int $LINEA
 * @property int $IDITEM
 * @property float $CANTIDAD
 * @property float $PRECIO
 * @property float $SUBTOTAL
 * @property float $DESCUENTO
 * @property float $IVA
 * @property float $NETO
 * @property float $PORIVA
 * @property float $GRABAIVA
 * @property int $SECUENCIALNCR
 * @property GEOPRODUCTO $gEOPRODUCTO
 * @property GEONCRCAB $gEONCRCAB
 */
class GEONCRDET extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEONCRDET';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETNCR';

    /**
     * @var array
     */
    protected $fillable = ['IDEMPRESA', 'IDSUCURSAL', 'LINEA', 'IDITEM', 'CANTIDAD', 'PRECIO', 'SUBTOTAL', 'DESCUENTO', 'IVA', 'NETO', 'PORIVA', 'GRABAIVA', 'SECUENCIALNCR'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPRODUCTO()
    {
        return $this->belongsTo('App\GEOPRODUCTO', 'IDITEM', 'IDPRODUCTO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEONCRCAB()
    {
        return $this->belongsTo('App\GEONCRCAB', 'SECUENCIALNCR', 'SECUENCIALNCR');
    }
}
