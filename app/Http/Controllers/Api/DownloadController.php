<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Requests\Api\StoreUrlRequest;
use App\Models\Download;
use Illuminate\Http\JsonResponse;

class DownloadController extends Controller
{
    use  DownloadHelper;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        /** @var Download $downloads */
        $downloads = Download::with('job')->orderBy('created_at', 'desc')->get();

        return response()->json(['message' => 'success', 'downloads' => $downloads], 200);
    }

    /**
     * @param StoreUrlRequest $request
     * @return JsonResponse
     */
    public function store(StoreUrlRequest $request)
    {
        $this->createDownloadJob($request->get('url'));
        return response()->json(['message' => 'Download successfully queued'], 200);
    }
}
