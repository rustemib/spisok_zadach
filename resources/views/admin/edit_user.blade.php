@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Редактировать пользователя {{$user->name}}</h1>

    <form method="POST" action="{{ route('admin.updateUser', $user->id) }}">
            @csrf
            @method('patch')

                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{$user->name}}">

                <label for="email">Mail</label>
                <input type="text" id="email" name="email" value="{{$user->email}}">

                <label for="password">password</label>
                <input type="text" id="password" name="password">

                <label for="is_admin">Admin</label>
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                <button class="btn btn-info" type="submit">Редактировать</button>
        </form>
        <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Удалить пользователя</button>
        </form>
        <a class="btn btn-success" href="{{route('admin.users')}}">Назад</a>
    </div>
@endsection
