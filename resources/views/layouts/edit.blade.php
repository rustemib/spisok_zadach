@extends('layouts.app')

@section('content')
    <div class="container p-3">
    <h1>Редактировать задачу</h1>
    <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="form-group">
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
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a class="btn btn-danger" href="{{route('tasks.index')}}">Отмена</a>
    </form>
    </div>
@endsection
