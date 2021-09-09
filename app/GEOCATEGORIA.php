<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDCATEGORIA
 * @property string $NOMBRE
 * @property int $IDEMPRESA
 * @property GEOPRODUCTO[] $gEOPRODUCTOs
 */
class GEOCATEGORIA extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOCATEGORIA';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDCATEGORIA';

    /**
     * @var array
     */
    protected $fillable = ['NOMBRE', 'IDEMPRESA'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOPRODUCTOs()
    {
        return $this->hasMany('App\GEOPRODUCTO', 'IDCATEGORIA', 'IDCATEGORIA');
    }
}
