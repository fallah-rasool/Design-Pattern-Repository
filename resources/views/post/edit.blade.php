@extends('layout.main')

@section('content')
<h1 class="p-3 ">Page Edit Post : <strong> {{ $post->id }} </strong>   </h1> <hr>

@if (Session::has('success'))                    
<div class="alert alert-success">
        {{ Session::get('success') }}
</div>                    


@elseif(Session::has('error'))

<div class="alert alert-danger">
        {{ Session::get('error') }}
</div>

@endif

<div class="col-6 m-auto">
    <form action="{{ route('posts.update',$post->id) }}" method="post">
        @csrf
        @method('put')
            <div class="mb-3">
                <label for="title" class="form-label">title </label>
                <input type="text" 
                value="{{ $post->title }}"
                name="title" class="form-control" id="title" placeholder="">

                @error('title')
                <div class="text-danger mt-2">
                    {{ $message}}
                </div>
                    
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">body</label>
                <textarea class="form-control" name="body" id="body" rows="3">{{ $post->body }}</textarea>
                @error('body')
                <div class="text-danger mt-2r">
                    {{ $message}}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">status</label>
                <input class="form-check-input"
                {{ $post->status ?'checked':'' }}                
                name="status" type="checkbox" role="switch" id="status" checked>
                @error('status')
                <div class="text-danger mt-2">
                    {{ $message}}
                </div>
                @enderror
            </div>
            <div class="mb-3 d-flex justify-content-between">
                
                <a class="py-2 px-2 btn btn-secondary" href="{{ route('posts.index') }}"> صفحه قبلی</a>
                <button type="submit" class="btn btn-primary py-2 px-2"> send</button>

            </div>
            
    </form>
</div>

   
   

 @endsection