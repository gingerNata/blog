@extends('layouts.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="text-center">{{ $user->name }}</h1>
                <hr>
                <div class="col-md-4">
                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar image">

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['Profiles\UserController@updateAvatar'],
                     'enctype' => "multipart/form-data"]) !!}

                    <div class="form-group">
                        {{--                        {!! Form::label('Змінити аватар') !!}--}}
                        {!!  Form::file('avatar', NULL,
                            array('class' => 'pull-right btn btn-sm btn-primary'
                            )) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Змінити',
                          array('class'=>'btn btn-primary')) !!}
                    </div>
                    {{ csrf_field() }}
                    {!! Form::close() !!}

                </div>

                <div class="col-md-4">
                    <div class="e-mail"><b>E-mail:</b> {{ $user->email }}</div>
                    <div class="e-mail"><b>Про себе:</b> {{ $user->about }}</div>
                    <br>
                    <a class="btn btn-primary" href="{{ route('editProfile') }}"> Редагувати профіль</a>

                </div>
                <div class="col-md-3">
                    {!! Form::model(Auth::user(), ['method' => 'POST', 'action' => ['Profiles\UserController@delete']]) !!}

                    <div class="form-group">
                        {!! Form::submit('Видалити профіль',
                          array('class'=>'btn btn-danger')) !!}
                    </div>

                    {{ csrf_field() }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <h1 class="text-center">Статті автора</h1>
                <hr>
                <div class="row">
                    @foreach($user->posts as $post)
                        <aricle>
                            <div class="col-md-3">
                                {{--<p class="author">{{ $post->author }}</p>--}}
                                <a href="{{ route('post', ['id' => $post->id]) }}"><img class="img-fluid rounded" src="{{ asset('storage/images/medium/' . $post->image) }}" alt=""></a>
                                <a href="{{ route('post', ['id' => $post->id]) }}"><h3>{{ $post->title }}</h3></a>
                                <p><a href="{{ route('editPost', ['id' => $post->id]) }}" class="btn btn-default">Редагувати</a>
                                    <a href="{{ route('deletePost', ['id' => $post->id]) }}" class="btn btn-default">Видалити</a></p>
                            </div>
                        </aricle>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection