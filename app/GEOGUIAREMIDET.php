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
 * @property float $PORIVA
 * @property int $SECUENCIALGR
 */
class GEOGUIAREMIDET extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOGUIAREMIDET';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETNCR';

    /**
     * @var array
     */
    protected $fillable = ['IDEMPRESA', 'IDSUCURSAL', 'LINEA', 'IDITEM', 'CANTIDAD', 'PORIVA', 'SECUENCIALGR'];

}
