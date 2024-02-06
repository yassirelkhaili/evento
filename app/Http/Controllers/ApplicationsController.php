<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;

class ApplicationsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!session()->has('loginMessageShown')) {
            Session::flash('loginMessage', "You're logged in!");
            session(['loginMessageShown' => true]);
        }
        
        $searchQuery = $request->input('search');

        $query = Application::orderBy('created_at', 'desc');

    //     $adverts = isset($searchQuery)
    //     ? $query->where('title', 'LIKE', '%' . $searchQuery . '%')
    //             ->orWhere('content', 'LIKE', '%' . $searchQuery . '%')
    //             ->orWhereHas('partner', function ($subquery) use ($searchQuery) {
    //                 $subquery->where('name', 'LIKE', '%' . $searchQuery . '%');
    //             })->paginate(10)
    //     : $query->paginate(10);

    //   $adverts->transform(function ($advert) {
    //     $advert->partnerName = $advert->partner->name;
    //     unset($advert->partner);
    //     return $advert;
    // });
    $applications = $query->paginate(10);

    dd($applications);

    return view('dashboard', ['applications' => $applications, 'searchQuery' => $searchQuery]);
        
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
        //
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
}
