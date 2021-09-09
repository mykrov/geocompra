<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDBODEGA
 * @property string $NOMBRECOMERCIAL
 * @property string $SERIE
 * @property int $NOSECUENCIAL
 * @property int $NOSECUENCIALNCR
 * @property int $NOGUIAREMISION
 * @property float $LATITUD
 * @property float $LONGITUD
 * @property int $IDEMPRESA
 * @property string $TELEFONO
 * @property string $CORREO
 * @property string $DIRECCION
 * @property GEOEMPRESA $gEOEMPRESA
 * @property GEOITEMBOD[] $gEOITEMBODs
 * @property GEOUSUARIO[] $gEOUSUARIOs
 */
class GEOBODEGA extends Model
{
    public $timestamps =false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOBODEGA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDBODEGA';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRECOMERCIAL', 'SERIE', 'NOSECUENCIAL', 'NOSECUENCIALNCR', 'NOGUIAREMISION', 'LATITUD', 'LONGITUD', 'IDEMPRESA', 'TELEFONO', 'CORREO', 'DIRECCION'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOEMPRESA()
    {
        return $this->belongsTo('App\GEOEMPRESA', 'IDEMPRESA', 'IDEMPRESA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOITEMBODs()
    {
        return $this->hasMany('App\GEOITEMBOD', 'IDBODEGA', 'IDBODEGA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOUSUARIOs()
    {
        return $this->hasMany('App\GEOUSUARIO', 'IDBODEGA', 'IDBODEGA');
    }
}
