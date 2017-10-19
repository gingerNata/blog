@extends('layouts.layout')
@section('content')
<div class="container">
    <h2>Статті</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Опублікована</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $i => $post)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td><a href="{{ route('post', ['id' => $post->id]) }}">{{ $post->title }}</a></td>
            <td><a href="{{ route('authorPage', $post->user->id) }}">{{ $post->user->name }}</a></td>
            <td>{{ $post->public }}</td>
            <td>

                {!! Form::model($post, ['method' => 'PATCH', 'action' => ['HomeController@publicPost', $post->id],
                'enctype' => "multipart/form-data"]) !!}
                <div class="form-group">{!! Form::submit('Перепублікувати',array('class'=>'btn btn-primary')) !!}</div>
                {{ csrf_field() }}{!! Form::close() !!}
            </td>
            <td>
                <a href="{{ route('editPost', ['id' => $post->id]) }}" class="btn btn-default">Редагувати</a>
            </td>
            <td>
                <a href="{{ route('deletePost', ['id' => $post->id]) }}" class="btn btn-danger">Видалити</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection