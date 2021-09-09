<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDCANTON
 * @property string $NOMBRECANTON
 * @property int $IDPROVINCIA
 * @property GEOPROVINCIUM $gEOPROVINCIum
 * @property GEOEMPRESA[] $gEOEMPRESAs
 * @property GEOPARROQUIUM[] $gEOPARROQUIAs
 */
class GEOCANTON extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOCANTON';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDCANTON';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRECANTON', 'IDPROVINCIA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPROVINCIum()
    {
        return $this->belongsTo('App\GEOPROVINCIUM', 'IDPROVINCIA', 'IDPROVINCIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOEMPRESAs()
    {
        return $this->hasMany('App\GEOEMPRESA', 'IDCANTON', 'IDCANTON');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOPARROQUIAs()
    {
        return $this->hasMany('App\GEOPARROQUIUM', 'IDCANTON', 'IDCANTON');
    }
}
