<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
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

        $request->merge([
            'company_id' => auth()->user()->company_id,
            'photo' => $request->profile_picture ? $request->file('profile_picture')->store('profile') : null,
        ]);

        $person = Person::withTrashed()->where('email', $request->email)->where('company_id', auth()->user()->company_id)->first();

        if ($request->identifier) {
            $person = Person::withTrashed()->where('identifier', $request->identifier)->where('company_id', auth()->user()->company_id)->first();
        }

        if ($person) {
            $person->restore();
            $person->update($request->all());
        } else {
            $person = Person::create($request->all());
        }

        return $person;
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $person->update($request->all());

        return $person;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return $person;
    }
}
