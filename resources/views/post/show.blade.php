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
<a class="py-3 px-5" href="{{ route('posts.index') }}"> صفحه قبلی</a>

@endsection