<div {{ $attributes->class(['my-5', 'bg-red-800'])->merge(['other-attr' => 'data1']) }}>
    {{-- <div {{ $attributes->merge(['class' => 'my-5 bg-red-800' , 'other-attr' => 'data1']) }}> --}}
    {{ $changeTitle() }}
    <h1>{{ $post->title }}</h1>
    <h1>{{ $post->created_at }}</h1>
    <h1>{{ $post->content }}</h1>
</div>
