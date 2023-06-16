@csrf
<label for="title">Titulo</label>
<input type="text"  class="form-control" name="title" value="{{ old("title", $post->title) }}">
<br>
<label for="description">Descripción</label>
<br>
<textarea name="description" class="form-control" placeholder="escribe algo">{{ old("description", $post->description) }}</textarea>
<br>
<label for="slug">Slug</label>
<input type="text" class="form-control" name="slug" value="{{ old("slug", $post->slug)}}">
<br>
<label for="content">Contenido</label>
<br>
<textarea name="content" class="form-control" placeholder="contenido">{{ old("content",$post->content)}}</textarea>
<br>
<label for="category_id">Categoria</label>
<br>
<select class="form-control" name="category_id" id="">
    <option value=""></option>
    @foreach ($categories as $title=>$id)
        <option {{ old("category_id", "$post->category_id") == $id ? "selected" : ""}} value="{{ $id }}">{{ $title }}</option>
    @endforeach
</select>
<br>
<label for="posted">Posted</label>
<select name="posted" id="" class="form-control">
    <option value="">Escoja</option>
    <option {{ old("posted", $post->posted) == "yes" ? "selected" : ""}} value="yes">Yes</option>
    <option {{ old("posted", $post->posted) == "not" ? "selected" : ""}} value="not">Not</option>
</select>
<br>
@if (isset($task) && $task == "edit")
    <label for="image">Imagen</label>
    <input type="file" name="image">
@endif
<br>
<button type="submit" class="btn btn-success mt-2">Enviar</button>
