<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opcione;
use App\Models\Paise;
use App\Models\Provincia;
use App\Models\Localidade;
use App\Models\Escuela;
session_start();
class EscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $escuelas = Escuela::select('escuelas.*','paises.*','opciones.opc_descr')
                            ->join('opciones','escuelas.idi_id','=','opciones.opc_id')
                            ->join('paises','escuelas.pais_id','=','paises.pais_id')
                            ->paginate(10);
        $data = [
            'escuelas'=>$escuelas,
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre',
            'search'=>"",
            'limit'=>10,
            'type'=>'Nombre'
        ];
        return view('escuelas.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $paises = Paise::all();
        
        $provincias = Provincia::where('provincias.pais_id','=',$paises[1]->pais_id)->get();
        $localidades = Localidade::select('localidades.*')
                                    ->where('localidades.prv_id','=',$provincias[0]->prv_id)->get();
        $idiomas = Opcione::all()
                ->whereIn('opc_tipo_id',[3,4]);
        $data = [
                    'paises'=>$paises,
                    'provincias'=>$provincias,
                    'localidades'=>$localidades,
                    'idiomas'=>$idiomas
                ];
        return view('escuelas.add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
