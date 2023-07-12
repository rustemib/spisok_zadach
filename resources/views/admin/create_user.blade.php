@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Создать пользователя</h1>

    <form method="POST" action="{{ route('admin.storeUser') }}">
        @csrf
        @method('post')
            <label for="name">Name</label>
            <input type="text" id="name" name="name">

            <label for="email">Mail</label>
            <input type="text" id="email" name="email">
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror

            <label for="password">password</label>
            <input type="text" id="password" name="password">


            <label for="is_admin">Admin</label>
            <input type="checkbox" id="is_admin" name="is_admin">

        <button class="btn btn-success" type="submit">Создать</button>
    </form>
    </div>
@endsection
