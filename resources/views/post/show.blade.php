@extends('layout.main')

@section('content')
<h1 class="p-3 ">Sho post   </h1> <hr>

<div class="py-3 px-5">   
    <strong> title :</strong> {{ $post->title }} 
</div>
<hr>
<div class="py-3 px-5">  
    <strong>   body :</strong>
    {{   $post->body}}
</div>
<br>
<div class="mb-3 justify-content-between">
    <a class="py-2 px-2 btn btn-secondary" href="{{ route('posts.index') }}"> صفحه قبلی</a>
</div>
@endsection