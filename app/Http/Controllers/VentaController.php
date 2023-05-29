<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Carbon\Carbon;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::get();
        $ventasTotales = Venta::sum('total');
        return view('admin.ventas.index' , compact('ventas', 'ventasTotales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $precio = $request->precio;
            $cantidad = $request->cantidad;
            $fecha = Carbon::now('America/Santiago');
            $total = $precio * $cantidad;

            $venta = Venta::create([
                'descripcion'   =>  $descripcion,
                'precio'        =>  $precio,
                'cantidad'      =>  $cantidad,
                'total'         =>  $total,   
                'fecha'         =>  $fecha,    
            ]);
            
            return redirect()->route('ventas.index')->with('toast_success', 'Venta registrada Exitosamente!');

        } catch (\Throwable $th) {
           dd($th);
           return redirect()->route('ventas.index')->with('toast_error', 'Error al registrar venta!');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
            $venta->delete();
            return redirect()->route('ventas.index');
    }
}
