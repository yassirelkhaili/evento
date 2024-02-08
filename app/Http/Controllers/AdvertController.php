<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdvertController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    private array $validationRules = [
        'title' => 'required|string|min:18|max:255',
        'content' => 'required|string|min:18|max:255',
        'partnerID' => 'required|integer',
    ];

    public function index(Request $request)
    {
        if (!session()->has('loginMessageShown')) {
            Session::flash('loginMessage', "You're logged in!");
            session(['loginMessageShown' => true]);
        }
        
        $searchQuery = $request->input('search');

        $query = Advert::with('partner:id,name')->orderBy('created_at', 'desc');

        $adverts = isset($searchQuery)
        ? $query->where('title', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('content', 'LIKE', '%' . $searchQuery . '%')
                ->orWhereHas('partner', function ($subquery) use ($searchQuery) {
                    $subquery->where('name', 'LIKE', '%' . $searchQuery . '%');
                })->paginate(10)
        : $query->paginate(10);

      $adverts->transform(function ($advert) {
        $advert->partnerName = $advert->partner->name;
        unset($advert->partner);
        return $advert;
    });

    return view('dashboard', ['adverts' => $adverts, 'searchQuery' => $searchQuery]);
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
    public function show(Request $request, int $advertID)
    {
        try {
            $advert = Advert::findOrFail($advertID);
            return response()->json($advert, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Partner not found. errorcode: ' . $e->getMessage()], 404);
        }
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
    public function update(Request $request, Advert $advert)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->validationRules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $validatedData = $validator->validated();

        try {
            $advert->update($validatedData);
            return redirect()->back()->with("success", "advert edited successfuly!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating advert. Please try again. errorcode: ' . $e->getMessage()]);
        }
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

    public function generateRecommendations (Request $request) {
        $userSkills = Auth::user()->skills()->pluck('name')->toArray();
        $searchQuery = $request->input('search');

        $adverts = Advert::query()
        ->when(isset($searchQuery), function ($query) use ($searchQuery) {
            $query->where('title', 'LIKE', '%' . $searchQuery . '%')
                ->orWhere('content', 'LIKE', '%' . $searchQuery . '%')
                ->orWhereHas('partner', function ($subquery) use ($searchQuery) {
                    $subquery->where('name', 'LIKE', '%' . $searchQuery . '%');
                });
        })
        ->paginate(10);

        $filteredAdverts = $adverts->filter(function ($advert) use ($userSkills) {
            $advertSkills = $advert->skills()->pluck('name')->toArray();
            //calculate the intersection of user skills and advert skills
            $intersection = array_intersect($userSkills, $advertSkills);
            //calculate the Jaccard similarity coefficient
            $similarity = count($intersection) / (count($userSkills) + count($advertSkills) - count($intersection));
            return $similarity >= 0.6;
        })->map(function ($advert) {
            return [
                'id' => $advert->id,
                'title' => $advert->title,
                'content' => $advert->content,
                'partner' => $advert->partner()->pluck('name')->toArray(),
                'created_at' => $advert->created_at,
                'skills' => $advert->skills()->pluck('name')->toArray(),
            ];
        });

        //set paginated adverts to filtered and paginated adverts
        $adverts->setCollection($filteredAdverts);
        return view('dashboard', ['recommendations'=> $adverts, 'searchQuery' => $searchQuery]);
    }
}
