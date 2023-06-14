@csrf
<label for="title">Titulo</label>
<input type="text" name="title"  value="{{ old("title", $post->title) }}">
<br>
<label for="description">Descripción</label>
<br>
<textarea name="description" placeholder="escribe algo">{{ old("description", $post->description) }}</textarea>
<br>
<label for="slug">Slug</label>
<input type="text" name="slug" value="{{ old("slug", $post->slug)}}">
<br>
<label for="content">Contenido</label>
<br>
<textarea name="content" placeholder="contenido">{{ old("content",$post->content)}}</textarea>
<br>
<label for="category_id">Categoria</label>
<br>
<select name="category_id" id="">
    <option value=""></option>
    @foreach ($categories as $title=>$id)
        <option {{ old("category_id", "$post->category_id") == $id ? "selected" : ""}} value="{{ $id }}">{{ $title }}</option>
    @endforeach
</select>

<label for="posted">Posted</label>
<select name="posted" id="">
    <option value="">Escoja</option>
    <option {{ old("posted", $post->posted) == "yes" ? "selected" : ""}} value="yes">Yes</option>
    <option {{ old("posted", $post->posted) == "not" ? "selected" : ""}} value="not">Not</option>
</select>
<br>
@if (isset($task) && $task == "edit")
    <label for="image">Imagen</label>
    <input type="file" name="image">
@else
    
@endif
<br>
<button type="submit">Enviar</button>