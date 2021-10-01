<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDPROVEEDOR
 * @property string $NOMBREPROV
 * @property int $IDEMPRESA
 * @property string $RUCEMPRESA
 * @property GEOEMPRESA $gEOEMPRESA
 * @property GEOPRODUCTO[] $gEOPRODUCTOs
 */
class GEOPROVEEDOR extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOPROVEEDOR';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDPROVEEDOR';

    /**
     * @var array
     */
    protected $fillable = ['NOMBREPROV', 'IDEMPRESA', 'RUCEMPRESA'];

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
    public function gEOPRODUCTOs()
    {
        return $this->hasMany('App\GEOPRODUCTO', 'IDPROVEEDOR', 'IDPROVEEDOR');
    }
}
