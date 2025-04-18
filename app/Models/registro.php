<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class registro extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_registro';
    protected $fillable = [
        'folio',
        'descripcion',
        'id_responsable',
        'id_sistema',
        'id_cliente',
        'id_estatus',
        'id_area',
        'id_arquitecto',
        'id_clase',
        'folio_pr',
        'es_proyecto',
        'es_emergente'
    ];

    public function archivos()
    {
        return $this->hasMany(archivo::class, 'folio', 'folio');
    }

    public function area()
    {
        return $this->belongsTo(area::class, 'id_area', 'id_area');
    }

    public function CalcDias($fechainicio, $fechafin)
    {
        $resultado = DB::select("SELECT CalcDias(?, ?) AS resultado", [$fechainicio, $fechafin]);

        // El resultado es un array de objetos stdClass, así que extraemos el valor de la columna "resultado"
        $resultadoCalculado = $resultado[0]->resultado;

        return $resultadoCalculado;
    }

    public function clase()
    {
        return $this->belongsTo(clase::class, 'id_clase', 'id_clase');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function comentarios()
    {
        return $this->hasMany(comentario::class, 'folio', 'folio');
    }

    public function construccion()
    {
        return $this->belongsTo(construccion::class, 'folio', 'folio');
    }

    public function defReq()
    {
        return $this->belongsTo(planeacion::class, 'folio', 'folio');
    }

    public function desfase()
    {
        return $this->belongsTo(desfase::class, 'id', 'motivodesfase');
    }
    
    public function estatus()
    {
        return $this->belongsTo(estatu::class, 'id_estatus', 'id_estatus');
    }

    public function implementacion()
    {
        return $this->belongsTo(implementacion::class, 'folio', 'folio');
    }
    
    public function levantamiento()
    {
        return $this->belongsTo(levantamiento::class, 'folio', 'folio');
    }

    public function liberacion()
    {
        return $this->belongsTo(liberacion::class, 'folio', 'folio');
    }

    public function mesasA()
    {
        return $this->hasMany(mesa::class, 'folio', 'folio')->where('es_alcance', 1)->first();
    }
    
    public function mesasT()
    {
        return $this->hasMany(mesa::class, 'folio', 'folio')->where('es_alcance', NULL);
    }

    public function primeraMesa()
    {
        return $this->mesasT()->orderBy('fecha_mesa')->first();
    }

    public function ultimaMesa()
    {
        return $this->mesasT()->orderBy('fecha_mesa', 'desc')->first();
    }

    public function pausa()
    {
        return $this->hasMany(pausa::class, 'folio', 'folio');
    }

    public function pausado()
    {
        return $this->hasOne(pausa::class, 'folio', 'folio')->where('pausa', 2);
    }

    public function diasPospuesto()
    {
        return $this->pausa()->selectRaw('SUM(CASE WHEN pausa != 0 THEN CalcDias(created_at, CURDATE()) ELSE CalcDias(created_at, updated_at) END) as pospuesto')->first();
    }

    public function pausaPre()
    {
        return $this->hasMany(pausa::class, 'folio', 'folio')->where('id_motivo', 8)->first();
    }

    public function plan()
    {
        return $this->belongsTo(analisis::class, 'folio', 'folio');
    }

    public function rdes()
    {
        return $this->belongsTo(User::class, 'id_arquitecto', 'id');
    }
    
    public function rpip()
    {
        return $this->belongsTo(User::class, 'id_responsable', 'id');
    }
    
    public function rtest()
    {
        return $this->belongsTo(User::class, 'id_tester', 'id');
    }
    
    public function sistema()
    {
        return $this->belongsTo(sistema::class, 'id_sistema', 'id_sistema');
    }
    
    public function solicitud()
    {
        return $this->belongsTo(solicitud::class, 'folio', 'folior');
    }

    public function titulo()
    {
        return "{$this->folio} {$this->descripcion}";
    }
}
