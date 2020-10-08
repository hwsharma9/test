<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('get') && $request->search) {
            $tag = new Tag();
            $posts = $tag->latest()->where('name', $request->search)->with(['posts'])->paginate(6);
        } else {
            $posts = Post::latest()->paginate(6);
        }
        return view('posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create-post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            // $request->request->add(['featured_image' => $this->uploadImage($request)]);
            $request->request->add([
                'user_id' => Auth::user()->id, 
                'slug' => strtotime(date("Y-m-d H:i:s")).Str::slug($request->title, '-')
            ]);
            $post = Post::create($request->all());
            $this->uploadImage($request, $post);
            
            $this->manageTags($request->tags, $post->id);

            return redirect()->route('posts')->withSuccessmsg('Post Created successfully!!');
        } else {
            return redirect()->route('posts')->withErrormsg('Your are not authenticate to Created a Post!!');
        }
    }

    public function uploadImage($request, $post, $delete=false)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);
                $name = $request->file('image')->getClientOriginalName();
                // $extension = $request->image->extension();
                // dd($validated, $name);
                $url = Storage::put('posts/'.$post->id, $request->file('image'));
                // $url = $request->file('image')->store('/posts/'.$post->id, $name, 'public');
                // $url = Storage::url($validated['image'].".".$extension);
                // $request->request->add(['featured_image' => $url]);
                if ($delete) {
                    $path = $post->featured_image;
                    if ($path) {
                        Storage::delete($path);
                    }
                }
                $post->featured_image = $url;
                $post->save();
                return $url;
            }
        } else {
            return false;
        }
    }

    public function manageTags($tags='', $post_id='')
    {
        if ($tags) {
            $tag = Tag::where('post_id', $post_id)->delete();
            foreach ($tags as $key => $value) {
                $tag = ['post_id' => $post_id, 'name' => $value];
                Tag::create($tag);
            }
        } else {
            $tag = Tag::where('post_id', $post_id)->delete();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug = '')
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = $post->tags()->get();
        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->can('update-post')) {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            $request->request->add([
                'slug' => strtotime(date("Y-m-d H:i:s")).Str::slug($request->title, '-')
            ]);
            $post->update($request->all());
            $this->uploadImage($request, $post, true);
            
            $this->manageTags($request->tags, $post->id);

            return redirect()->route('posts')->withSuccessmsg('Post Created successfully!!');
        } else {
            return redirect()->route('posts')->withErrormsg('Your are not authenticate to Update a Post!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts')->withSuccessmsg('Product deleted successfully!');
    }

    public function deletePostImage(Post $post)
    {
        if (!empty($post->featured_image)) {
            Storage::delete($post->featured_image);
            $post->featured_image = '';
            $post->save();
            return true;
        }
        return false;
    }
}
