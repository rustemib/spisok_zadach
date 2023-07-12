@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Задачи</h1>
        <a class="btn btn-danger" href="{{route('tasks.create')}}">Создать</a>
        <a class="btn btn-info" href="{{route('admin.index')}}">Назад</a>
    <ul>
        @foreach($tasks as $task)
            <li class="p-2">
                {{$task->title}} - {{$task->user->name}} <img src="/images{{$task->image_path}}" alt="" style="width: 40px; height: 40px">
                <a class="btn btn-info" href="{{ route('admin.editTask', $task->id) }}">Редактировать</a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
