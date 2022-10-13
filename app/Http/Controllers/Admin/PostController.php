<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $posts)
    {
        $post = new Post();
        $tags = Tag::select('id','label')->get();
        $categories = Category::select('id','label')->get();

        return view('admin.posts.create',compact('post','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'title'=>'required|string|min:3|max:50|unique:posts',
            'content'=>'required|string',
            'image'=>'nullable|url',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
        ],[
            'title.required'=> 'Il titolo e obbligatorio',
            'content.required'=>'Il post deve avere contenuto non vuoto',
            'title.min'=>'Il titolo deve avere un numero minimo di 3 caratteri',
            'title.max'=>'Il titolo deve avere un numero massimo di 50 caratteri',
            'title.unique'=>"Esiste gia' un post con il titolo $request->title ",
            'image.url'=>'Inserisci un url valido',
            'category_id.exists'=>'Non esiste una categoria associabile al post',
            'tags.exists'=>'Uno o piu tag indicati non e valido',
        ]);

        $data=$request->all();

        $post = new Post;

        $post->fill($data);
        $post->slug = Str::slug($post->title,'-');

        $post->save();
        if(array_key_exists('tags',$data)){
            
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show',$post)
        ->with('message','Post creato con successo')
        ->with('type','success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::select('id','label')->get();
        $prev_tags = $post->tags->pluck('id')->toArray();
        $tags = Tag::select('id','label')->get();
        return view('admin.posts.edit',compact('post','categories','tags','prev_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>['required' , 'string' , 'min:3' , 'max:50', Rule::unique('posts')->ignore($post->id)],
            'content'=>'required|string',
            'image'=>'nullable|url',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
        ],[
            'title.required'=> "Il titolo e' obbligatorio",
            'content.required'=>'Il post deve avere contenuto non vuoto',
            'title.min'=>'Il titolo deve avere un numero minimo di 3 caratteri',
            'title.max'=>'Il titolo deve avere un numero massimo di 50 caratteri',
            'title.unique'=>"Esiste gia' un post con il titolo $request->title ",
            'image.url'=>'Inserisci un url valido',
            'category_id.exists'=>'Non esiste una categoria associabile al post',
            'tags.exists'=>'Uno o piu tag indicati non e valido',
        ]);

        $data=$request->all();

        $data['slug'] = Str::slug($request->title,'-');
        
        if(!array_key_exists('tags',$data)) $post->tags()->detach();
        else $post->tags()->sync($data['tags']);
            
      

        $post->update($data);



        return redirect()->route('admin.posts.show',$post)
        ->with('message','Post modificato con successo')
        ->with('type','info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // verifico se ci sono relazioni e le elimino (cio' che fa cascade ma si ripete per sicurezza )
        if(count($post->$tags)) $post->tags->detach();

        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('message','Post eliminato con successo')
            ->with('type','danger');
    }
}
