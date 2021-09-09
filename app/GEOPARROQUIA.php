<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDPARROQUIA
 * @property string $NOMBRE
 * @property int $IDPROVINICA
 * @property int $IDCANTON
 * @property GEOPROVINCIUM $gEOPROVINCIum
 * @property GEOCANTON $gEOCANTON
 * @property GEOEMPRESA[] $gEOEMPRESAs
 */
class GEOPARROQUIA extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOPARROQUIA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDPARROQUIA';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE', 'IDPROVINICA', 'IDCANTON'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPROVINCIum()
    {
        return $this->belongsTo('App\GEOPROVINCIUM', 'IDPROVINICA', 'IDPROVINCIA');
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
    public function gEOEMPRESAs()
    {
        return $this->hasMany('App\GEOEMPRESA', 'IDPARROQUIA', 'IDPARROQUIA');
    }
}
