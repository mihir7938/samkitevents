<?php

namespace App\Services;

use App\Models\Day;

class DayService
{

    public function getDayById($id)
    {
        return Day::find($id);
    }

    public function create($data)
    {
        return Day::create($data);
    }

    public function update($day, $data)
    {
        return $day->update($data);
    }

    public function delete($day)
    {
        return $day->delete($day);
    }
    public function fetchDaysByEvent($event_id)
    {
        return Day::where('event_id', $event_id)->get();
    }
}
