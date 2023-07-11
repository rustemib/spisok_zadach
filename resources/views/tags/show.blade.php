@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tag Details</div>

                    <div class="card-body">
                        <h5>Name: {{ $tag->name }}</h5>

                        <h5>Tasks with this tag:</h5>
                        <ul>
                            @foreach($tag->tasks as $task)
                                <li>
                                    <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary">Edit Tag</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
