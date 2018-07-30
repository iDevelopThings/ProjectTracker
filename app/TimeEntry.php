<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    public function timeFormatted()
    {
        $t      = round($this->length_in_seconds);
        $string = sprintf('%02d Hours %02d Minutes', ($t / 3600), ($t / 60 % 60));

        return $string;
    }
}
