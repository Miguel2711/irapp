<?php namespace App\Models\Comercio;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
  use SoftDeletes;

  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productos';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = [
    'nombre',
    'valor',
    'descripcion',
    'medida_id',
    'marca_id',
    'categoria_id',
    'tipo_referencia_id',
  ];

   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];

  protected $dates = [
      'created_at',
      'updated_at',
      'deleted_at',
  ];


public function marca()
{
    return $this->belongsTo('App\Models\Comercio\Marca');
}

public function categoria()
{
    return $this->belongsTo('App\Models\Clasificacion\Categoria');
}

public function medida()
{
    return $this->belongsTo('App\Models\Dato_basico\Medida');
}

public function tipo_referencia()
{
    return $this->belongsTo('App\Models\Dato_basico\X_Tipo_referencia');
}
}
