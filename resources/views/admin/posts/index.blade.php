@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Laudos técnicos
                            <a href="{{ url('admin/posts/create') }}" class="btn btn-success btn-default pull-right">Nova LT</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Titulo</th>
                                    <th>Descrção</th>
                                    <th>Autor</th>
                                    <th>solução</th>
                                    <th>Categoria</th>
                                    <th>Tags</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td><img height="100" width="100" src="{{asset($post->imagem)}}" alt=""></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ str_limit($post->body, 60) }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->solution }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->tags->implode('name', ', ') }}</td>
                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($post->published == 'Yes') {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                            @endif
                                            <a href="{{ url("/admin/posts/{$post->id}") }}" class="btn btn-xs btn-success">Ver</a>
                                            <a href="{{ url("/admin/posts/{$post->id}/edit") }}" class="btn btn-xs btn-info">Editar</a>
                                            <a href="{{ url("/admin/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="Quer mesmo deletar essa postagem?" class="btn btn-xs btn-danger">Deletar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Não encontrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $posts->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
