<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pago;

use DB;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::all();
        return view('pago.index',
        [
            'pluck' => ['NavItemActive' => 'pago'],
            'pagos' => $pagos
        ]
        );
    }
    
    public function new(){
        return view('pago.new',['pluck' => ['NavItemActive' => 'pago']]);
    }

    public function adminpago(){
        return view('pago.adminpago', ['pluck' => ['NavItemActive' => 'pagoadmin']]);
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
        //return $request->all();
        $pago = new Pago();
        $pago->referencia = $request->referencia;
        $pago->bancoEmisor = $request->bancoEmisor;
        $pago->fechaPago = $request->fechaPago;
        $pago->descripcion = $request->descripcion;
        $pago->monto = $request->monto;
        $pago->procesado = 0;
        /* $pago->procesado = $request->procesado; */

        $pago->save();

        return redirect()->action('PagoController@index');
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
        $pago = Pago::findOrFail($id);
        $pluck = ['NavItemActive' => 'pago'];

        return view('pago.show', compact('pago', 'pluck'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit($id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        //
    }*/

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



