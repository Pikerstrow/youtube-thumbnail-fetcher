<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PagesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexPage()
    {
        try {
            $page = Page::with('translations')->where('slug', '=', 'index')->firstOrFail();

            if(view()->exists('pages.index')){
                return view('pages.index', compact('page'));
            } else {
                abort(404);
            }
        } catch (\Throwable $exception) {
            abort(500);
        }
    }

    public function videoDownloaderPage()
    {
        try {
            $page = Page::with('translations')->where('slug', '=', 'video-downloader')->firstOrFail();

            if(view()->exists('pages.video')){
                return view('pages.video', compact('page'));
            } else {
                abort(404);
            }
        } catch (\Throwable $exception) {
            abort(500);
        }
    }
}
