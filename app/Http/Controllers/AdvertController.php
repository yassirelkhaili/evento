<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private array $validationRules = [
        'title' => 'required|string',
        'content' => 'required|string',
        'partnerID' => 'required|integer',
    ];
    public function index()
    {
        if (!session()->has('loginMessageShown')) {
            Session::flash('loginMessage', "You're logged in!");
            session(['loginMessageShown' => true]);
        }
        $adverts = Advert::with('partner:id,name')->orderBy('created_at', 'desc')->get();
    $adverts->transform(function ($advert) {
        $advert->partnerName = $advert->partner->name;
        unset($advert->partner);
        return $advert;
    });
    return view('dashboard', compact('adverts'));
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
    public function store(Request $request, Advert $advert)
    {
        $data = $request->all();

        $validator = Validator::make($data, $this->validationRules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $validatedData = $validator->validated();

        try {
            $advert::create($validatedData);
            return redirect()->back()->with("success", "advert added successfuly!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating advert. Please try again.']);
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
    public function destroy($advertID)
    {
            $id = intval($advertID);
            try {
                $advert = Advert::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                abort(404);
            }
            $advert->delete();
            return redirect()->route('dashboard');
    }
}
