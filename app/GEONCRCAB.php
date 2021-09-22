<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SECUENCIALNCR
 * @property float $SUBTOTALBNCR
 * @property float $DESCUENTONCR
 * @property float $IVAFAC
 * @property float $NETOFAC
 * @property string $FECHAEMI
 * @property int $SECFACTURA
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
 * @property int $IDUSUARIO
 * @property int $MOTIVO
 * @property int $IDEMPRESA
 * @property int $IDBODEGA
 * @property GEOUSUARIO $gEOUSUARIO
 * @property GEONCRDET[] $gEONCRDETs
 */
class GEONCRCAB extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEONCRCAB';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'SECUENCIALNCR';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['SUBTOTALBNCR', 'DESCUENTONCR', 'IVAFAC', 'NETOFAC', 'FECHAEMI', 'SECFACTURA', 'CLAVEACCESO', 'NOAUTORIZACION', 'ARCHIVOXML', 'FIRMAXML', 'ARCHIVOAUTORIZADO', 'ARCHIVOPDF', 'ARCHIVOERROR', 'CODERROR', 'FECHAPROCESO', 'HORAPROCESO', 'ESTADOPROCESO', 'IDUSUARIO', 'MOTIVO', 'IDEMPRESA', 'IDBODEGA'];

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
    public function gEONCRDETs()
    {
        return $this->hasMany('App\GEONCRDET', 'SECUENCIALNCR', 'SECUENCIALNCR');
    }
}
