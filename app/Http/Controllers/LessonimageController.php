<?php

namespace App\Http\Controllers;

use App\Models\Lessonimage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LessonimageController extends Controller
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

    public function updateOrden(Request $request)
    {

        $imgs = Lessonimage::all();

        foreach ($imgs as $img) {
            foreach ($request->orden as $orden) {
                if ($orden['id'] == $img->id) {
                    $img->update(['id_imagen' => $orden['posicion']]);
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
    public function destroy($id)
    {
        //
    }

    public function eliminar($id, $id_lesson)
    {
        $lessonimage = Lessonimage::find($id);
        $lessonimage->delete();
        File::delete("imagen/$lessonimage->imagen");

        $images = Lessonimage::where('id_lesson', $id_lesson)
        ->orderBy('id_imagen')
        ->get();

        foreach ($images as $key => $img) {
            $img->update(['id_imagen' => $key]);
        }

        return redirect()->back();
    }
}
