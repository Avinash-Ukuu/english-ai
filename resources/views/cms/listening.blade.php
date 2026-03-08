@extends('cms.layouts.master')
@section('content')
    <div class="container">
        <h2 class="mb-4">Listening Practice</h2>
        <div class="card shadow p-4">
            <form method="GET" action="{{ route('cms.listening') }}">
                <label>Select Level</label>
                <select name="level" class="form-control mb-3" disabled="true" onchange="this.form.submit()">
                    <option value="beginner" {{ $level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ $level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ $level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </form>

            <p class="text-muted">Click play and type what you hear.</p>
            <input type="hidden" id="sentence" value="{{ $sentence }}">
            <input type="hidden" id="level" value="{{ $level }}">
            <button onclick="playAudio()" class="btn btn-primary mb-3">🔊 Play Audio</button>
            <input type="text" id="userText" class="form-control" placeholder="Type what you heard">
            <button onclick="submitAnswer()" class="btn btn-success mt-3">Submit</button>
            <div class="mt-4">
                <h4 id="score"></h4>
                <p id="feedback"></p>
            </div>
        </div>
    </div>

    <script>
        function playAudio() {
            let text = document.getElementById("sentence").value;
            let speech = new SpeechSynthesisUtterance(text);
            speech.lang = "en-US";
            speech.rate = 0.9;
            speechSynthesis.speak(speech);
        }

        function submitAnswer() {
            let sentence = document.getElementById("sentence").value;
            let user_text = document.getElementById("userText").value;
            let level = document.getElementById("level").value;

            fetch("{{ route('cms.listening.evaluate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        sentence: sentence,
                        user_text: user_text,
                        level: level
                    })
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById("score").innerText = "Score: " + data.score + "%";
                    document.getElementById("feedback").innerText = data.feedback;
                });
                 location.reload();

        }
    </script>
@endsection
