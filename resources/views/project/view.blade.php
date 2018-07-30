@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="modal fade"
                     id="addTimeEntry"
                     tabindex="-1"
                     role="dialog"
                     aria-labelledby="addTimeEntryLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTimeEntryLabel">Add time entry</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('project.add-entry', $project)}}" method="post">
                                @csrf


                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="date"
                                               class="text-md-right">
                                            Date
                                        </label>

                                        <input id="date"
                                               type="date"
                                               class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                               name="date"
                                               value="{{ old('date') }}"
                                               required>

                                        @if ($errors->has('date'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_time"
                                                       class="text-md-right">
                                                    Start Time
                                                </label>

                                                <input id="start_time"
                                                       type="time"
                                                       class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}"
                                                       name="start_time"
                                                       value="{{ old('start_time') }}"
                                                       required>

                                                @if ($errors->has('start_time'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('start_time') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="finish_time"
                                                       class="text-md-right">
                                                    Finish Time
                                                </label>

                                                <input id="finish_time"
                                                       type="time"
                                                       class="form-control{{ $errors->has('finish_time') ? ' is-invalid' : '' }}"
                                                       name="finish_time"
                                                       value="{{ old('finish_time') }}"
                                                       required>

                                                @if ($errors->has('finish_time'))
                                                    <div class="invalid-feedback">
                                                        <strong>{{ $errors->first('finish_time') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="content"
                                               class="text-md-right">
                                            Content
                                        </label>

                                        <textarea id="content"
                                                  type="content"
                                                  class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                                  name="content"
                                                  required>
                                            {{ old('content') }}
                                        </textarea>

                                        @if ($errors->has('content'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="mb-0">
                            {{$project->title}} <strong>/</strong>
                            <small class="text-muted">{{$project->uid}}</small>

                        </h1>
                        <hr>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addTimeEntry">
                                    Add time entry
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($times->first())

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$hoursThisMonth}}</h4>
                                    <h6 class="mb-0 text-muted">This Month</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$hoursThisWeek}}</h4>
                                    <h6 class="mb-0 text-muted">This Week</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="mb-2">{{$totalHours}}</h4>
                                    <h6 class="mb-0 text-muted">Total</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif

                <div class="card">
                    <div class="card-header">Times</div>
                    @if($times->first())
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Notes</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($times as $time)
                                <tr>
                                    <td>
                                        <strong>{{$time->date}}</strong>
                                        @if($time->start_time !== null && $time->finish_time !== null)
                                            <br>
                                            <small class="text-muted">
                                                <strong>Start: </strong>{{$time->start_time}} -
                                                <strong>Finish: </strong>{{$time->finish_time}} <br>
                                                <strong>Total Length: </strong>{{$time->timeFormatted()}} <br>
                                            </small>
                                        @endif
                                        <hr>
                                        <button class="btn btn-primary btn-xs"
                                                data-toggle="modal"
                                                data-target="#editTime{{$time->id}}">
                                            Edit
                                        </button>


                                        <div class="modal fade"
                                             id="editTime{{$time->id}}"
                                             tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="editTime{{$time->id}}Label"
                                             aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTime{{$time->id}}Label">Edit
                                                                                                                time
                                                                                                                entry</h5>
                                                        <button type="button"
                                                                class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('project.edit-entry', [$project, $time])}}"
                                                          method="post">
                                                        @csrf


                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="date" class="text-md-right">
                                                                    Date
                                                                </label>

                                                                <input id="date"
                                                                       type="date"
                                                                       class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                                       name="date"
                                                                       value="{{ old('date') ?? $time->date }}"
                                                                       required>

                                                                @if ($errors->has('date'))
                                                                    <div class="invalid-feedback">
                                                                        <strong>{{ $errors->first('date') }}</strong>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="start_time"
                                                                               class="text-md-right">
                                                                            Start Time
                                                                        </label>

                                                                        <input id="start_time"
                                                                               type="time"
                                                                               class="form-control{{ $errors->has('start_time') ? ' is-invalid' : '' }}"
                                                                               name="start_time"
                                                                               value="{{ old('start_time') ?? $time->start_time }}"
                                                                               required>

                                                                        @if ($errors->has('start_time'))
                                                                            <div class="invalid-feedback">
                                                                                <strong>{{ $errors->first('start_time') }}</strong>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="finish_time"
                                                                               class="text-md-right">
                                                                            Finish Time
                                                                        </label>

                                                                        <input id="finish_time"
                                                                               type="time"
                                                                               class="form-control{{ $errors->has('finish_time') ? ' is-invalid' : '' }}"
                                                                               name="finish_time"
                                                                               value="{{ old('finish_time')  ?? $time->finish_time}}"
                                                                               required>

                                                                        @if ($errors->has('finish_time'))
                                                                            <div class="invalid-feedback">
                                                                                <strong>{{ $errors->first('finish_time') }}</strong>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="content"
                                                                       class="text-md-right">
                                                                    Content
                                                                </label>

                                                                <textarea id="content"
                                                                          type="content"
                                                                          class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                                                          name="content"
                                                                          required>{{ old('content') ?? $time->content }}</textarea>

                                                                @if ($errors->has('content'))
                                                                    <div class="invalid-feedback">
                                                                        <strong>{{ $errors->first('content') }}</strong>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Save changes
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <p>
                                            {!! nl2br($time->content) !!}
                                        </p>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else

                        <div class="card-body text-center">
                            <h4 class="text-muted">No times created.</h4>
                        </div>

                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
