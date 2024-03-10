<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $ticketId = Str::uuid()->toString();
        $event = $this->eventRepository->getById($eventId);
        if (!$event || $event->available_seats <= 0) return redirect()->route('bookings.index')->with('error', 'This event is fully booked');
        $this->eventRepository->update($eventId, ['available_seats', $event->available_seats - 1]);
        Ticket::create(['uuid' => $ticketId,'user_id' => auth()->user()->id, 'event_id' => $eventId]);
        return redirect()->route('bookings.index')->with('success', 'Booking created successfuly');
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::with('event')->findOrFail($id);
        $event = $this->eventRepository->getById($ticket->event->id);
        $this->eventRepository->update($event->id, ['available_seats' => $event->available_seats + 1]);
        $ticket->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully.');
    }

    public function download(string $id)
    {
        $ticket = Ticket::findOrFail($id); 
        $pdf = PDF::loadView('pdfs\tickets', ['ticket' => $ticket]);
        return $pdf->download('event-ticket.pdf');
    }
}
