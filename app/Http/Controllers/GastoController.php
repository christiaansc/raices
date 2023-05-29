<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::get();
        $gastosTotales = Gasto::sum('montoTotal');

        return view('admin.gastos.index' , compact('gastos', 'gastosTotales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $descripcion = $request->descripcion;
            $monto = $request->monto;
            $cantidad = $request->cantidad;
            $fecha = Carbon::now('America/Santiago');
            $montoTotal =  $monto * $cantidad;
            $tipoGasto = $request->tgasto;
    
            $gasto = Gasto::create([
                'descripcion' => $descripcion,
                'monto' => $monto ,
                'fecha' => $fecha ,
                'cantidad' => $cantidad ,
                'montoTotal' => $montoTotal ,
                'tipoGasto' => $tipoGasto
            ]);
 
            return redirect()->route('gastos.index');
        } catch (\Throwable $th) {
            dd($th);
        }

   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasto $gasto)
    {
        
        
        try {
            $gasto->delete();
            return redirect()->route('gastos.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
