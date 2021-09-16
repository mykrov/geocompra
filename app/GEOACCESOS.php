<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDACCESO
 * @property int $IDOPCION
 * @property int $IDUSUARIO
 * @property string $ESTADO
 * @property string $ESMENU
 * @property GEOUSUARIO $gEOUSUARIO
 * @property GEOOPCION $gEOOPCION
 */
class GEOACCESOS extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOACCESOS';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDACCESO';

    /**
     * @var array
     */
    protected $fillable = ['IDOPCION', 'IDUSUARIO', 'ESTADO', 'ESMENU'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOUSUARIO()
    {
        return $this->belongsTo('App\GEOUSUARIO', 'IDUSUARIO', 'IDUSUARIO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOOPCION()
    {
        return $this->belongsTo('App\GEOOPCION', 'IDOPCION', 'IDOPCION');
    }
}
