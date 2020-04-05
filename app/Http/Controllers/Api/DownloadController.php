<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUrlRequest;
use App\Jobs\DownloaderJob;
use App\Models\Download;
use Illuminate\Http\JsonResponse;

class DownloadController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        /** @var Download $downloads */
        $downloads = Download::with('job')->get();

        return response()->json(['message' => 'success', 'downloads' => $downloads], 200);
    }

    /**
     * @param StoreUrlRequest $request
     * @return JsonResponse
     */
    public function store(StoreUrlRequest $request)
    {
        $this->dispatch(new DownloaderJob($request->get('url')));
        return response()->json(['message' => 'success'], 200);
    }
}
