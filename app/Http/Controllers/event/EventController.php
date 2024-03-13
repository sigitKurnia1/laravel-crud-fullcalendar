<?php

namespace App\Http\Controllers\event;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScheduleMail;

class EventController extends Controller
{
    public function index() {
        $user = User::all();

        return view('event.index', compact('user'));
    }

    public function eventList() {
        $schedule = Schedule::all();

        return view('event.event-list', compact('schedule'));
    }

    public function getEvents() {
        $schedules = Schedule::all();

        $events = $schedules->map(function ($schedule) {
        return [
            'id' => $schedule->id,
            'title' => $schedule->title,
            'participant' => $schedule->participant,
            'start' => $schedule->start,
            'end' => $schedule->end,
            'meeting_start' => $schedule->meeting_start,
            'meeting_end' => $schedule->meeting_end,
            'description' => $schedule->description,
            ];
        });

        return response()->json($events);
    }

    public function getEventId($id) {
        $event = Schedule::findOrFail($id);
        
        return view('event.update', compact('event'));
    }

    public function createEvent(Request $request) {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        $title = 'New Meeting Scedule!';
        $body = 'Theres a new meeting for you, login to the app to see the detail!';
        Mail::to($user->email)->send(new ScheduleMail($title, $body));

        $data = new Schedule;

        $data->title = $request->title;
        $data->start = $request->start;
        $data->participant = $user->name;
        $data->end = $request->start;
        $data->meeting_start = $request->start_time;
        $data->meeting_end = $request->end_time;
        $data->description = $request->description;

        $data->save();
        
        if ($data) {
            toast('Event created successfully!', 'success');
            return redirect('/');
        } else {
            toast('Failed to create event!', 'error');
            return redirect('/');
        }
    }

    public function updateEvent(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required',
            'meeting_start' => 'required',
            'meeting_end' => 'required',
            'description' => 'required',
        ]);

        $event = Schedule::findOrFail($id);

        $event->title = $request->title;
        $event->start = $request->start;
        $event->meeting_start = $request->meeting_start;
        $event->meeting_end = $request->meeting_end;
        $event->description = $request->description;

        $event->save();

        return redirect('/event-list');
    }

    public function deleteEvent($id) {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect('/event-list');
    }

    public function searchEvents(Request $request) {
        $searchKeywords = $request->input('title');

        $matchingEvents = Schedule::where('title', 'LIKE', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }

    public function exportEvents() {
        $data = Schedule::all();

        $pdf = PDF::loadView('event.export', compact('data'));
        return $pdf->stream('rekap_jadwal_meeting.pdf');
    }
}
