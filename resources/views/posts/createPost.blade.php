@extends('layouts.layout')

@section('content')
    <h1>Написати статтю</h1>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    {!! Form::model($post, ['method' => 'POST', 'action' => ['PostsController@store', $post->id],
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
        {!! Form::text('theme_id', null,
            array('class'=>'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Картинка') !!}
        {!!  Form::file('image', NULL,
            array('required',
            'class' => 'field'
            )) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Стаття') !!}
        {!! Form::textarea('body', $post->body,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Повний текст статті')) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Зберегти',
          array('class'=>'btn btn-primary')) !!}
    </div>
    {{ csrf_field() }}
    {!! Form::close() !!}


@endsection