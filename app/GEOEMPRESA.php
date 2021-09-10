<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDEMPRESA
 * @property string $RAZONSOCIAL
 * @property string $RUC
 * @property string $CORREO
 * @property string $RUTACERTIFICADO
 * @property string $LOGOEMPRESA
 * @property int $IDPROVINCIA
 * @property int $IDCANTON
 * @property int $IDPARROQUIA
 * @property string $AGENTERETENCION
 * @property string $CONTRIBUYENTEESPECIAL
 * @property string $ACTIVIDADECONOMICA
 * @property int $IDTIPONEGOCIO
 * @property string $CLAVEERTIFICADO
 * @property string $ESTADO
 * @property GEOPARROQUIUM $gEOPARROQUIum
 * @property GEOPROVINCIUM $gEOPROVINCIum
 * @property GEOTIPONEGOCIO $gEOTIPONEGOCIO
 * @property GEOCANTON $gEOCANTON
 * @property GEOBODEGA[] $gEOBODEGAs
 * @property GEODETFORMAPAGO[] $gEODETFORMAPAGOs
 * @property GEOPROVEEDOR[] $gEOPROVEEDORs
 * @property GEOUSUARIO[] $gEOUSUARIOs
 */
class GEOEMPRESA extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOEMPRESA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDEMPRESA';

    /**
     * @var array
     */
    protected $fillable = ['RAZONSOCIAL', 'RUC', 'CORREO', 'RUTACERTIFICADO', 'LOGOEMPRESA', 'IDPROVINCIA', 'IDCANTON', 'IDPARROQUIA', 'AGENTERETENCION', 'CONTRIBUYENTEESPECIAL', 'ACTIVIDADECONOMICA', 'IDTIPONEGOCIO', 'CLAVEERTIFICADO', 'ESTADO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPARROQUIum()
    {
        return $this->belongsTo('App\GEOPARROQUIUM', 'IDPARROQUIA', 'IDPARROQUIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPROVINCIum()
    {
        return $this->belongsTo('App\GEOPROVINCIUM', 'IDPROVINCIA', 'IDPROVINCIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOTIPONEGOCIO()
    {
        return $this->belongsTo('App\GEOTIPONEGOCIO', 'IDTIPONEGOCIO', 'IDTIPONEGO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCANTON()
    {
        return $this->belongsTo('App\GEOCANTON', 'IDCANTON', 'IDCANTON');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOBODEGAs()
    {
        return $this->hasMany('App\GEOBODEGA', 'IDEMPRESA', 'IDEMPRESA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEODETFORMAPAGOs()
    {
        return $this->hasMany('App\GEODETFORMAPAGO', 'IDEMPRESA', 'IDEMPRESA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOPROVEEDORs()
    {
        return $this->hasMany('App\GEOPROVEEDOR', 'IDEMPRESA', 'IDEMPRESA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOUSUARIOs()
    {
        return $this->hasMany('App\GEOUSUARIO', 'IDEMPRESA', 'IDEMPRESA');
    }
}
