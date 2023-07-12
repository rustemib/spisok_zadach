@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Админка</h1>

        <h2><a href="{{route('admin.users')}}">Пользователи</a></h2>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>

        <h2><a href="{{route('admin.tasks')}}">Задачи</a></h2>
        <ul>
            @foreach($tasks as $task)
                <li>{{ $task->title }}</li>
            @endforeach
        </ul>

        <h2><a href="{{route('admin.tags')}}">Теги</a></h2>
        <ul>
            @foreach($tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>

    </div>
@endsection
