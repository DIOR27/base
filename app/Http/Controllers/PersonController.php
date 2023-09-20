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

        $person = Person::withTrashed()->where('email', $request->email)->where('company_id', auth()->user()->company_id)->first();

        if ($request->identifier) {
            $person = Person::withTrashed()->where('identifier', $request->identifier)->where('company_id', auth()->user()->company_id)->first();
        }

        $imageName = null;

        if ($request->photo) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(storage_path('app/public/profile'), $imageName);

            if ($person && $person->photo) {
                $existingPhotoPath = storage_path('app/public/profile/' . $person->photo);
                if (file_exists($existingPhotoPath)) {
                    unlink($existingPhotoPath);
                }
            }
        }

        $person = Person::updateOrcreate(
            ['id' => $person ? $person->id : null], // Verifica si $person existe
            [
                'photo' => $imageName,
                'company_id' => auth()->user()->company_id,
            ] + $request->all()
        );

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
        $imageName = null;

        if ($request->photo) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(storage_path('app/public/profile'), $imageName);

            if ($person && $person->photo) {
                $existingPhotoPath = storage_path('app/public/profile/' . $person->photo);
                if (file_exists($existingPhotoPath)) {
                    unlink($existingPhotoPath);
                }
            }
        }

        $person->update([
            'photo' => $imageName,
            'company_id' => auth()->user()->company_id,
        ] + $request->all());

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
