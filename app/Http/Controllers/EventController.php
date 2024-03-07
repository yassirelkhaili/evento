<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;

class EventController extends Controller
{
    protected EventRepositoryInterface $eventRepository;
    protected CategoryRepositoryInterface $categoryRepository;
    public function __construct(EventRepositoryInterface $eventRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->eventRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        return view('welcome', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter(Request $request)
    {
        $searchQuery = $request->input('search');
        $category = $request->input('category');
        $categories = $this->categoryRepository->getAll();
        $query = Event::query();
        if ($searchQuery) $query->where('title', 'LIKE', '%' . $searchQuery . '%');
        if ($category) $query->where('category_id', '=', $category);

        $events = $query->paginate(9);
        return view("welcome", ['events' => $events, 'searchQuery' => $searchQuery, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $eventData = $request->input();
        if ($request->hasFile('event_picture')) {
            $path = $request->file('event_picture')->store('public/events');
            $relativePath = str_replace('public/', 'storage/', $path);
        } else {
            return redirect()->route('organizer.events')->withErrors(['event_picture' => 'The event picture is required.'])->withInput();
        }
        $eventData['event_picture'] = $relativePath;
        $eventData['user_id'] = Auth::user()->id;
        $eventData['date'] = format_date($eventData['date']);
        $eventData['category_id'] = $eventData['category'];
        unset($eventData['category']);
        $eventData['validation_method'] === 'automatic' ? $eventData['status'] = 'published' : $eventData['status'] = 'pending';
        $this->eventRepository->create($eventData);
        return redirect()->route("organizer.events")->with('success', 'Event created successfuly.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = $this->eventRepository->getById($id);
        return view("events.edit", compact("event"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->eventRepository->update($id, $request->input());
        return redirect()->route("index")->with("success", "event updated successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->eventRepository->delete($id);
        return redirect()->back()->with('success', 'Event deleted successfully.');
    }

    public function indexOwnEvents(Request $request) {
        $searchQuery = $request->input('search');
            $events = $this->eventRepository->getOwnEvents();
            $categories = $this->categoryRepository->getAll();
            return view('dashboard', compact('events', 'searchQuery', 'categories'));
    }
}
