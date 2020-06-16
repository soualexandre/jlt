@extends('layouts.navbar')

@section('content')
<div class="container">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="row form-search">
        <form action="/search">
            <div class="col-md-10">
                <input type="search" name="search" class="form-control" placeholder="procurar">
            </div>
            <div class="col-md-2">
                {!! Form::submit('Pesquisar', ['class' => 'btn btn-block btn-default']) !!}
            </div>
        </form>
    </div>


    <div class="row">

        <div class="col-md-12">
            @forelse ($posts as $post)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $post->title }} - <small>by {{ $post->user->name }}</small>

                    <span class="pull-right">
                        {{ $post->created_at->toDayDateTimeString() }}
                    </span>
                </div>

                <div class="panel-body">
                    <img align="left" height="100" width="100" src="{{asset($post->imagem)}} " alt="">
                    <span class="text-rigth">
                    <p> <b> Titlulo: </b>{{ str_limit($post->title, 200) }}</p>
                        <p><b> Descrição do erro: </b>{{ str_limit($post->body, 200) }}</p>
                        <p><b> Solução:  </b>{{ str_limit($post->solution, 200) }}</p>
                        <p>
                           <b> Tags:</b>
                            @forelse ($post->tags as $tag)
                            <span class="label label-default">{{ $tag->name }}</span>
                            @empty
                            <span class="label label-danger">Nenhuma tag encontrada.</span>
                            @endforelse
                        </p>
                    </span>
                    <div class="text-rigth">
                        <p>
                            <span class="btn btn-sm btn-success">{{ $post->category->name }}</span>
                            <span class="btn btn-sm btn-info">Comments <span class="badge">{{ $post->comments_count }}</span></span>

                            <a href="{{ url("/posts/{$post->id}") }}" class="btn btn-sm btn-primary">Ver mais</a>
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="panel panel-default">
                <div class="panel-heading">Não encontrado!!</div>

                <div class="panel-body">
                    <p>Nenhum laudo técnico foi encontrado</p>
                </div>
            </div>
            @endforelse

            <div align="center">
                {!! $posts->appends(['search' => request()->get('search')])->links() !!}
            </div>

        </div>

        </dev>
        </dev>
        @endsection