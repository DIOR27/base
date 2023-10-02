<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ToolController extends Controller
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
    public function store(Request $request, Model $model)
    {
        try {

            $request->merge(array_map(function ($value) {
                return is_string($value) ? $value . ' ' . __('copy') : $value;
            }, $request->all()));

            $model->create($request->all());

            return response()->json([
                'success' => true,
                'model_id' => $model->id,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * The function updates a user's information with the provided person and request data.
     * It allows to update the user in every controller that extends the ToolController.
     * 
     * @param User user The "user" parameter is an instance of the User model. It represents the user
     * that needs to be updated.
     * @param Person person The "person" parameter is an instance of the "Person" class, which
     * represents a person's information such as name and lastname.
     * @param Request request The `` parameter is an instance of the `Request` class, which
     * represents an HTTP request made to the server. It contains information about the request, such
     * as the request method, URL, headers, and any data sent with the request.
     * 
     * @return User updated User object.
     */
    public function userUpdate(User $user, Person $person, Request $request)
    {
        $user->update($request->merge([
            'person_id' => $person->id,
            'name' => $person->name,
            'lastname' => $person->lastname,
            'password' => $request->get('password') ? bcrypt($request->get('password')) : $user->password,
        ])->all());

        return $user;
    }
}
