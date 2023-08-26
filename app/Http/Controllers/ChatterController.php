<?php

namespace App\Http\Controllers;

use App\Models\Chatter;
use App\Models\ChatterAttachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class
ChatterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Chatter $chatter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chatter $chatter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chatter $chatter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chatter $chatter)
    {
        //
    }

    /**
     * La función "addChatter" recupera datos de chat y datos de usuario para un controlador específico
     * y un registro de clase.
     *
     * @param Controller controller El parámetro  es una instancia de la clase Controller.
     * Se utiliza para acceder a los métodos y propiedades del controlador dentro de la función
     * addChatter.
     * @param id El parámetro `` es un parámetro opcional que representa el ID de un registro de
     * clase. Se utiliza para filtrar a los chaters en función del ID de registro de clase. Si no se
     * proporciona una ID, se establecerá en `null`.
     *
     * @return compact Una matriz con las siguientes claves: 'class_record_id', 'chatterUsers', 'chatters' y
     * 'class_name'. Los valores asociados con estas claves son las variables ,
     * ,  y  respectivamente.
     */
    public static function addChatter(Controller $controller, $id = null)
    {
        $class_name = class_basename($controller);

        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $function_name = $backtrace[1]['function'];
        $class_record_id = $id;

        $chatters = Chatter::orderBy('sent_at', 'desc')->where('class_name', $class_name)->where('class_record_id', $class_record_id)->get();
        $chatterUsers = User::all('id', 'firstname', 'lastname');

        return compact('class_record_id', 'chatterUsers', 'chatters', 'class_name');
    }

    /**
     * La función `sendMessage` en PHP guarda un mensaje en la base de datos y recupera todos los
     * mensajes para una clase dada, opcionalmente filtrados por un ID de registro de clase.
     *
     * @param Request request El parámetro `` es una instancia de la clase `Request`, que se
     * utiliza para recuperar los datos enviados en la solicitud HTTP. Contiene información como la
     * identificación del usuario, el mensaje, el nombre de la clase y la identificación del registro
     * de la clase.
     *
     * @return JSON Si el bloque de prueba tiene éxito, devolverá la colección de
     * chaters como una respuesta JSON. Si hay un error, devolverá el mensaje de error como una
     * respuesta JSON.
     */
    public function sendMessage(Request $request)
    {
        try {
            $chatter = new Chatter();
            $chatter->user_id = $request->user_id;
            $chatter->message = $request->message;
            $chatter->sent_at = now();
            $chatter->class_name = $request->class_name;
            $chatter->class_record_id = $request->class_record_id ?? null;
            $chatter->save();

            $chatters = Chatter::orderBy('sent_at', 'desc')->where('class_name', $request->class_name)->get();

            if ($request->class_record_id) {
                $chatters = Chatter::orderBy('sent_at', 'desc')->where('class_name', $request->class_name)->where('class_record_id', $request->class_record_id)->get();
            }
            foreach ($chatters as $chatter) {
                $chatter->user_id = $chatter->user->firstname . ' ' . $chatter->user->lastname;
            }

            return response()->json($chatters);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public static function newRecordTracking(Controller $controller, User $user, Request $request, Model $model = null)
    {
        $class_name = class_basename($controller);

        $chatter = new Chatter();
        $chatter->user_id = $user->id;
        $chatter->message = 'Nuevo registro creado';
        $chatter->sent_at = now();
        $chatter->class_name = $class_name;
        $chatter->class_record_id = $model->id;
        $chatter->save();
    }

    public static function updatedRecordTracking(Controller $controller, User $user, Request $request, Model $model = null)
    {
        $class_name = class_basename($controller);

        $tempRequest = $request;
        $tempRequest->request->remove('_method');
        $tempRequest->request->remove('_token');

        $msg = "";

        $count = 0;

        foreach ($tempRequest->request->all() as $key => $value) {
            if ($model->$key != $value) {
                $dataField = $tempRequest->input($key . '-label') ?? $key;
                if (substr($key, -6) != '-label') {
                    $msg .= $dataField . ": " . $model->$key . " → " . $value . "<br>";
                    $count++;
                }
            }
        }

        if ($count > 0) {
            $chatter = new Chatter();
            $chatter->user_id = $user->id;
            $chatter->message = $msg;
            $chatter->sent_at = now();
            $chatter->class_name = $class_name;
            $chatter->class_record_id = $model->id;
            $chatter->save();
        }
    }
}
