@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактор тегов</h1>
        <a class="btn btn-success" href="{{route('admin.tags')}}">Назад</a>
        <form action="{{ route('admin.tags.update', $tag->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $tag->name }}">
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
