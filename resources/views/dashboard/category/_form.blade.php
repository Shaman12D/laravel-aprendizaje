@csrf
<label for="title">Titulo</label>
<input type="text" class="form-control" name="title" value="{{ old("title", $category->title) }}">
<br>
<label for="slug">Slug</label>
<input type="text" class="form-control" name="slug" value="{{ old("slug", $category->slug)}}">
<br>
<button class="btn btn-success mt-2" type="submit">Enviar</button>
