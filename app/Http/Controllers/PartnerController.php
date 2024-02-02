<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private array $validationRules = [
        'name' => 'required|string|min:3|max:50',
        'industry' => 'required|string|min:3|max:50',
        'size' => 'required|in:small,medium,large',
        'location' => 'required|string|min:3|max:120',
        'description' => 'required|string|min:10|max:255',
        'logo' => 'required|file|mimes:svg,png,jpg|max:2048',
    ];
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard', compact('partners'));
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
    public function store(Request $request, Partner $partner)
    {
        $data = $request->all();

        $validator = Validator::make($data, $this->validationRules);
    
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        if ($request->hasFile('logo')) {
            try {
                $uploadedFile = $request->file('logo');
                $logoPath = $uploadedFile->store('logos', 'public');
                $data['logo'] = $logoPath;
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors(['error' => 'Error uploading logo. Please try again. ' . $e->getMessage()]);
            }
        }
    
        try {
            $partner::create($data);
            return redirect()->back()->with("success", "Partner added successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating partner. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $partnerID)
    {
        try {
            $partner = Partner::findOrFail($partnerID);
            return response()->json($partner, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Partner not found. errorcode: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->validationRules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $validatedData = $validator->validated();

        try {
            $partner->update($validatedData);
            return redirect()->back()->with("success", "Partner edited successfuly!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error creating partner. Please try again. errorcode: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($partnerID)
    {
            $id = intval($partnerID);
            try {
                $partner = Partner::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                abort(404);
            }
            $partner->delete();
            return redirect()->route('dashboard.partners');
    }
}
