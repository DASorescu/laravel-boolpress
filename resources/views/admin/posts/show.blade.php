@extends('layouts.app')
@section('content')
<div class="container ">
    <header><h1>{{$post->title}}</h1></header>
    <div class="clearfix ">
        @if($post->image)
        <img class="float-left mr-3" src="{{$post->image}}" alt="{{$post->slug}}">
        @endif
        <p>{{$post->content}}</p>
        <div class="mb-2">
            <h5>Tags</h5>
            <div>
                @forelse($post->tags as $tag)
                <span class="badge badge-pill mx-2" style="background-color:{{$tag->color}}">{{$tag->label}}</span>
                @empty
                    Nessun tag 
                @endforelse

            </div>
        </div>
        <time class="mx-2"> <strong>Creato il:</strong>{{$post->created_at}}</time>
        <time class="mx-2"> <strong>Ultima modifica:</strong>{{$post->updated_at}}</time>
    </div>

    <hr>
    <footer class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{route('admin.posts.index')}}" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i>Indietro</i></a>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{route('admin.posts.edit',$post)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i>Modifica</i></a>
            <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-2"><i class="fa-solid fa-trash"></i>Elimina</i></button>
            </form>
        </div>
    </footer>
@endsection


