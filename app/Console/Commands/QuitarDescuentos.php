<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Referencia;
use Illuminate\Support\Facades\Log;

class QuitarDescuentos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'descuentos:limpiar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borra los descuentos expirados';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $hoy = new \DateTime();
            $referencias = Referencia::whereNotNull('fin_descuento')->where('fin_descuento','<',$hoy->format('Y-m-d'))->get();
            $total = 0;
            foreach($referencias as $referencia){
                $referencia->descuento = null;
                $referencia->fin_descuento = null;
                $referencia->save();
                $total++;
            }
            Log::info("Borrados $total descuentos");
        }catch(\Exception $e){
            Log::error("Error borrando descuentos: ".$e->getMessage());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }
}
