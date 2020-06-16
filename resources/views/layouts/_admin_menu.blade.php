<ul class="nav navbar-nav">
    <li><a href="{{ url('admin/posts') }}">Criar LT</a></li>
    <li><a href="{{ url('admin/categories') }}">Categorias</a></li>
    <li><a href="{{ url('admin/comments') }}">Commentários</a></li>
    <li><a href="{{ url('admin/tags') }}">Tags</a></li>

    @if (Auth::user()->is_admin)
        <li><a href="{{ url('admin/users') }}">Usuários</a></li>
    @endif
</ul>
