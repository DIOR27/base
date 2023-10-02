<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = $model->with('person')->where('company_id', auth()->user()->company_id)->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $chatterObj = ChatterController::addChatter($this);

        return view('users.create', $chatterObj);
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $person = app(PersonController::class)->store($request);

        $user = User::withTrashed()->where('person_id', $person->id)->first();
        $data = $request->merge([
            'person_id' => $person->id,
            'company_id' => $person->company_id,
            'name' => $person->name,
            'lastname' => $person->lastname,
            'password' => bcrypt($request->get('password')),
        ])->all();

        if ($user) {
            $user->update($data);
        } else {
            $user = $model->create($data);
        }

        ChatterController::newRecordTracking($this, auth()->user(), $request, $user);

        return redirect()->route('user.edit', $user);
    }

    /**
     * Display the specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $chatterObj = ChatterController::addChatter($this, $user->id);

        return view('users.edit', compact('user'), $chatterObj);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        ChatterController::updatedRecordTracking($this, auth()->user(), $request, $user);
        $person = app(PersonController::class)->update($request, $user->person);

        $user = app(ToolController::class)->userUpdate($user, $person, $request);

        return redirect()->route('user.edit', $user->id);
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User deleted succesfully.'));
    }
}
