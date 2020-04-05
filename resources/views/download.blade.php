<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="content">
                        <div class="card">
                            <div class="card-header">
                                {{ config('app.name', 'Laravel') }}
                                <div class="float-right">
                                    @if(session()->has('success'))
                                        <span class="text-success">{{ session()->get('success') }}</span>
                                    @endif
                                    @error('url')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <form class="d-inline" method="POST" action="{{ route('downloads.store') }}">
                                        @csrf
                                        <label>
                                            <input class="form-control-sm" name="url" placeholder="URL" required>
                                        </label>
                                        <button type="submit" class="btn btn-sm btn-primary">Add URL</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($downloads->count())
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($downloads as $download)
                                                <tr>
                                                    <td>{{ $download->name }}</td>
                                                    <td>{{ $download->status }}</td>
                                                    <td>
                                                        @if($download->resource_url)
                                                            <a class="btn btn-sm btn-success" download
                                                               href="{{ $download->resource_url }}">Download</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    No downloaded resources
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
