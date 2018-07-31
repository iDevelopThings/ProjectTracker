@extends('layouts.app-basic')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                <h1 class="mb-3">
                    {{$project->title}}
                </h1>
                <hr>

                @if($times->first())

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$hoursThisMonth}}</h4>
                                    <h6 class="mb-0 text-muted">This Month</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$hoursLastMonth}}</h4>
                                    <h6 class="mb-0 text-muted">Last Month</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$hoursThisWeek}}</h4>
                                    <h6 class="mb-0 text-muted">This Week</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$avgHours}}</h4>
                                    <h6 class="mb-0 text-muted">Avg Hours Per Day</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$totalHours}}</h4>
                                    <h6 class="mb-0 text-muted">Total</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <h3 class="mb-3">
                    Time Entries
                </h3>
                <hr>

                @if($times->first())
                    @foreach($times as $time)

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2 border-right">
                                        <h4 class="mb-0">
                                            {{$time->date}}
                                        </h4>
                                        <small>Date</small>
                                        <h6 class="mt-3 mb-0">
                                            {{$time->timeFormatted()}}
                                        </h6>
                                        <small>Length Worked</small>
                                    </div>
                                    <div class="col-md-10">
                                        <h5>Notes:</h5>
                                        <hr>

                                        @php
                                            $lines = explode(PHP_EOL, $time->content);
                                        @endphp

                                        @if(count($lines) > 1)
                                            <ul class="time-list">
                                                @foreach($lines as $line)
                                                    <li>{{$line}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>{{$time->content}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else

                    <div class="card card-body text-center">
                        <h4 class="text-muted">No times created.</h4>
                    </div>

                @endif
            </div>
        </div>

    </div>
@endsection
