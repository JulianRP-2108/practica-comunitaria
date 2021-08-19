<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Asignacion;
use App\Models\Kit;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller{
    
    public function index(){
        $anio = now()->year;
        try{
            $stockKits = Kit::all()->sum('stock');
            $kitsAsignados = Asignacion::all()->sum('cantidad');
            $cantAfiliados = Afiliado::all()->count();

        }catch(Exception $e){
            abort(404);
        }

        return view('dashboard',[
            'kitsAsignados' => $kitsAsignados,
            'cantAfiliados' => $cantAfiliados,
            'stockKits' => $stockKits,
            'anio' => $anio
        ]);
    }
}
