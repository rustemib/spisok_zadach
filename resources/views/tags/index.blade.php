@extends('layouts.app')

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tags</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('tags.create') }}" class="btn btn-primary">Созадть тег</a>
                        <a href="{{ route('tasks.index') }}" class="btn btn-success">Список задач</a>

                        <hr>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Имя</th>
                                <th>Опции</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td> <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-success">Редактировать</a>
                                        <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-sm btn-info">Посмотреть</a>
                                        <form method="POST" action="{{ route('tags.destroy', $tag->id) }}" id="destroy">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
