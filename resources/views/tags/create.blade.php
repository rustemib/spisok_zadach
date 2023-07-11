@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создать новый тег</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tags.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <button type="submit" class="btn btn-primary">Создать тег</button>
                            <a href="{{route('tags.index')}}" class="btn btn-success">Отмена</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
