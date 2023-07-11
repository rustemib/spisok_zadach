@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <h1>{{ $task->title }}</h1>
        <p>{{ $task->description }}</p>

        @if ($task->image_path)
            <img src="/images/{{ $task->image_path }}" alt="Task image" style="width: 150px; height: 150px">
            <h2 class="">Тык <a href="/images/{{ $task->image_path }}" target="_blank">сюда</a> чтобы увеличить картинку.</h2>
        @endif

        @if ($task->tags->count() > 0)
            <h3>Tags:</h3>
            <ul>
                @foreach ($task->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endif

        <a class="btn btn-info" href="{{ route('tasks.index') }}">к списку задач</a>
    </div>
@endsection
