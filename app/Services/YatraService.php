<?php

namespace App\Services;

use App\Models\Yatra;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class YatraService
{
    public function getYatraById($id)
    {
        return Yatra::find($id);
    }
    public function create($data)
    {
        return Yatra::create($data);
    }
    public function update($yatra, $data)
    {
        return $yatra->update($data);
    }
    public function delete($yatra)
    {
        return $yatra->delete($yatra);
    }
    public function fetchYatraByEvent($event_id)
    {
        return Yatra::where('event_id', $event_id)->groupBy('day_id')->get();
    }
}
