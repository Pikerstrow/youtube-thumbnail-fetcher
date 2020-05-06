<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::with('translations')->paginate(8);
            $page = Page::with('translations')->where('slug', '=','posts')->firstOrFail();
            if(view()->exists('pages.posts')){
                return view('pages.posts', compact('page', 'posts'));
            } else {
                abort(404);
            }
        } catch (\Throwable $exception) {
            abort(500);
        }
    }


    public function show()
    {

    }
}
