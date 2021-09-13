<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDITEMBOD
 * @property int $IDPRODUCTO
 * @property int $IDBODEGA
 * @property float $STOCK
 * @property GEOPRODUCTO $gEOPRODUCTO
 * @property GEOBODEGA $gEOBODEGA
 */
class GEOITEMBOD extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOITEMBOD';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDITEMBOD';

    /**
     * @var array
     */
    protected $fillable = ['IDPRODUCTO', 'IDBODEGA', 'STOCK'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPRODUCTO()
    {
        return $this->belongsTo('App\GEOPRODUCTO', 'IDPRODUCTO', 'IDPRODUCTO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOBODEGA()
    {
        return $this->belongsTo('App\GEOBODEGA', 'IDBODEGA', 'IDBODEGA');
    }
}
