<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDMARCA
 * @property string $NOMBRE
 * @property int $IDEMPRESA
 * @property GEOPRODUCTO[] $gEOPRODUCTOs
 */
class GEOMARCA extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOMARCA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDMARCA';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE', 'IDEMPRESA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOPRODUCTOs()
    {
        return $this->hasMany('App\GEOPRODUCTO', 'IDMARCA', 'IDMARCA');
    }
}
