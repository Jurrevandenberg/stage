<?php

/**
 * Hierbij mijn Blogpost controller. Ik gebruik het framework Laravel voor dit project. Daarom zie je hier een resource controller.
 * In deze controller doet hij alles, van createn tot opslaan.
 * 
 */

namespace App\Http\Controllers;

use App\Blogpost;
use App\Category;
use App\Comments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Blogpost::class, 'blogpost');
    }

    public function index()
    {
        $posts = Blogpost::all();
        $category = Category::all();
        $user = User::all();

        return view('blog.index')->with('posts', $posts)->with('category', $category)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $user = User::all();
        return view('blog.create')->with('category', $category)->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|file'
        ]);
        $blogPost = New Blogpost;

        $blogPost->title = $request->title;
        $blogPost->summary = $request->summary;
        $blogPost->text = $request->text;
        $blogPost->category_id = $request->category;
        $blogPost->user_id = Auth::user()->id;

        $request->image->store('images', 'public');
        $path = $request->image->store('images', 'public');
        $blogPost->image_path = $path;


        $blogPost->save();

        return redirect('/blogpost');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Blogpost $blogpost
     * @return \Illuminate\Http\Response
     */
    public function show(Blogpost $blogpost)
    {
        $category = Category::all();
        $user = User::all();
        $comment = Comments::all();
        return view('blog.show')->with('blogpost', $blogpost)->with('category', $category)->with('user', $user)->with('comment', $comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Blogpost $blogpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogpost $blogpost)
    {
        return view('blog.edit')->with('blogpost', $blogpost);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Blogpost $blogpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogpost $blogpost)
    {
        $editBlog = $blogpost;
        $editBlog->title = $request->title;
        $editBlog->summary = $request->summary;
        $editBlog->text = $request->text;

        $editBlog->save();

        return redirect('/blogpost/' . $blogpost->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Blogpost $blogpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogpost $blogpost)
    {
        $deleteBlog = Blogpost::all()->find($blogpost->id);
        $deleteBlog->delete();

        return redirect('/blogpost');
    }
}

