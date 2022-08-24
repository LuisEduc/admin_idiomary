<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DiariopalabraController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonimageController;
use App\Http\Controllers\PalabraController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\PushuserController;
use App\Http\Controllers\TipoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// DASHBOARD
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::get('/preguntas/eliminar/{id}/{id_lesson}', 'App\Http\Controllers\PreguntaController@eliminar')->name('preguntas.eliminar');
    Route::get('/lessonimages/eliminar/{id}/{id_lesson}', 'App\Http\Controllers\LessonimageController@eliminar')->name('lessonimages.eliminar');
    Route::get('/palabras/basico', 'App\Http\Controllers\PalabraController@basico')->name('palabras.basico');
    Route::get('/palabras/medio', 'App\Http\Controllers\PalabraController@medio')->name('palabras.medio');
    Route::get('/palabras/avanzado', 'App\Http\Controllers\PalabraController@avanzado')->name('palabras.avanzado');
    Route::get('/palabras/reproducir', 'App\Http\Controllers\PalabraController@reproducir')->name('palabras.reproducir');
    Route::get('/pushusers', 'App\Http\Controllers\PushuserController@index')->name('pushusers.index');

    Route::resource('/lessons', LessonController::class);
    Route::resource('/categorias', CategoriaController::class);
    Route::resource('/preguntas', PreguntaController::class);
    Route::resource('/palabras', PalabraController::class);
    Route::resource('/diariopalabras', DiariopalabraController::class);
    Route::resource('/tipos', TipoController::class);
    Route::resource('/lessonimages', LessonimageController::class);

    
    Route::post('/lessonimages/updateorden', 'App\Http\Controllers\LessonimageController@updateOrden')->name('lessonimages.updateorden');
    Route::post('/categorias/updateorden', 'App\Http\Controllers\CategoriaController@updateOrden')->name('categorias.updateorden');
    Route::post('/tipos/updateorden', 'App\Http\Controllers\TipoController@updateOrden')->name('tipos.updateorden');
    Route::post('/lessons/updateorden', 'App\Http\Controllers\LessonController@updateOrden')->name('lessons.updateorden');
    Route::post('/diariopalabras/updateorden', 'App\Http\Controllers\DiariopalabraController@updateOrden')->name('diariopalabras.updateorden');

    Route::put('/palabras/grabar/{id}', 'App\Http\Controllers\PalabraController@grabar')->name('palabras.grabar');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
