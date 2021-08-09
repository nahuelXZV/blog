<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.posts.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //solo toma el name de las categorias, la llave sera el id
        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();
        return view("admin.posts.create", compact('categories'), compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     * al indicar que pertenece a la clase storepostrequest verifica las validaciones de la clase
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url' => $url
            ]);
        }
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        return redirect()->route("admin.posts.store", $post)->with('info', 'El post se creo con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->Authorize('author',$post);

        $categories = Category::pluck('name', 'id');

        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->Authorize('author',$post);
        $post->update($request->all());
        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));
            if ($post->image) {
                Storage::delete($post->image->url);
                $post->image->update([
                    'url' => $url
                ]);
            } else {
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }
        if ($request->tags) {
            //sync sincroniza
            $post->tags()->sync($request->tags);
        }
        return redirect()->route("admin.posts.update", $post)->with('info', 'El post se actualizo con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->Authorize('author',$post);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'El post se elimino con exito');
    }
}
