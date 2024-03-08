<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventRepository implements EventRepositoryInterface
{
    public function getAll()
    {
        return Event::orderBy('created_at', 'desc')->where('status', 'published')->paginate(9);
    }

    public function getById($id)
    {
        return Event::findOrFail($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update($id, array $data)
    {
        $Event = $this->getById($id);
        $Event->update($data);
        return $Event;
    }

    public function delete($id)
    {
        $Event = $this->getById($id);
        $Event->delete();
    }

    public function getOwnEvents() {
        $events = Event::with('category')->where('user_id', Auth::user()->id)->paginate(10);
        return $events;
    }

    public function getPendingEvents() {
        $events = Event::with('category')->where('status', 'pending')->where('validation_method', 'manual')->paginate(10);
        return $events;
    }

    public function getEventCount() {
        $eventCount = Event::count();
        return $eventCount;
    }
}