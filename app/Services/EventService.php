<?php

namespace App\Services;

use App\Models\Event;

class EventService
{

    public function getAllEvents($per_page = -1)
    {
        if($per_page == -1){
            return Event::orderBy('created_at', 'desc')->get();    
        }
        return Event::orderBy('created_at', 'desc')->paginate($per_page);
    }

    public function getEventById($id)
    {
        return Event::find($id);
    }

    public function create($data)
    {
        return Event::create($data);
    }

    public function update($event, $data)
    {
        return $event->update($data);
    }

    public function delete($event)
    {
        return $event->delete($event);
    }
}
