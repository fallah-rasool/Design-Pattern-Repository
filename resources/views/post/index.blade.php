@extends('layout.main')

@section('content')
<h1 class="p-3 ">show all  post  Page </h1> 
<hr>

<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">body</th>
        <th scope="col">show</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
@foreach ($posts as $post)

<tr>
    <th scope="row">  {{ $post->id }}</th>
    <td>{{ mb_substr($post->title, 0, 10) }}...</td>
    <td>{{ mb_substr($post->body, 0, 20) }}...</td>   
    <td>   
        <a href="{{ route('posts.show',$post->id) }}"
        class="btn btn-success px-4 py2 mt-2"
        >show</a></td>   
    <td>
        <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info px-4 py2 mt-2">Edit</a>
        <br>
        <form action="{{ route('posts.destroy',$post->id) }}" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger px-3 py2 mt-2" type="submit">Delete</button>
        </form>
       
    </td>
  </tr>

    {{-- <div class="card m-2" style="width: 22rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">
              
                 {{ getFirstWords($post->title,)3 }}
            </h5>
        <p class="card-text">
            {{  getFirstWords($post->body,3) }}
        </p>            
        </div>
    </div> --}}
    
@endforeach

@endsection