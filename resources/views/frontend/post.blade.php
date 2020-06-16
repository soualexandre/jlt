@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <br><br>
                    <div class="panel-heading">
                        {{ $post->title }} - <small>by {{ $post->user->name }}</small>

                        <span class="pull-right">
        <a href="{{ url('admin/posts') }}" class="btn btn-default btn-success btnpull-right">Voltar</a>

                        </span>
                    </div>

                    <div class="panel-body">
                    <img height="400" width="600" src="{{asset($post->imagem)}}" alt="">
                 
                        <p style="margin-top: 15px;"> <b>Descrição do erro: </b> {{ $post->body }}</p>
                        <p> <b>Solução encontrada: </b> {{ $post->solution }}</p>
                        <p>
                            Categoria: <span class="label label-success">{{ $post->category->name }}</span> <br>
                            Tags:
                            @forelse ($post->tags as $tag)
                                <span class="label label-default">{{ $tag->name }}</span>
                            @empty
                                <span class="label label-danger">No tag found.</span>
                            @endforelse <br>
                            Data: <span> {{ $post->created_at->toDayDateTimeString() }}</span>
                        </p>
                    </div>
                </div>

                @includeWhen(Auth::user(), 'frontend._form')

                @include('frontend._comments')

            </div>

        </dev>
    </dev>
@endsection
