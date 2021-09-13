<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDDETINGRESO
 * @property int $IDCABINGRESO
 * @property int $IDPRODUCTO
 * @property int $IDEMPRESA
 * @property float $CANTIDAD
 * @property float $COSTO
 * @property float $SUBTOTAL
 * @property float $IVA
 * @property float $DESCUENTO
 * @property float $NETO
 * @property GEOCABINGRESO $gEOCABINGRESO
 */
class GEOCDETINGRESO extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEODETINGRESO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETINGRESO';

    /**
     * @var array
     */
    protected $fillable = ['IDCABINGRESO', 'IDPRODUCTO', 'CANTIDAD', 'COSTO', 'SUBTOTAL', 'IVA', 'DESCUENTO', 'NETO','IDEMPRESA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCABINGRESO()
    {
        return $this->belongsTo('App\GEOCABINGRESO', 'IDCABINGRESO', 'IDCABINGRESO');
    }
}
