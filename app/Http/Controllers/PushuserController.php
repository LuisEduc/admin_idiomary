<?php

namespace App\Http\Controllers;

use App\Models\Diariopalabra;
use App\Models\Lesson;
use App\Models\Categoria;
use App\Models\Lessonimage;
use App\Models\Pushuser;
use Illuminate\Http\Request;

class PushuserController extends Controller
{
    public function index(Request $request)
    {
        $pushusers = Pushuser::all();
        return view('pushusers.index', compact('pushusers'));
    }

    public function saveToken(Request $request)
    {
        if (Pushuser::where('device_id', $request->device_id)->exists()) {
            $device_id = Pushuser::where('device_id', $request->device_id);
            $device_id->update(['device_token' => $request->device_token]);
            return response()->json(['token actualizado correctamente']);
        } else {
            Pushuser::create($request->all());
            return response()->json(['token guardado correctamente']);
        }
    }

    public function deletePushUser(Request $request)
    {
        if (Pushuser::where('device_id', $request->device_id)->exists()) {
            $usuario = Pushuser::where('device_id', $request->device_id);
            $usuario->delete();
            return $usuario ? response()->json(['en' => 1, 'm' => 'eliminado correctamente']) : response()->json(['en' => -1, 'm' => 'error al eliminar']);
        } else {
            return response()->json(['en' => 0, 'm' => 'no existe el usuario']);
        }
    }

    public function sendNotification(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $imagen = Lessonimage::where('id_lesson', $id)->first();
        $firebaseToken = Pushuser::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'no_key';

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $dataChunk = array_chunk($firebaseToken, 900);

        foreach ($dataChunk as $dataMil) {

            if (is_null($lesson->titulo)) {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => 'Recordatorio',
                        "body" => '¡Tómate 5 minutos para practicar!',
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                    ],
                ];
            } else {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => 'Lección de hoy ¡Vamos a practicar! 🔔',
                        "body" => $lesson->titulo_seo,
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                        "image" => 'https://admin.inglesxdia.com/imagen/' . $imagen->imagen,
                    ],
                    "data" => [
                        "cat" => $lesson->categorias->slug,
                        "lec" => $lesson->slug,
                    ],
                ];
            }


            $dataString = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }
        return redirect()->route('lessons.index');
    }

    public function sendNotificationTopic(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $imagen = Lessonimage::where('id_lesson', $id)->first();

        $SERVER_API_KEY = 'no_key';

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        if (is_null($lesson->titulo)) {

            $data = [
                "to" => "/topics/inglesxdia-main",
                "notification" => [
                    "title" => 'Recordatorio 🔔',
                    "body" => '¡Tómate 5 minutos para practicar!',
                    "content_available" => true,
                    "priority" => "high",
                    "icon" => "/favicon.png",
                ],
            ];
        } else {

            $data = [
                "to" => "/topics/inglesxdia-main",
                "notification" => [
                    "title" => 'Lección de hoy ¡Vamos a practicar! 🔔',
                    "body" => $lesson->titulo_seo,
                    "content_available" => true,
                    "priority" => "high",
                    "icon" => "/favicon.png",
                    "image" => 'https://admin.inglesxdia.com/imagen/' . $imagen->imagen,
                ],
                "data" => [
                    "cat" => $lesson->categorias->slug,
                    "lec" => $lesson->slug,
                ],
            ];
        }

        $dataString = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->route('lessons.index');
    }

    public function customNotification(Request $request)
    {
        if ($request->users == "todos") {
            $firebaseToken = Pushuser::whereNotNull('device_token')->pluck('device_token')->all();
        } else {
            $firebaseToken = array();
            $firebaseToken[] = $request->users;
        }

        $SERVER_API_KEY = 'no_key';

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $dataChunk = array_chunk($firebaseToken, 900);

        foreach ($dataChunk as $dataMil) {

            if (is_null($request->titulo) || is_null($request->descripcion)) {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => 'Recordatorio 🔔',
                        "body" => '¡Tómate 5 minutos para practicar!',
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                    ],
                ];
            } else {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => $request->titulo,
                        "body" => $request->descripcion,
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                    ],
                    "data" => [
                        "cat" => $request->cat,
                        "lec" => $request->lec,
                    ],
                ];
            }

            $dataString = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }
        return redirect()->route('lessons.index');
    }

    public function sendNotificationVoc(Request $request, $id)
    {
        $vocabulario = Diariopalabra::find($id);
        $firebaseToken = Pushuser::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'no_key';

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $dataChunk = array_chunk($firebaseToken, 900);

        foreach ($dataChunk as $dataMil) {

            if (is_null($vocabulario->palabras_in)) {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => 'Recordatorio',
                        "body" => '¡Tómate 5 minutos para practicar!',
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                    ],
                ];
            } else {

                $data = [
                    "registration_ids" => $dataMil,
                    "notification" => [
                        "title" => 'Vocabulario de hoy 🔔',
                        "body" => $vocabulario->palabras_in,
                        "content_available" => true,
                        "priority" => "high",
                        "icon" => "/favicon.png",
                    ],
                ];
            }

            $dataString = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
        }
        return redirect()->route('diariopalabras.index');
    }

    public function sendNotificationVocTopic(Request $request, $id)
    {
        $vocabulario = Diariopalabra::find($id);

        $SERVER_API_KEY = 'no_key';

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        if (is_null($vocabulario->palabras_in)) {

            $data = [
                "to" => "/topics/inglesxdia-main",
                "notification" => [
                    "title" => 'Recordatorio 🔔',
                    "body" => '¡Tómate 5 minutos para practicar!',
                    "content_available" => true,
                    "priority" => "high",
                    "icon" => "/favicon.png",
                ],
            ];
        } else {

            $data = [
                "to" => "/topics/inglesxdia-main",
                "notification" => [
                    "title" => 'Vocabulario de hoy 🔔',
                    "body" => $vocabulario->palabras_in,
                    "content_available" => true,
                    "priority" => "high",
                    "icon" => "/favicon.png",
                ],
            ];
        }

        $dataString = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->route('diariopalabras.index');
    }
}
