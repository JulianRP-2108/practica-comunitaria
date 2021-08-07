<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $afiliados = Afiliado::all();
        }catch(Exception $e){
            abort(404);
        }

        return view('afiliados.index',['afiliados' => $afiliados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('afiliados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $afiliado = new Afiliado();
        //validacion de los datos que llegan por request
        $this->validarRequest($request);
        $telefono = $request->prefijo . $request->telefono;

        $afiliado->nombre =$request->nombre;
        $afiliado->apellido = $request->apellido;
        $afiliado->dni = $request->dni;
        $afiliado->email = isset($request->email) ? $request->email : '(falta email)';
        $afiliado->telefono = ($telefono != '') ? $telefono : '(falta telefono)';
        $afiliado->localidad = $request->localidad;
        $afiliado->cantidadHijos = $request->cantHijos;
        $afiliado->tipoEmpleado = $request->tipo;


        try{
            $existe = $this->existeAfiliado($afiliado->dni);
            if($existe){
                $data = array(
                    'status' => 'error',
                    'code' => '400',
                    'message' => 'Afiliado duplicado'
                );
            }else{
                //Beggintransaction
                $afiliado->save();
                $data = array(
                    'status' => 'success',
                    'code' => '200',
                    'message' => 'Afiliado creado'
                );
            }
            //commit
        }catch(Exception $e){
            //rollback
            $data = array(
                'status' => 'error',
                'code' => '400',
                'message' => 'El Afiliado no pudo ser creado'
            );
        }
        //despues redireccionar al listado de afiliados
        return redirect(route('afiliados.index'));
        //este return lo puse solo para ver donde estaba entrando
        // return response()->json($data,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function show(Afiliado $afiliado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function edit($idAfiliado){
        try{
            $afiliado = Afiliado::find($idAfiliado);
        }catch(Exception $e){
            $data = array(
                'status' => 'error',
                'code' => '400',
                'message' => 'El Afiliado no pudo ser recuperado'
            );
        }

        return view('afiliados.edit',['afiliado' => $afiliado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $afiliado = Afiliado::find($id);
        //validar request
        $this->validarRequest($request);
        $telefono = $request->prefijo . $request->telefono;

        $afiliado->nombre =$request->nombre;
        $afiliado->apellido = $request->apellido;
        $afiliado->dni = $request->dni;
        $afiliado->email = isset($request->email) ? $request->email : '(falta email)';
        $afiliado->telefono = ($telefono != '') ? $telefono : '(falta telefono)';
        $afiliado->localidad = $request->localidad;
        $afiliado->cantidadHijos = $request->cantHijos;
        $afiliado->tipoEmpleado = $request->tipo;
        $afiliado->save();

        return redirect(route('afiliados.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afiliado  $afiliado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        try{
            $afiliado = Afiliado::find($id);

            if($afiliado){
                $afiliado->delete();
                $data = array(
                    'status' => 'success',
                    'afiliado' => $afiliado
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
        
        return redirect(route('afiliados.index'));
        // return response($data);
    }

    public function existeAfiliado($dni){
        $res = DB::table('afiliados')   ->where('dni', $dni)
                                        ->first();
        return $res;
    }

    //validacion de los datos que llegan por request
    public function validarRequest($request) : void{
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required',
            'localidad' => 'required',
            'cantHijos' => 'required',
            'tipo' => 'required',
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
