@extends('layouts.layout')

@section('content')


    <h1>Редагувати {{ $post->title }}</h1>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    {!! Form::model($post, ['method' => 'PATCH', 'action' => ['PostsController@update', $post->id],
     'enctype' => "multipart/form-data"]) !!}


    <div class="form-group">
        {!! Form::label('Заголовок') !!}
        {!! Form::text('title', $post->title,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Заголовок статті')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Тема') !!}
        {!! Form::text('theme_id', $post->theme->title,
            array('class'=>'form-control')) !!}
    </div>

    <img class="img-fluid rounded" src="{{ asset('storage/images/medium/' . $post->image) }}" alt="">
    <div class="form-group">
        {!! Form::label('Картинка') !!}
        {!!  Form::file('image', NULL,
            array('class' => 'field'
            )) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Стаття') !!}
        {!! Form::textarea('body', $post->body,
            array(
                  'class'=>'form-control',
                  'placeholder'=>'Повний текст статті')) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Зберегти',
          array('class'=>'btn btn-primary')) !!}
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}


    {!! Form::model($post, ['method' => 'DELETE', 'action' => ['PostsController@delete', $post->id]]) !!}
    <div class="form-group pull-right">
        {!! Form::submit('Видалити',
          array('class'=>'btn btn-danger')) !!}
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}



@endsection