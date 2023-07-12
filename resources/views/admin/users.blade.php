@extends('layouts.app')

@section('content')
    <div class="container p-3">
    <h1>Пользователи</h1>
        <a class="btn btn-success" href="{{route('admin.createUser')}}">Создать пользователя</a>
        <a class="btn btn-info" href="{{route('admin.index')}}">Назад</a>
    <ul>
        @foreach($users as $user)
            <li class="p-2">
                {{$user->name}} - {{$user->email}}
                @if($user->is_admin > 0)
                    <span class="text-danger"><b>Admin!</b></span>
                @endif
                <a class="btn btn-info" href="{{ route('admin.editUser', $user->id) }}">Редактировать</a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
