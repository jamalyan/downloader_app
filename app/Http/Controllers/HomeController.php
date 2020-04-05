<?php

namespace App\Http\Controllers;

use App\Jobs\DownloaderJob;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('url')) $this->dispatch(new DownloaderJob($request->get('url')));

        return view('welcome');
    }
}
