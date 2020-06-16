<div class="container">
<div class="form-group{{ $errors->has('imagem') ? ' has-error' : '' }}">
    {!! Form::label('imagem', 'imagem', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
    
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagem" required>

    </div>
</div>


<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', 'Titulo', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::text('title', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>



<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('body', 'Descrição do erro', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('body') }}</strong>
        </span>
    </div>
</div>
<div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
    {!! Form::label('solution', 'Solução', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('solution', null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('solution') }}</strong>
        </span>
    </div>
</div>


<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('category_id', 'Categoria', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('category_id') }}</strong>
        </span>
    </div>
</div>

@php
    if(isset($post)) {
        $tag = $post->tags->pluck('name')->all();
    } else {
        $tag = null;
    }
@endphp

<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    {!! Form::label('tags', 'Tag', ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('tags[]', $tags, $tag, ['class' => 'form-control select2-tags', 'required', 'multiple']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    </div>
</div>
