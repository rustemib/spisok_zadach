@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Создать задачу</h1>
    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
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
        <button type="submit" class="btn btn-primary">Создать</button>
        <a class="btn btn-danger" href="{{route('tasks.index')}}">Отмена</a>
    </form>
</div>
@endsection
