<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;

class TicketController extends Controller
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
        $userId = auth()->user()->id;
        $tickets = Ticket::with('event')->where('user_id', $userId)->paginate(10);
        $searchQuery = '';
        return view('dashboard', compact('tickets', 'searchQuery'));
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
        $eventId = $request->input('bookingId');
        $event = $this->eventRepository->getById($eventId);
        if (!$event || $event->available_seats <= 0) return redirect()->route('bookings.index')->with('error', 'This event is fully booked');
        $this->eventRepository->update($eventId, ['available_seats', $event->available_seats - 1]);
        Ticket::create(['user_id' => auth()->user()->id, 'event_id' => $eventId]);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }
}
