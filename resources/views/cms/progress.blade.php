@extends('cms.layouts.master')

@section('content')
    <h2>Your Progress</h2>

    <div class="card shadow-sm p-4">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>Type</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>

            </thead>

            <tbody>

                @foreach ($sessions as $s)
                    <tr>
                        <td>{{ $s->type }}</td>
                        <td>{{ $s->score }}</td>
                        <td>{{ $s->created_at }}</td>
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
