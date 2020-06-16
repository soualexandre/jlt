@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">

                    <h2>
                        {{ $post->title }} <small>por {{ $post->user->name }}</small>

                        <a href="{{ url('admin/posts') }}" class="btn btn-success btn-default pull-right">Voltar</a>
                    </h2>
                </div>

                <div class="panel-body">
                    <img height="400" width="600" src="{{asset($post->imagem)}}" alt="">
                    <div class="mb-4" style="margin-top: 10px;">


                        <p><b>Descrição do erro: </b>{{ $post->body }}</p>
                        <p><b>Solução encontrada: </b>{{ $post->solution }}</p>
                        <p><strong>Categoria: </strong>{{ $post->category->name }}</p>
                        <p><strong>Tags: </strong>{{ $post->tags->implode('name', ', ') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection