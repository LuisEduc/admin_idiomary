<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderByDesc('orden')->get();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('categorias.crear', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = $request->all();
        Categoria::create($categoria);
        return redirect()->route('categorias.index');
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
    public function edit(Categoria $categoria)
    {
        return view('categorias.editar', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $cat = $request->all();
        $categoria->update($cat);
        return redirect()->route('categorias.index');
    }

    public function updateOrden(Request $request)
    {

        $cats = Categoria::all();

        foreach ($cats as $cat) {
            foreach ($request->orden as $orden) {
                if ($orden['id'] == $cat->id) {
                    $cat->update(['orden' => $orden['posicion']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }

    // API
    public function getCategorias()
    {
        $categorias = Categoria::orderByDesc('orden')->get();
        $categorias->makeHidden(['catcontenido']);
        $json['categorias'] = $categorias;
        return $json;
    }

    public function getCategoriasSlug($slug)
    {
        $categoria = Categoria::all()
            ->where('slug', $slug)->values()->all();

        $lecciones = DB::table('lessons')
            ->select('lessons.id','lessons.orden', 'lessons.slug', 'lessons.titulo', 'lessons.descripcion', 'lessonimages.imagen', 'lessons.audio', 'lessons.id_categoria', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->join('lessonimages', 'lessonimages.id_lesson', '=', 'lessons.id')
            ->where('categorias.slug', $slug)
            ->where('lessons.estado', 'publica')
            ->where('lessonimages.id_imagen', '0')
            ->orderByDesc('lessons.orden')
            ->get();

        $json['categoria'] = $categoria;
        $json['lecciones'] = $lecciones;

        return $json;
    }

    public function getContenidoCat($slug)
    {
        $contenido = Categoria::where('slug', $slug)->get(['catcontenido']);

        $json['contenido'] = $contenido;

        return $json;
    }
}
