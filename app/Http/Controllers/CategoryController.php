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
        $categories = $this->categoryRepository->getAll();
        $searchQuery = '';
        return view('dashboard', compact('categories', 'searchQuery'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->categoryRepository->create($request->input());
        return redirect()->route("index")->with('success','Category created successfuly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Category = $this->categoryRepository->getById($id);
        return view("Categorys.edit", compact("Category"));
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
        return redirect()->route("index")->with("success","Category updated successfuly.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->back()->with('success','Category deleted successfully.');
    }
}