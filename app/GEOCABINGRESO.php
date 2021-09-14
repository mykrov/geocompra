<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDCABINGRESO
 * @property string $TIPODOC
 * @property int $MUMEROFAC
 * @property string $NOAUTORIZACION
 * @property string $BODEGAORIGEN
 * @property string $BODEGADESTINO
 * @property float $IVA
 * @property float $SUBTOTAL
 * @property float $DESCUENTO
 * @property float $NETO
 * @property string $FECHAEMI
 * @property string $HORAEMI
 * @property string $ESTADO
 * @property int $IDUSUARIO
 * @property GEOUSUARIO $gEOUSUARIO
 * @property GEODETINGRESO[] $gEODETINGRESOs
 */
class GEOCABINGRESO extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOCABINGRESO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDCABINGRESO';

    /**
     * @var array
     */
    protected $fillable = ['TIPODOC', 'MUMEROFAC', 'NOAUTORIZACION', 'BODEGAORIGEN', 'BODEGADESTINO', 'IVA', 'SUBTOTAL', 'DESCUENTO', 'NETO', 'FECHAEMI', 'HORAEMI', 'ESTADO', 'IDUSUARIO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOUSUARIO()
    {
        return $this->belongsTo('App\GEOUSUARIO', 'IDUSUARIO', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEODETINGRESOs()
    {
        return $this->hasMany('App\GEODETINGRESO', 'IDCABINGRESO', 'IDCABINGRESO');
    }
}
