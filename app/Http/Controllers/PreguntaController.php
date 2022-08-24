<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('lessons.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_preguntas = $request->id_pregunta;
        $id_lessons = $request->id_lesson;
        $preguntas = $request->pregunta;
        $opciones_1 = $request->opcion1;
        $opciones_2 = $request->opcion2;
        $opciones_3 = $request->opcion3;
        $respuestas = $request->respuesta;
        foreach ($id_preguntas as $key => $id_pregunta_value) {
            $data[] = Pregunta::create([
                'id_pregunta' => $id_pregunta_value,
                'id_lesson' => $id_lessons[$key],
                'pregunta' => $preguntas[$key],
                'opcion1' => $opciones_1[$key],
                'opcion2' => $opciones_2[$key],
                'opcion3' => $opciones_3[$key],
                'respuesta' => $respuestas[$key]
            ]);
        }
        if ($request->individual) {
            return redirect()->back();
        } else {
            return redirect()->route('lessons.index');
        }
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
    public function edit(Pregunta $pregunta)
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
    public function update(Request $request)
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

    public function eliminar($id, $id_lesson)
    {
        $pregunta = Pregunta::find($id);
        $pregunta->delete();

        $preguntas = Pregunta::where('id_lesson', $id_lesson)
        ->orderBy('id_pregunta')
        ->get();

        foreach ($preguntas as $key => $preg) {
            $preg->update(['id_pregunta' => $key]);
        }

        return redirect()->back();
    }
}
