<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Asignacion;
use App\Models\Kit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $anio = Carbon::now()->year;

        return view('asignaciones.index',[
            'anio' => $anio
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        try{
            $kits = Kit::all();
            return view('asignaciones.create',compact('kits'));
        }catch(Exception $e){
            return back()->with('error', 'Ocurrio un error interno, intente más tarde.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $asignacion = new Asignacion();
        $kit = new Kit();

        //validacion de los datos que llegan por request
        $this->validarRequest($request);

        try{
            $kit = Kit::where('nivel', $request->nivel)->first();
            $afiliado = Afiliado::where('dni', $request->dni)->first();
            $kit->stock = $kit->stock - (int)$request->cantidad;
            DB::transaction(function () use ($kit){
                //Si kit->stock es negativo va a fallar el save (porque stock en la BD es unsigned)
                $kit->save();
                
            });

            if($afiliado && $kit){
                $asignacion->fkIdAfiliado = $afiliado->idAfiliado;
                $asignacion->fkIdKit = $kit->idKit;
                $asignacion->fkIdUsuario = Auth::id();
                $asignacion->cantidad = (int)$request->cantidad;
                DB::transaction(function () use ($asignacion){
                    $asignacion->save();
                });

                $data = array(
                    'status' => 'success',
                    'asignacion' => $asignacion,
                    'kits restantes' => $kit->stock,
                    'idUsuario' => Auth::id()
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'message' => 'El dni ingresado no corresponde a ningún afiliado'
                );
            }
        }catch(Exception $e){
            if($kit->stock < 0){
                $data = array(
                    'status' => 'error',
                    'code' => '400',
                    'message' => 'Kits insuficientes!'
                );    
            }else{
                $data = array(
                    'status' => 'error',
                    'code' => '400',
                    'message' => 'Error al cargar la asignacion'
                );
            }
        }

        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignacion  $asignacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //faltaria despues de borrar reasignar el stock
        try{
            $asignacion = Asignacion::find($id);

            if($asignacion){
                $asignacion->delete();
                $data = array(
                    'status' => 'success',
                    'asignacion' => $asignacion
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'message' => 'No se pudo encontrar el afiliado'
                );
            }
        }catch(Exception $e){
            $data = array(
                'status' => 'error',
                'message' => 'Error'
            );
            abort(404);
        }
        
        return response($data);
    }

    //DataTables
    public function asignaciones(Request $request){
        $anio = $request->anio;

        $fechaInicio = Carbon::parse($anio . '-1-31');
        $fechaFin = Carbon::parse($anio . '-12-31');
        try{
            $asignaciones = DB::table('asignaciones')
            ->join('afiliados', 'asignaciones.fkIdAfiliado', '=', 'afiliados.idAfiliado')
            // ->select('asignaciones.created_at','afiliados.nombre','afiliados.apellido',
            // 'afiliados.dni','afiliados.telefono', 'afiliados.localidad', 'afiliados.cantidadHijos',
            // 'asignaciones.cantidad','afiliados.tipoEmpleado')
            ->select('*','asignaciones.created_at')
            ->whereBetween('asignaciones.created_at', [$fechaInicio, $fechaFin])
            ->get();

            $data = array(
                'data' => $asignaciones
            );
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return response()->json($data);
    }

    //validacion de los datos que llegan por request
    public function validarRequest($request) : void{
        $validator = Validator::make($request->all(), [
            'dni' => 'string|required|max:12',
            'nivel' => 'string|required|max:60',
            'cantidad' => 'required',
        ]);
        if ($validator->fails()) {
            //se manda automaticamente la variable $errors al blade
            //habria que cambiar a otro blade, solo estaba probando
            // return redirect(route('404'))
            //             ->withErrors($validator)
            //             ->withInput();
            abort(404);
        }
    }
}
