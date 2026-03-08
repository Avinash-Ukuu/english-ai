@extends('cms.layouts.master')

@section('content')
    <h2 class="mb-3">AI Conversation Practice</h2>

    <div class="chat-box mb-3">

        @foreach ($conversations as $chat)
            <div class="mb-3">

                <div class="p-2 bg-primary text-white rounded mb-1">
                    <b>You:</b> {{ $chat->user_message }}
                </div>

                <div class="p-2 bg-light border rounded">
                    <b>AI:</b> {{ $chat->ai_message }}
                </div>

            </div>
        @endforeach

    </div>

    <form method="POST" action="{{ route('cms.askAi') }}">
        @csrf

        <div class="input-group">

            <input type="text" name="message" class="form-control" placeholder="Type your message...">

            <button class="btn btn-primary">Send</button>

        </div>

    </form>
@endsection
