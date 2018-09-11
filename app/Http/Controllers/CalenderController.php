<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use App\Event;

class CalenderController extends Controller
{
    public function FullCalender()
    {
        $events = [];
        $data = DB::select('select * from events');
        var_dump($data);
        if(count($data)) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->title,
                    true,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date.' +1 day'),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',
	                    'url' => 'pass here url and any route',
	                ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
        return view('viewtimingsevents', compact('calendar'));
    }
}
