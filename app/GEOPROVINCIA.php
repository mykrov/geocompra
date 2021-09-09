<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDPROVINCIA
 * @property string $NOMBRE
 * @property GEOCANTON[] $gEOCANTONs
 * @property GEOEMPRESA[] $gEOEMPRESAs
 * @property GEOPARROQUIUM[] $gEOPARROQUIAs
 */
class GEOPROVINCIA extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOPROVINCIA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDPROVINCIA';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOCANTONs()
    {
        return $this->hasMany('App\GEOCANTON', 'IDPROVINCIA', 'IDPROVINCIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOEMPRESAs()
    {
        return $this->hasMany('App\GEOEMPRESA', 'IDPROVINCIA', 'IDPROVINCIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOPARROQUIAs()
    {
        return $this->hasMany('App\GEOPARROQUIUM', 'IDPROVINICA', 'IDPROVINCIA');
    }
}
