<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $SECUENCIAL
 * @property string $ARCHIVOAUTORIZADO
 * @property string $ARCHIVOERROR
 * @property string $ARCHIVOPDF
 * @property string $ARCHIVOXML
 * @property string $CLAVEACCESO
 * @property string $CODERROR
 * @property string $ESTADOPROCESO
 * @property string $FECHAEMI
 * @property string $FECHAPROCESO
 * @property string $FIRMAXML
 * @property string $HORAPROCESO
 * @property int $IDEMPRESA
 * @property int $IDSUCURSAL
 * @property string $NOAUTORIZACION
 * @property int $SECUENCIALFAC
 * @property string $OBSERVACION
 * @property int $IDREPARTIDOR
 * @property int $IDUSUARIO
 * @property string $FECHAFIN
 * @property int $CODMOTIVO
 * @property GEOUSUARIO $gEOUSUARIO
 * @property GEOCABFACTURA $gEOCABFACTURA
 */
class GEOGUIACAB extends Model
{
    public $timestamps =false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOGUIACAB';

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
    protected $fillable = ['ARCHIVOAUTORIZADO', 'ARCHIVOERROR', 'ARCHIVOPDF', 'ARCHIVOXML', 'CLAVEACCESO', 'CODERROR', 'ESTADOPROCESO', 'FECHAEMI', 'FECHAPROCESO', 'FIRMAXML', 'HORAPROCESO', 'IDEMPRESA', 'IDSUCURSAL', 'NOAUTORIZACION', 'SECUENCIALFAC', 'OBSERVACION', 'IDREPARTIDOR', 'IDUSUARIO', 'FECHAFIN', 'CODMOTIVO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOUSUARIO()
    {
        return $this->belongsTo('App\GEOUSUARIO', 'IDREPARTIDOR', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCABFACTURA()
    {
        return $this->belongsTo('App\GEOCABFACTURA', 'SECUENCIALFAC', 'SECUENCIAL');
    }
}
