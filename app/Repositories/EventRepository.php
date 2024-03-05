<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventRepository implements EventRepositoryInterface
{
    public function getAll()
    {
        return Event::where('user_id', Auth::id())->get();;
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
}