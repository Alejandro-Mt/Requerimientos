<?php

namespace App\Console\Commands;

use App\Mail\Interno\FoliosAbiertos;
use App\Models\acceso;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class FoliosActivos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correo:activos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El comando envia automaticamente un correo de los Folios Activos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $user = User:: where('id_area', 3)->orWhereIn('id_puesto',[5,7])->get();
        // Aquí puedes realizar cualquier manipulación necesaria en los datos obtenidos
        foreach ($user as $usuario) {
            $sistemas = acceso::where('id_user', $usuario->id)->get();
            $registros = DB::table('registros as r')
                ->select(
                    'r.folio',
                    'r.descripcion',
                    'e.posicion',
                    'e.titulo',
                    'si.nombre_s',
                    db::raw(
                        'IF (e.posicion < 6,
                            DATEDIFF(ifnull(l.fechades, now()), ifnull(s.created_at, r.created_at)) - (DATEDIFF(ifnull(l.fechades, now()), ifnull(s.created_at, r.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, r.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(l.fechades,now())) = 6 THEN 1 ELSE 0 END,
                            IF (e.posicion < 9,
                                DATEDIFF(ifnull(li.created_at,now()), IFNULL(s.created_at, r.created_at))  - (DATEDIFF(ifnull(li.created_at,now()), IFNULL(s.created_at, r.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(IFNULL(s.created_at, r.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(li.created_at,now())) = 6 THEN 1 ELSE 0 END,
                                IF (e.posicion = 9,
                                    DATEDIFF(ifnull(i.created_at,now()), ifnull(s.created_at, r.created_at)) - (DATEDIFF(ifnull(i.created_at,now()), ifnull(s.created_at, r.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, r.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.created_at,now())) = 6 THEN 1 ELSE 0 END,
                                    IF (e.posicion = 10,
                                        DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, r.created_at)) - (DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, r.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, r.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END,
                                        DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, r.created_at)) + 1 - (DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, r.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, r.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END
                                    )
                                )
                            )
                        ) AS dias'
                    )
                )
                ->leftJoin('solicitudes as s', 'r.folio', '=', 's.folio')
                ->leftJoin('levantamientos as l', 'r.folio', '=', 'l.folio')
                ->leftJoin('liberaciones as li', 'r.folio', '=', 'li.folio')
                ->leftJoin('implementaciones as i', 'r.folio', '=', 'i.folio')
                ->leftJoin('estatus as e', 'r.id_estatus', '=', 'e.id_estatus')
                ->join('sistemas as si', 'r.id_sistema', '=', 'si.id_sistema')
                ->whereNotIn('r.id_estatus', [14, 18])
                ->whereIn('r.id_sistema',$sistemas->pluck('id_sistema')->all())
                ->get();
            Mail::to($usuario->email)
            ->send(new FoliosAbiertos($registros,$usuario->nombre));
        }

        $this->info('¡El correo se envió correctamente!');

        return Command::SUCCESS;
    }
}
