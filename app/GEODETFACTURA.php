<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDDETFACTURA
 * @property int $SECUENCIALFAC
 * @property int $NUMEROFAC
 * @property int $LINEA
 * @property int $IDITEM
 * @property float $CANTIDAD
 * @property float $PRECIO
 * @property float $SUBTOTAL
 * @property float $DESCUENTO
 * @property float $IVA
 * @property float $NETO
 * @property float $PORDESCUENTO
 * @property float $PORIVA
 * @property string $GRABAIVA
 * @property int $IDEMPRESA
 * @property int $IDBODEGA
 * @property GEOCABFACTURA $gEOCABFACTURA
 * @property GEOPRODUCTO $gEOPRODUCTO
 */
class GEODETFACTURA extends Model
{
    public $timestamps =false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEODETFACTURA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETFACTURA';

    /**
     * @var array
     */
    protected $fillable = ['SECUENCIALFAC', 'NUMEROFAC', 'LINEA', 'IDITEM', 'CANTIDAD', 'PRECIO', 'SUBTOTAL', 'DESCUENTO', 'IVA', 'NETO', 'PORDESCUENTO', 'PORIVA', 'GRABAIVA', 'IDEMPRESA', 'IDBODEGA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCABFACTURA()
    {
        return $this->belongsTo('App\GEOCABFACTURA', 'SECUENCIALFAC', 'SECUENCIAL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPRODUCTO()
    {
        return $this->belongsTo('App\GEOPRODUCTO', 'IDITEM', 'IDPRODUCTO');
    }
}
