<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $IDPRODUCTO
 * @property string $CODIGOPRI
 * @property string $CODIGOSEC
 * @property string $NOMBRE
 * @property float $PRECIO
 * @property string $GRABAIVA
 * @property string $IMAGEN
 * @property string $ESTADO
 * @property int $IDCATEGORIA
 * @property int $IDMARCA
 * @property float $COSTO
 * @property int $IDPROVEEDOR
 * @property string $DESCRIPCION
 * @property GEOPROVEEDOR $gEOPROVEEDOR
 * @property GEOCATEGORIUM $gEOCATEGORIum
 * @property GEOMARCA $gEOMARCA
 * @property GEODETFACTURA[] $gEODETFACTURAs
 * @property GEOITEMBOD[] $gEOITEMBODs
 * @property GEONCRDET[] $gEONCRDETs
 */
class GEOPRODUCTO extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'GEOPRODUCTO';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDPRODUCTO';

    /**
     * @var array
     */
    protected $fillable = ['CODIGOPRI', 'CODIGOSEC', 'NOMBRE', 'PRECIO', 'GRABAIVA', 'IMAGEN', 'ESTADO', 'IDCATEGORIA', 'IDMARCA', 'COSTO', 'IDPROVEEDOR','DESCRIPCION'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOPROVEEDOR()
    {
        return $this->belongsTo('App\GEOPROVEEDOR', 'IDPROVEEDOR', 'IDPROVEEDOR');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOCATEGORIum()
    {
        return $this->belongsTo('App\GEOCATEGORIUM', 'IDCATEGORIA', 'IDCATEGORIA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gEOMARCA()
    {
        return $this->belongsTo('App\GEOMARCA', 'IDMARCA', 'IDMARCA');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEODETFACTURAs()
    {
        return $this->hasMany('App\GEODETFACTURA', 'IDITEM', 'IDPRODUCTO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEOITEMBODs()
    {
        return $this->hasMany('App\GEOITEMBOD', 'IDPRODUCTO', 'IDPRODUCTO');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gEONCRDETs()
    {
        return $this->hasMany('App\GEONCRDET', 'IDITEM', 'IDPRODUCTO');
    }
}
