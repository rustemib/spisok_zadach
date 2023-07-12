@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Редактировать задачу {{$task->title}}</h1>
        <a class="btn btn-info" href="{{route('admin.tasks')}}">Назад</a>

    <form method="POST" action="{{ route('admin.updateTask', $task->id) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}">
        </div>

        <div class="form-group mt-3 mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group mt-3 mb-3">
            <label>Картинка</label>
            <input type="file" name="image">

        </div>
        <div class="form-group">
            <label for="tags">Теги</label>
            <select multiple class="form-control" id="tags" name="tags[]">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success mt-3" type="submit">Сохранить изменения</button>
    </form>
    </div>
@endsection
