<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SECUENCIAL
 * @property int $IDEMPRESA
 * @property int $IDSUCURSAL
 * @property string $TIPODOC
 * @property int $NUMEROFAC
 * @property float $SUBTOTALFAC
 * @property float $DESCUENTOFAC
 * @property float $IVAFAC
 * @property float $SUBTOTAL0
 * @property string $FECHAEMI
 * @property string $FECHAVEN
 * @property int $CLIENTE
 * @property string $OBSERVACION
 * @property string $CLAVEACCESO
 * @property string $NOAUTORIZACION
 * @property string $ARCHIVOXML
 * @property string $FIRMAXML
 * @property string $ARCHIVOAUTORIZADO
 * @property string $ARCHIVOPDF
 * @property string $ARCHIVOERROR
 * @property string $CODERROR
 * @property string $FECHAPROCESO
 * @property string $HORAPROCESO
 * @property string $ESTADOPROCESO
 * @property int $FORMAPAGO
 * @property string $ESTADOPAGO
 * @property float $NETOFAC
 * @property int $IDUSUARIO
 * @property string $ESTADOENTREGA
 * @property float $LATITUD
 * @property float $LONGITUD
 * @property GEOCLIENTE $gEOCLIENTE
 * @property GEOCOMISIONE[] $gEOCOMISIONEs
 * @property GEODETFACTURA[] $gEODETFACTURAs
 * @property GEOGUIACAB[] $gEOGUIACABs
 */
class GEOCABFACTURA extends Model
{
    public $timestamps =false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOCABFACTURA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'SECUENCIAL';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['IDEMPRESA', 'IDSUCURSAL', 'TIPODOC', 'NUMEROFAC', 'SUBTOTALFAC', 'DESCUENTOFAC', 'IVAFAC', 'SUBTOTAL0', 'FECHAEMI', 'FECHAVEN', 'CLIENTE', 'OBSERVACION', 'CLAVEACCESO', 'NOAUTORIZACION', 'ARCHIVOXML', 'FIRMAXML', 'ARCHIVOAUTORIZADO', 'ARCHIVOPDF', 'ARCHIVOERROR', 'CODERROR', 'FECHAPROCESO', 'HORAPROCESO', 'ESTADOPROCESO', 'FORMAPAGO', 'ESTADOPAGO', 'NETOFAC', 'IDUSUARIO', 'ESTADOENTREGA', 'LATITUD', 'LONGITUD'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCLIENTE()
    {
        return $this->belongsTo('App\GEOCLIENTE', 'CLIENTE', 'IDCLIENTE');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOCOMISIONEs()
    {
        return $this->hasMany('App\GEOCOMISIONE', 'SECUENCIALFAC', 'SECUENCIAL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEODETFACTURAs()
    {
        return $this->hasMany('App\GEODETFACTURA', 'SECUENCIALFAC', 'SECUENCIAL');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOGUIACABs()
    {
        return $this->hasMany('App\GEOGUIACAB', 'SECUENCIALFAC', 'SECUENCIAL');
    }
}
