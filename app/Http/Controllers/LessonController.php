<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Lesson;
use App\Models\Lessonimage;
use App\Models\Pregunta;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $lessons = Lesson::paginate(5); //paginacion sin usar dataTables
        $lessons = Lesson::orderByDesc('orden')->get();
        return view('lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecciones = Lesson::all();
        $categorias = Categoria::all();
        $tipos = Tipo::all();
        return view('lessons.crear', compact('categorias', 'tipos', 'lecciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'imagen.*' => 'image|mimes:jpeg,jpg,png,svg,webp,JPEG,JPG,PNG,SVG,WEBP|max:5000',
            'audio' => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg,MPEG,MPGA,MP3,WAV,AAC|max:5000'
        ]);

        $lesson = $request->except('imagen');

        if ($audio = $request->file('audio')) {
            $rutaGuardarAud = 'audio/';
            list($sec, $usec) = explode('.', microtime(true));
            $audioLesson = date('YmdHis', $sec) . $usec . "." . $audio->getClientOriginalExtension();
            $audio->move($rutaGuardarAud, $audioLesson);
            $lesson['audio'] = "$audioLesson";
        }

        $lec_creada = Lesson::create($lesson);

        if ($request->file('imagen')) {

            $images = $request->imagen;
            $rutaGuardarImg = 'imagen/';

            foreach ($images as $key => $image_value) {

                list($sec, $usec) = explode('.', microtime(true));
                $imagenLesson = date('YmdHis', $sec) . $usec . "." . $image_value->getClientOriginalExtension();
                $image_value->move($rutaGuardarImg, $imagenLesson);

                $data[] = $lec_creada->lessonimages()->create([
                    'id_lesson' => $lec_creada->id,
                    'id_imagen' => $key,
                    'imagen' => "$imagenLesson",
                ]);
            }
        }

        $id_lesson = $lec_creada->id;
        $preguntas = $lec_creada->preguntas;
        return view('lessons.crearpregunta', compact('id_lesson', 'preguntas'));
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
    public function edit(Lesson $lesson)
    {
        $categorias = Categoria::all();
        $tipos = Tipo::all();
        $preguntas = Pregunta::where('id_lesson', $lesson->id)->get();
        $lessonimage = Lessonimage::where('id_lesson', $lesson->id)
            ->orderBy('id_imagen')
            ->get();
        return view('lessons.editar', compact('lesson', 'categorias', 'tipos', 'preguntas', 'lessonimage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {

        $request->validate([
            'imagen.*' => 'image|mimes:jpeg,jpg,png,svg,webp,JPEG,JPG,PNG,SVG,WEBP|max:5000',
            'audio' => 'file|mimes:audio/mpeg,mpga,mp3,wav,aac,ogg,MPEG,MPGA,MP3,WAV,AAC|max:5000'
        ]);

        $leccion = $request
            ->except([
                'id_pregunta',
                'id_lesson',
                'pregunta',
                'opcion1',
                'opcion2',
                'opcion3',
                'respuesta',
                'imagen'
            ]);

        if ($audio = $request->file('audio')) {
            $oldAud = 'audio/' . $lesson->audio;
            if (File::exists($oldAud)) {
                File::delete($oldAud);
            }
            $rutaGuardarAud = 'audio/';
            list($sec, $usec) = explode('.', microtime(true));
            $audioLeccion = date('YmdHis', $sec) . $usec . "." . $audio->getClientOriginalExtension();
            $audio->move($rutaGuardarAud, $audioLeccion);
            $leccion['audio'] = "$audioLeccion";
        } else {
            unset($leccion['audio']);
        }

        $lesson->update($leccion);

        if ($request->id_pregunta) {

            $id_preguntas = $request->id_pregunta;
            $preguntas = $request->pregunta;
            $opciones_1 = $request->opcion1;
            $opciones_2 = $request->opcion2;
            $opciones_3 = $request->opcion3;
            $respuestas = $request->respuesta;
            foreach ($id_preguntas as $key => $id_pregunta_value) {
                $data = [
                    'pregunta' => $preguntas[$key],
                    'opcion1' => $opciones_1[$key],
                    'opcion2' => $opciones_2[$key],
                    'opcion3' => $opciones_3[$key],
                    'respuesta' => $respuestas[$key]
                ];

                $lesson->preguntas()->where('id_pregunta', $id_pregunta_value)->update($data);
            }
        }

        if ($request->imagen) {

            $images = $request->imagen;
            $rutaGuardarImg = 'imagen/';
            $imagenes = Lessonimage::where('id_lesson', $lesson->id)->get()->toArray();
            $count_imagenes = count($imagenes);

            foreach ($images as $key => $image_value) {

                list($sec, $usec) = explode('.', microtime(true));
                $imagenLesson = date('YmdHis', $sec) . $usec . "." . $image_value->getClientOriginalExtension();
                $image_value->move($rutaGuardarImg, $imagenLesson);

                $data[] = $lesson->lessonimages()->create([
                    'id_lesson' => $lesson->id,
                    'id_imagen' => $count_imagenes + $key,
                    'imagen' => "$imagenLesson",
                ]);
            }
        }

        return redirect()->route('lessons.index');
    }

    public function updateOrden(Request $request)
    {

        $lecs = Lesson::all();

        foreach ($lecs as $lec) {
            foreach ($request->orden as $orden) {
                if ($orden['id'] == $lec->id) {
                    $lec->update(['orden' => $orden['posicion']]);
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
    public function destroy(Lesson $lesson)
    {
        $lessonimages = Lessonimage::where('id_lesson', $lesson->id)->get()->toArray();;
        foreach ($lessonimages as $lessonimage) {
            $img = $lessonimage['imagen'];
            File::delete("imagen/$img");
        }
        $lesson->delete();
        File::delete("audio/$lesson->audio");
        return redirect()->route('lessons.index');
    }


    // API
    public function getLecciones()
    {
        $lecciones = DB::table('lessons')
            ->select('lessons.id', 'lessons.orden', 'lessons.slug', 'lessons.titulo', 'lessons.descripcion', 'lessonimages.imagen', 'lessons.audio', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->join('lessonimages', 'lessonimages.id_lesson', '=', 'lessons.id')
            ->where('lessons.estado', 'publica')
            ->where('lessonimages.id_imagen', '0')
            ->orderByDesc('lessons.orden')
            ->get();

        return $lecciones;
    }

    public function getLecturas()
    {
        $lecturas = DB::table('lessons')
            ->select('lessons.id', 'lessons.orden', 'lessons.slug', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->where('lessons.estado', 'publica')
            ->where('categorias.slug', 'lc')
            ->orWhere('categorias.slug', 'lb')
            ->orWhere('categorias.slug', 'fm')
            ->orderByDesc('lessons.orden')
            ->get();

        return $lecturas;
    }

    public function getLeccionesCat($id_categoria)
    {

        $lecciones = DB::table('lessons')
            ->select('lessons.id', 'lessons.orden', 'lessons.slug', 'lessons.titulo', 'lessons.descripcion', 'lessonimages.imagen', 'lessons.audio', 'categorias.slug')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->join('lessonimages', 'lessonimages.id_lesson', '=', 'lessons.id')
            ->where('id_categoria', $id_categoria)
            ->where('lessonimages.id_imagen', '0')
            ->orderByDesc('lessons.orden')
            ->get();
        $json['lecciones'] = $lecciones;
        return $json;
    }

    public function getLeccionesCatSlug($slug_cat, $slug)
    {
        $preguntas = DB::table('lessons')
            ->select('preguntas.id_pregunta', 'preguntas.pregunta', 'preguntas.opcion1', 'preguntas.opcion2', 'preguntas.opcion3', 'preguntas.respuesta')
            ->join('preguntas', 'preguntas.id_lesson', '=', 'lessons.id')
            ->where('lessons.slug', $slug)
            ->get();

        $lecciones = DB::table('lessons')
            ->select('lessons.id', 'lessons.slug', 'lessons.titulo_seo', 'lessons.titulo', 'lessons.descripcion', 'lessons.audio', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->where('categorias.slug', $slug_cat)
            ->where('lessons.slug', $slug)
            ->get();

        $imagenes = DB::table('lessons')
            ->select('lessonimages.imagen')
            ->join('lessonimages', 'lessonimages.id_lesson', '=', 'lessons.id')
            ->where('lessons.slug', $slug)
            ->orderBy('lessonimages.id_imagen')
            ->get();

        $json['leccion'] = $lecciones;
        $json['preguntas'] = $preguntas;
        $json['imagenes'] = $imagenes;
        return $json;
    }

    public function getLeccionContenido($slug_cat, $slug)
    {
        $contenido = DB::table('lessons')
        ->select('contenido')
        ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
        ->where('categorias.slug', $slug_cat)
        ->where('lessons.slug', $slug)
        ->get();

        $json['contenido'] = $contenido;
        return $json;
    }

    public function getAudio($audio)
    {
        return response()->file(public_path("audio/$audio"));
    }

    public function getInicio()
    {

        $tipos = Tipo::all()
            ->where('estado', 'publica')
            ->where('slug', '!=', 'normal')
            ->sortByDesc('orden')->values()->all();

        $lecciones = DB::table('lessons')
            ->select('lessons.id', 'lessons.slug', 'lessons.titulo', 'lessons.descripcion', 'lessonimages.imagen', 'lessons.audio', 'lessons.id_categoria', 'lessons.id_tipo', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->join('lessonimages', 'lessonimages.id_lesson', '=', 'lessons.id')
            ->where('lessons.estado', 'publica')
            ->where('lessonimages.id_imagen', '0')
            ->orderByDesc('lessons.orden')
            ->get();

        foreach ($tipos as $i => $tipo) {
            $data[$i] = [
                'id' => $tipo->id,
                'titulo' => $tipo->titulo,
                'icono' => $tipo->icono,
                'color' => $tipo->color,
                'bg' => $tipo->bg
            ];
            foreach ($lecciones as $leccion) {
                if ($leccion->id_tipo == $tipo->id) {
                    $data[$i]['data'][] = $leccion;
                }
            }
        }

        $json['secciones'] = $data;
        return $json;
    }

    public function buscarTermino($termino)
    {
        $lecciones = Lesson::where('titulo', 'like', '%' . $termino . '%')->get(['id', 'titulo']);
        $json['results'] = $lecciones;
        return $json;
    }

    public function buscar()
    {
        $lecciones = DB::table('lessons')
            ->select('lessons.id', 'lessons.id_categoria', DB::raw("CONCAT(lessons.titulo,' [',categorias.titulo,']') as titulo"), 'lessons.slug', 'categorias.slug as slug_cat')
            ->join('categorias', 'categorias.id', '=', 'lessons.id_categoria')
            ->where('lessons.estado', 'publica')
            ->get();

        $json['results'] = $lecciones;
        return $json;
    }
}
