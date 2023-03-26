<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



use Maatwebsite\Excel\Facades\Excel;



use App\Pago;
use App\Referencia;
use Illuminate\Support\Facades\DB;
use App\Persona;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->user()->authorizeRoles(['Estudiante']);
        //$pagos = DB::select('select * from pagos where user_id = ?', [Auth::user()->id]);
        $pagos = Pago::all();
        $pluck = ['NavItemActive' => 'pago'];

        return view('pago.index', ['pluck' => ['NavItemActive' => 'pago'], 'pagos' => $pagos]);
    }

    public function new()
    {
        return view('pago.new', ['pluck' => ['NavItemActive' => 'pago']]);
    }

    public function adminpago()
    {
        request()->user()->authorizeRoles(['Administrador']);
        $pagos = Pago::all();
        return view('pago.adminpago', ['pluck' => ['NavItemActive' => 'pagoadmin'], 'pagos' => $pagos]);
    }

    public function confirmarPago($id)
    {
        $pago = Pago::find($id);

        $pago->procesado = 1;
        DB::insert('insert into pagosProcesados (pago_id) values (?)', [$pago->id]);
        $pago->save();
    


        return redirect()->action('PagoController@adminpago');
    }

    public function referencias()
    {
        return view('pago.referencias', ['pluck' => ['NavItemActive' => 'referencias']]);
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
        // return $request->all();

        // $this->validate($request, [
        //     'pdf' => 'required|mimes:pdf|max:2048'
        // ]);


        $persona = Persona::find(auth()->user()->id);
        $pago = new Pago();
        $pago->referencia = $request->referencia;
        $pago->bancoEmisor = $request->bancoEmisor;
        $pago->fechaPago = $request->fechaPago;
        $pago->descripcion = $request->descripcion;
        $pago->monto = $request->monto;
        // El archivo PDF se ha cargado correctamente
        if($request->hasFile('pdf')){
            $pago->pdf = file_get_contents($request->file('pdf')->getRealPath());
        }

        $pago->procesado = 0;
        $pago->persona()->associate($persona);
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

    public function importar(Request $request)
    {
        if ($request->hasFile('documento')) {
            $path = $request->file('documento')->getRealPath();
            $datos = Excel::load($path, function ($reader) {
            })->get();

            if (!empty($datos) && $datos->count()) {
                $datos = $datos->toArray();
                for ($i = 0; $i < count($datos); $i++) {
                    $datosImportar[] = $datos[$i];
                }
            }

            Referencia::insert($datosImportar);
        }
        return redirect()->action('PagoController@adminpago');
    }

    /* public function updateEstado(Request $request, Pago $pago)
    {
        $pago->procesado = $request->input(1);
        $pago->save();

        return redirect()->route('pagos.adminpago', $pago->id)
            ->with('success', 'Estado actualizado correctamente');
    } */



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
