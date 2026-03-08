@extends('cms.layouts.master')

@section('content')
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Total Practice</h5>
                <h2>{{ $sessions }}</h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Speaking</h5>
                <p>Practice pronunciation</p>
                <a href="{{ route('cms.speaking') }}" class="btn btn-primary btn-sm">Start</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Listening</h5>
                <p>Improve listening</p>
                <a href="{{ route('cms.listening') }}" class="btn btn-success btn-sm">Start</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <h5>Reading</h5>
                <p>Read paragraphs</p>
                <a href="{{ route('cms.reading') }}" class="btn btn-warning btn-sm">Start</a>
            </div>
        </div>

    </div>
@endsection
