<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

        $learnerID = Auth::user()->id;

        $query = Application::with('advert.partner')
        ->where('learner_id', $learnerID)
        ->orderBy('created_at', 'desc');

        $applications = isset($searchQuery)
    ? $query->where('status', 'LIKE', '%' . $searchQuery . '%')
            ->orWhereHas('advert', function ($subquery) use ($searchQuery) {
                $subquery->where('title', 'LIKE', '%' . $searchQuery . '%')
                         ->orWhereHas('partner', function ($partnerQuery) use ($searchQuery) {
                             $partnerQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
                         });
            })->paginate(10)
    : $query->paginate(10);
        
        //This autism is fine because propertiesToUnset is of fixed length so it is not n * n time complexity.
        $propertiesToUnset = ['advert', 'partner', 'advert_id', 'updated_at', 'deleted_at'];

      $applications->transform(function ($application) use ($propertiesToUnset) {
        $applicationapplication = $application->advert->title;
        $applicationPartnerName = $application->advert->partner->name;
        $application->advertTitle = $applicationapplication;
        $application->partnerName = $applicationPartnerName;
        foreach ($propertiesToUnset as $property) unset($application->$property);
        return $application;
    });

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
        try {
            $userID = $request->user()->id;
            $advertID = $request->input('advertID');
            Application::create(["learner_id" => $userID, "advert_id" => $advertID]);
            return redirect()->route("dashboard.applications")->with("success", "Application created successfully");
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                return redirect()->back()->withErrors($e->errors()); //this will remain unhandeled in the view because I need sleep
            }
            return redirect()->back()->with('error', 'An error occurred while processing your request.'); //this aswell :)
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
    public function destroy(string $applicationID)
    {
        $id = intval($applicationID);
        try {
            $advert = Application::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
        $advert->delete();
        return redirect()->back();
    }
}
