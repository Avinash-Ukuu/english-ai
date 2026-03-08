@extends('cms.layouts.master')

@section('content')

<h2>Reading Practice</h2>

<div class="card shadow-sm p-4 mt-3">

<h5>Read the paragraph</h5>

<pre style="font-size:16px">{{$content}}</pre>

</div>

@endsection
