@extends('cms.layouts.master')
@section('content')
    <div class="container">
        <h2 class="mb-4">Learning Progress</h2>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Total Sessions</h5>
                    <h2>{{ $totalSessions }}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Speaking Avg</h5>
                    <h2>{{ $speakingAvg }}%</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Listening Avg</h5>
                    <h2>{{ $listeningAvg }}%</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3 shadow">
                    <h5>Reading Avg</h5>
                    <h2>{{ $readingAvg }}%</h2>
                </div>
            </div>
        </div>

        <div class="card shadow p-4">
            <h4>Recent Practice</h4>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Level</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent as $r)
                        <tr>
                            <td>{{ $r->type }}</td>
                            <td>{{ $r->level }}</td>
                            <td>{{ $r->score }}</td>
                            <td>{{ $r->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
