<?php

namespace App\Http\Controllers;

use App\Project;
use App\TimeEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimeEntryController extends Controller
{
    public function create(Project $project)
    {
        if (request()->has('start_time') && request()->has('finish_time')) {
            $diffInSeconds = Carbon::parse(request('date'))
                ->setTimeFromTimeString(\request('start_time'))
                ->diffInSeconds(
                    Carbon::parse(request('date'))
                        ->setTimeFromTimeString(\request('finish_time'))
                );
        }

        $time          = new TimeEntry;
        $time->user_id = auth()->id();
        $time->date    = Carbon::parse(request('date'));
        if (request()->has('start_time') && request()->has('finish_time')) {
            $time->start_time        = request('start_time');
            $time->finish_time       = request('finish_time');
            $time->length_in_seconds = $diffInSeconds;
            //$time->length_string = date('H:i', mktime(0, 0, $diffInSeconds));
        }
        $time->content = request('content');

        $project->times()->save($time);

        return redirect()->route('project.view', $project)
            ->with('success', 'Successfully added time!');
    }

    public function edit(Project $project, TimeEntry $time)
    {
        if (auth()->id() !== $project->user_id) {
            abort(404);
        }
        $diffInSeconds = 0;
        if (request()->has('start_time') && request()->has('finish_time')) {
            $diffInSeconds = Carbon::parse(request('date'))
                ->setTimeFromTimeString(\request('start_time'))
                ->diffInSeconds(
                    Carbon::parse(request('date'))
                        ->setTimeFromTimeString(\request('finish_time'))
                );
        }


        $time->date = Carbon::parse(request('date'));
        if (request()->has('start_time') && request()->has('finish_time')) {
            $time->start_time        = request('start_time');
            $time->finish_time       = request('finish_time');
            $time->length_in_seconds = $diffInSeconds;
        }
        $time->content = request('content');

        $time->save();

        return redirect()->route('project.view', $project)
            ->with('success', 'Updated time!');
    }
}
