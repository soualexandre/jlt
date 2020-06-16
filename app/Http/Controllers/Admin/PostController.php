<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags', 'comments'])->orderBy('id', 'DESC')->paginate(6);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $dados = $request->all();
        //dd($dados);    motrarar os valores que está pegando atraves do 'dados'

        //tratando a imagem
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');

            $num = rand(1111, 2222);   //gerando um numero randomico para servir como nome da imagem no banco de dados
            $dir = "img/postagem/";               //diretorio onde ira salvar a imagem
            $extensao = $imagem->guessClientExtension();  //extensao da imagem
            $nomeimagem = "imagem_" . $num . "." . $extensao;   //nome da imagem
            $imagem->move($dir, $nomeimagem);     //movendo imagem para um diretorio
            $dados['imagem'] = $dir . "/" . $nomeimagem;  //caminho da imagem para salvar no banco
        }
        Post::create($dados); //salvando tudo no banco de dados

        //redirecionando para a pagina 'Posts'

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = $post->load(['user', 'category', 'tags', 'comments']);
        return view('admin.posts.show', compact('post'));
    }

    public function lpostagens(Post $post)
    {
        $post = $post->load(['user', 'category', 'tags', 'comments']);

        return view('publico.views.partials.conteudo-noticia', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't edit other peoples post.");
            return redirect('/admin/posts');
        }

        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = Post::find($id);

        $dados->title = $request->input('title');
        $dados->body = $request->input('body');
        $dados->category_id = $request->input('category_id');

        
        //tratando a imagem
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');

            $num = rand(1111, 2222);   //gerando um numero randomico para servir como nome da imagem no banco de dados
            $extensao = $imagem->guessClientExtension();  //extensao da imagem
            $nomeimagem = "imagem_" . $num . "." . $extensao;   //nome da imagem
            $imagem->move('img/postagem', $nomeimagem);     //movendo imagem para um diretorio
            $dados->imagem = $nomeimagem;//caminho da imagem para salvar no banco
        }

        $dados->save();
        return redirect('/admin/posts')->with('dados', $dados);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("Você quer mesmo deletar essa postagem?");
            return redirect('/admin/posts');
        }

        $post->delete();
        flash()->overlay('A Postagem foi deletada com sucesso');

        return redirect('/admin/posts');
    }

    public function publish(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();
        flash()->overlay('Postagem publicada com sucesso.');

        return redirect('/admin/posts');
    }
}
