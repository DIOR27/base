<?php

namespace App\Http\Controllers;

use App\Models\Chatter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

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
     * La función almacena un nuevo registro de Chatter en la base de datos y devuelve una respuesta
     * JSON que contiene todos los registros de Chatter para un nombre de clase y un ID de registro de
     * clase determinados.
     *
     * @param Request request El parámetro  es una instancia de la clase Request, que contiene
     * todos los datos que se enviaron con la solicitud HTTP. Le permite acceder a los valores de
     * entrada, encabezados, cookies y otra información relacionada con la solicitud. En este fragmento
     * de código, el objeto  se utiliza para recuperar el
     *
     * @return JSON respuesta JSON. Si el bloque de prueba tiene éxito, devolverá la colección de
     * usuarios del chat en formato JSON. Si se detecta una excepción, devolverá el mensaje de error en
     * formato JSON.
     */
    public function store(Request $request)
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
                $chatter->user_id = $chatter->user->name . ' ' . $chatter->user->lastname;
                $date = new Date($chatter->sent_at);
                $chatter->sent_at = $date->ago();
            }

            return response()->json($chatters);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
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
        foreach ($chatters as $chatter) {
            $chatter->user_id = $chatter->user->name . ' ' . $chatter->user->lastname;
            $date = new Date($chatter->sent_at);
            $chatter->sent_at = $date->ago();
        }

        $chatterUsers = User::all('id', 'name', 'lastname');

        return compact('class_record_id', 'chatterUsers', 'chatters', 'class_name');
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
