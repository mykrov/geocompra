<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDOPCION
 * @property string $NOMBREOPCION
 * @property int $IDMENU
 * @property string $URLOPCION
 * @property string $OCULTO
 * @property GEOACCESO[] $gEOACCESOs
 */
class GEOOPCION extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOOPCION';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDOPCION';

    /**
     * @var array
     */
    protected $fillable = ['NOMBREOPCION', 'IDMENU', 'URLOPCION', 'OCULTO'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOACCESOs()
    {
        return $this->hasMany('App\GEOACCESO', 'IDOPCION', 'IDOPCION');
    }
}
