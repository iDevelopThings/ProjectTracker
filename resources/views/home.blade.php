@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <form action="{{route('project.create')}}" method="post">
                        @csrf
                        <div class="card-header">Create Project</div>

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">
                                Create Project
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card mt-4">
                    <form action="{{route('project.create')}}" method="post">
                        @csrf
                        <div class="card-header">Projects</div>

                        @if($projects->first())
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Public URL</th>
                                    <th scope="col">Created</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($projects as $project)
                                    <tr>
                                        <th scope="row">{{$project->id}}</th>
                                        <td>
                                            <a href="{{route('project.view', $project)}}">{{$project->title}}</a>
                                        </td>
                                        <td><a href="{{$project->publicUrl()}}">{{$project->uid}}</a></td>
                                        <td>{{$project->created_at->diffForHumans()}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else

                            <div class="card-body text-center">
                                <h4 class="text-muted">No projects created.</h4>
                            </div>

                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
