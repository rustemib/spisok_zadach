@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Лист задач</h1>
    <div class="container p-3">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Создать задачу</a>
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Создать тег</a>
        <a href="{{ route('tags.index') }}" class="btn btn-primary"> теги</a>
    </div>
    <div class="container p-3 d-flex">
        <form action="{{ route('tasks.index') }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}">
            <button class="btn btn-info" type="submit">Поиск</button>

        </form>

        <form action="{{ route('tasks.index') }}" method="get">
            <select class="form-select" name="tag_ids[]" aria-label="Default select example">
                <option selected>Выберите тег</option>
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

        <button class="btn btn-info" type="submit">Фильтровать</button>
        </form>
        <a href="{{ route('tasks.index') }}" class="btn btn-danger">Сбросить</a>
    </div>
    <div class="container mt-3">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th>user_id</th>
                <th>пользователь</th>
                <th>Тайтл задачи</th>
                <th>картинка</th>
                <th>теги</th>
                <th>опции</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->user_id}}</td>
                <td>{{$task->user->name}}</td>
                <td><h2>{{$task->title}}</h2></td>
                <td><img src="/images/{{ $task->image_path }}" alt="Task image" style="width: 150px; height: 150px"></td>

                <td>
                    <ul>
                        @foreach($task->tags as $tag)
                            <li>{{$tag->name}}</li>
                        @endforeach
                    </ul>
                </td>

                <td><ul>
                        <li><a class="btn btn-info" href="{{ route('tasks.show', $task) }}">Посмотреть</a></li>
                        <br>
                        @if (Auth::id() === $task->user_id)
                            <li> <a class="btn btn-success" href="{{ route('tasks.edit', $task) }}">Редактировать</a></li>
                            <br>
                               <li> <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Удалить</button>
                                </form></li>
                        @endif
                    </ul></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
