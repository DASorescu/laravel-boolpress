@extends('layouts.app')
@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center">
      <h1>Lista Post</h1>
      <a href="{{route('admin.posts.create')}}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Nuovo Post</a>
    </header>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">TITOLO</th>
            <th scope="col">TAGS</th>
            <th scope="col">SLUG</th>
            <th scope="col">CREATO IL:</th>
            <th scope="col">MODIFICATO IL:</th>
            <th colspan="6">
                ATTIVITA'
            </th>
          </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>
              @forelse($post->tags as $tag)
              <span class="badge badge-pill mx-2" style="background-color:{{$tag->color}}">{{$tag->label}}</span>
              @empty
                  Nessun tag 
              @endforelse
            </td>
            <td>{{$post->slug}}</td>
            <td>{{$post->created_at}}</td>
            <td>{{$post->updated_at}}</td>
            <td><a href="{{route('admin.posts.show', $post)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a></td>
            <td><a href="{{route('admin.posts.edit',$post)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a></td>
                
            <td>            
              <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6">
                <h2 class="text-center">Nessun Post da mostrare</h2>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
</div>

@endsection