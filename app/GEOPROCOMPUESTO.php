<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDDETALLE
 * @property int $IDPRODUCTO
 * @property string $CODPRINCIPAL
 * @property string $NOMBREPRODUCTO
 * @property float $CANTIDAD
 */
class GEOPROCOMPUESTO extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOPROCOMPUESTO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETALLE';

    /**
     * @var array
     */
    protected $fillable = ['IDPRODUCTO', 'CODPRINCIPAL', 'NOMBREPRODUCTO', 'CANTIDAD'];

}
