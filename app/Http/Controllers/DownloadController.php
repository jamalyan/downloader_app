<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DownloadHelper;
use App\Http\Requests\StoreUrlRequest;
use App\Models\Download;
use Illuminate\Http\RedirectResponse;

class DownloadController extends Controller
{
    use  DownloadHelper;

    public function index()
    {
        /** @var Download $downloads */
        $downloads = Download::with('job')->orderBy('created_at', 'desc')->get();

        return view('download', compact('downloads'));
    }

    /**
     * @param StoreUrlRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUrlRequest $request)
    {
        $this->createDownloadJob($request->get('url'));
        sleep(1);
        return redirect()->back()->with('success', 'Download successfully queued');
    }

}
