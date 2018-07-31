<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use function date_create;
use DateTimeZone;
use Illuminate\Http\Request;
use function str_random;

class ProjectController extends Controller
{
    public function publicView($uid)
    {
        $project = Project::where('uid', $uid)->first();

        if (!$project) {
            abort(404);
        }

        $hoursThisMonth = "0";
        $hoursLastMonth = "0";
        $hoursThisWeek  = "0";
        $totalHours     = "0";
        $avgHours       = "0";
        $hoursLastWeek  = "0";

        if ($project->times()->first()) {
            $hoursThisMonth = $project->hoursBetween(
                now()->startOfMonth(),
                now()->endOfMonth()
            );
            $hoursLastMonth = $project->hoursBetween(
                Carbon::parse(now()->startOfMonth())->subMonth()->startOfMonth(),
                Carbon::parse(now()->startOfMonth())->subMonth()->endOfMonth()
            );
            $hoursThisWeek  = $project->hoursBetween(
                now()->startOfWeek(),
                now()->endOfWeek()
            );
            $hoursLastWeek  = $project->hoursBetween(
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            );
            $totalHours     = $project->totalHours();
            $avgHours       = $project->avgHours();

        }

        return view('project.public-view', [
            'project'        => $project,
            'times'          => $project->times()->orderBy('date', 'desc')->get(),
            'hoursThisMonth' => $hoursThisMonth,
            'hoursLastMonth' => $hoursLastMonth,
            'hoursThisWeek'  => $hoursThisWeek,
            'hoursLastWeek'  => $hoursLastWeek,
            'totalHours'     => $totalHours,
            'avgHours'       => $avgHours,
        ]);
    }

    public function view(Project $project)
    {
        if (auth()->id() !== $project->user_id) {
            abort(404);
        }

        $hoursThisMonth = "0";
        $hoursLastMonth = "0";
        $hoursThisWeek  = "0";
        $totalHours     = "0";
        $avgHours       = "0";
        $hoursLastWeek  = "0";

        if ($project->times()->first()) {
            $hoursThisMonth = $project->hoursBetween(
                now()->startOfMonth(),
                now()->endOfMonth()
            );
            $hoursLastMonth = $project->hoursBetween(
                Carbon::parse(now()->startOfMonth())->subMonth()->startOfMonth(),
                Carbon::parse(now()->startOfMonth())->subMonth()->endOfMonth()
            );
            $hoursThisWeek  = $project->hoursBetween(
                now()->startOfWeek(),
                now()->endOfWeek()
            );
            $hoursLastWeek  = $project->hoursBetween(
                now()->subWeek()->startOfWeek(),
                now()->subWeek()->endOfWeek()
            );
            $totalHours     = $project->totalHours();
            $avgHours       = $project->avgHours();

        }

        return view('project.view', [
            'project'        => $project,
            'times'          => $project->times()->orderBy('date', 'desc')->paginate(30),
            'hoursThisMonth' => $hoursThisMonth,
            'hoursLastMonth' => $hoursLastMonth,
            'hoursThisWeek'  => $hoursThisWeek,
            'hoursLastWeek'  => $hoursLastWeek,
            'totalHours'     => $totalHours,
            'avgHours'       => $avgHours,
        ]);
    }

    public function create()
    {
        $project          = new Project;
        $project->uid     = str_random();
        $project->title   = request('title');
        $project->user_id = auth()->id();
        $project->save();

        return redirect()->route('home')
            ->with('success', 'Successfully created project.');
    }
}
