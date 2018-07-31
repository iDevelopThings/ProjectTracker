<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function publicUrl()
    {
        return route('public-project-view', $this->uid);
    }

    public function times()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function hoursBetween($start = null, $end = null)
    {
        if ($start === null) {
            $start = now()->startOfMonth();
        }
        if ($end === null) {
            $end = now()->endOfMonth();
        }
        $seconds = $this->times()
            ->whereDate('date', '>=', $start)
            ->whereDate('date', '<=', $end)
            ->sum('length_in_seconds');

        $t = round($seconds);

        return sprintf('%02d Hours %02d Minutes', ($t / 3600), ($t / 60 % 60));
    }

    public function totalHours()
    {
        $seconds = $this->times()->sum('length_in_seconds');

        $t = round($seconds);

        return sprintf('%02d Hours %02d Minutes', ($t / 3600), ($t / 60 % 60));
    }

    public function avgHours()
    {
        $seconds = $this->times()->avg('length_in_seconds');

        $t = round($seconds);

        return sprintf('%02d Hours %02d Minutes', ($t / 3600), ($t / 60 % 60));
    }

}
