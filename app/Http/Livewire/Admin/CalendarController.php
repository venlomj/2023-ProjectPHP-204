<?php

namespace App\Http\Livewire\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSupplement;
use App\Models\Contest;
use App\Models\Training;

class CalendarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $events = [];
        // $supplements = GiveSupplements::orderBy(['id'])->get();
        
        $id = auth()->id();
        $supplements = UserSupplement::where('user_id', '=', $id)
        ->with('user', 'supplement')
        ->get();
        $contests = Contest::orderBy('id')
        ->get();
        $trainings = Training::where('user_id', '=', $id)
        ->with('user', 'training_type')
        ->get();
        foreach ($supplements as $supplement) {
            
            $events[] = [
                'title' => $supplement->supplement->name . ' (' . $supplement->amount . ')',
                'start' => $supplement->supplement_schedule,
                'end' => $supplement->supplement_schedule,
                'backgroundColor' => "lightblue",
                'textColor' => "black"
            ];
        }
        foreach ($contests as $contest) {
            
            $events[] = [
                'title' => $contest->name,
                'start' => $contest->date,
                'end' => $contest->date,
                'backgroundColor' => "red",
                'textColor' => "black"
            ];
        }
        foreach ($trainings as $training) {
            
            $events[] = [
                'title' => $training->training_type->name,
                'start' => $training->start_time,
                'end' => $training->end_time,
                'backgroundColor' => "lightgreen",
                'textColor' => "black"
            ];
        }
 
        return view('calendar', compact('events'));
    }
}
