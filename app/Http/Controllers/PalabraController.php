<?php

namespace App\Http\Controllers;

use App\Models\Palabra;
use Illuminate\Http\Request;

class PalabraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $palabras = Palabra::orderByDesc('id')->get();
        return view('palabras.index', compact('palabras'));
    }

    public function basico()
    {
        $palabras = Palabra::orderByDesc('id')
            ->where('nivel', 'basico')
            ->get();
        return view('palabras.basico', compact('palabras'));
    }

    public function medio()
    {
        $palabras = Palabra::orderByDesc('id')
            ->where('nivel', 'medio')
            ->get();
        return view('palabras.medio', compact('palabras'));
    }
    
    public function avanzado()
    {
        $palabras = Palabra::orderByDesc('id')
            ->where('nivel', 'avanzado')
            ->get();
        return view('palabras.avanzado', compact('palabras'));
    }

    public function grabar($id)
    {
        $palabra = Palabra::find($id);
        if ($palabra->grabar) {
            $pal['grabar'] = 0;
        } else {
            $pal['grabar'] = 1;
        }

        $palabra->update($pal);
        return redirect()->route('palabras.index');
    }

    public function reproducir()
    {
        $palabras = Palabra::where('grabar', 1)->get();
        return view('palabras.reproducir', compact('palabras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('palabras.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $palabra = $request->all();
        Palabra::create($palabra);
        return redirect()->route('palabras.index');
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
    public function edit(Palabra $palabra)
    {
        return view('palabras.editar', compact('palabra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Palabra $palabra)
    {
        $pal = $request->all();
        $palabra->update($pal);
        return redirect()->route('palabras.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Palabra $palabra)
    {
        $palabra->delete();
        return redirect()->route('palabras.index');
    }
    
}
