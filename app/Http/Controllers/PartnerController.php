<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('/dashboard', compact('partners'));
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
    public function show(Partner $partner)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($partnerID)
    {
            $id = intval($partnerID);
            $partner = Partner::find($id);
            $partner->delete();
            return redirect()->route('dashboard.partners');
    }
}
