<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDUSUARIO
 * @property string $NOMBRE
 * @property string $CEDULA
 * @property string $TELEFONO
 * @property string $CORREO
 * @property string $USUARIO
 * @property string $CLAVE
 * @property string $ROL
 * @property int $IDEMPRESA
 * @property int $IDBODEGA
 * @property GEOBODEGA $gEOBODEGA
 * @property GEOEMPRESA $gEOEMPRESA
 * @property GEOROLE $gEOROLE
 * @property GEOACCESO[] $gEOACCESOs
 * @property GEOCABINGRESO[] $gEOCABINGRESOs
 * @property GEOGUIACAB[] $gEOGUIACABs
 * @property GEONCRCAB[] $gEONCRCABs
 * @property GEOREPARTIDOR[] $gEOREPARTIDORs
 */
class GEOUSUARIO extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOUSUARIO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDUSUARIO';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE', 'CEDULA', 'TELEFONO', 'CORREO', 'USUARIO', 'CLAVE', 'ROL', 'IDEMPRESA', 'IDBODEGA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOBODEGA()
    {
        return $this->belongsTo('App\GEOBODEGA', 'IDBODEGA', 'IDBODEGA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOEMPRESA()
    {
        return $this->belongsTo('App\GEOEMPRESA', 'IDEMPRESA', 'IDEMPRESA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOROLE()
    {
        return $this->belongsTo('App\GEOROLE', 'ROL', 'IDROLES');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOACCESOs()
    {
        return $this->hasMany('App\GEOACCESO', 'IDUSUARIO', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOCABINGRESOs()
    {
        return $this->hasMany('App\GEOCABINGRESO', 'IDUSUARIO', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOGUIACABs()
    {
        return $this->hasMany('App\GEOGUIACAB', 'IDREPARTIDOR', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEONCRCABs()
    {
        return $this->hasMany('App\GEONCRCAB', 'IDUSUARIO', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOREPARTIDORs()
    {
        return $this->hasMany('App\GEOREPARTIDOR', 'IDUSUARIO', 'IDUSUARIO');
    }
}
