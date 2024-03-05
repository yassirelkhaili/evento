<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct (CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->categoryRepository->getAll();
        return view('welcome', compact('events'));
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
        $this->categoryRepository->create($request->input());
        return redirect()->route("index")->with('success','event created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = $this->categoryRepository->getById($id);
        return view("events.edit", compact("event"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->categoryRepository->update($id, $request->input());
        return redirect()->route("index")->with("success","event updated successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->back()->with('success','event deleted successfully');
    }
}