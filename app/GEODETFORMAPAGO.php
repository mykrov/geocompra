<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDDETFORMAPAGO
 * @property int $IDMEDIOPAGO
 * @property int $IDEMPRESA
 * @property string $PRIVATEKEY
 * @property string $PUBLICKEY
 * @property string $MACHINEKEY
 * @property string $TOKEN
 * @property GEOEMPRESA $gEOEMPRESA
 * @property GEOMEDIOSPAGO $gEOMEDIOSPAGO
 */
class GEODETFORMAPAGO extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEODETFORMAPAGO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDDETFORMAPAGO';

    /**
     * @var array
     */
    protected $fillable = ['IDMEDIOPAGO', 'IDEMPRESA', 'PRIVATEKEY', 'PUBLICKEY', 'MACHINEKEY', 'TOKEN'];

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
    public function gEOMEDIOSPAGO()
    {
        return $this->belongsTo('App\GEOMEDIOSPAGO', 'IDMEDIOPAGO', 'IDMEDIOPAGO');
    }
}
