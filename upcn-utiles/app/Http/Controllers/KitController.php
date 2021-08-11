<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Kit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $kits = Kit::all();
            return view('kits.index',compact('kits'));
        }catch(Exception $e){
            return back()->with('error','Ocurrio un error al obtener los kits.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar entradas
        $request->validate([
            'nivel' => 'string|required|max:60',
            'descripcion' => 'string|max:120|nullable',
            'stock' => 'required|numeric|min:0'
        ]);
        try{
            DB::beginTransaction();
            $kit = Kit::create([
                'nivel' => $request->nivel,
                'descripcion' => $request->descripcion,
                'stock' => $request->stock,
            ]);
            
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
        return back()->with('success', 'Kit creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kit $kit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kit $kit)
    {
        //
    }

    public function stock(){
        try{
            $cantTotal = Kit::all()->sum('stock');
        }catch(Exception $e){
            abort(404);
        }

        return view('kits.stock',[
            'cantKits' => $cantTotal
        ]);
    }

    public function stockGrafico(){
        try{
            $kits = Kit::all();
            $data = [];
            //construyo array con todos los kits y su stock
            foreach($kits as $kit){
                $aux = array(
                    'nivel' => $kit->nivel,
                    'stock' => $kit->stock
                );
                array_push($data,$aux);
            }
        }catch(Exception $e){
            $data = array(
                'status' => 'error'
            );
        }

        return response()->json($data);
    }

    //Este metodo devuelve el formulario para poder actualizar el stock
    //Tengo que 
    public function cargarStock(){
        try{
            $kits = Kit::get();
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
        return view('kits.cargarStock',compact('kits'));
    }

    public function updateStock(Request $request){
        try{
            $request->validate([
                'kit' => 'numeric|required',
                'cantNueva' => 'numeric|required'
            ]);
            DB::beginTransaction();
            $kit = DB::table('kits')->where('idKit',$request->kit)->first();
            if(($kit->stock + $request->cantNueva) >= 0){
                DB::table('kits')->where('idKit',$request->kit)->update(['stock' => $request->cantNueva + $kit->stock]);
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
        return back()->with('success','Stock actualizado correctamente');
    }

    public function kitsEntregados(){
        $anio = now()->year;
        try{
            $totalKitsEntregados = Asignacion::whereYear('created_at', '=', $anio)->get()->sum('cantidad');
        }catch(Exception $e){
            abort(404);
        }

        return view('kits.entregados',['anio' => $anio]);
    }

    public function graficoKitsEntregados(Request $request){
        $anio = $request->anio;
        $totalKitsEntregados = Asignacion::whereYear('created_at', '=', $anio)->get()->sum('cantidad');

        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $asignacionesXMes = [];

        foreach($meses as $key => $mes){
            $numMes = $key + 1;
            try{
                array_push($asignacionesXMes, array(
                    'mes' => $mes,
                    'cantidad' => Asignacion::whereYear('created_at', '=', $anio)->whereMonth('created_at', '=', $numMes)->get()->sum('cantidad')
                ));
            }catch(Exception $e){
                abort(404);
            }
        }

        $response = response()->json([
            'asignacionesAnuales' => $asignacionesXMes,
            'totalKits' => $totalKitsEntregados,
            'anio' => $anio
        ]);
        return $response;
    }
}
