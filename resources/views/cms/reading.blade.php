@extends('cms.layouts.master')
@section('content')
    <div class="container">
        <h2 class="mb-4">Reading Practice</h2>
        <div class="card shadow p-4">
            <form method="GET" action="{{ route('cms.reading') }}">
                <label>Select Level</label>
                <select name="level" class="form-control mb-3" disabled="true" onchange="this.form.submit()">
                    <option value="beginner" {{ $level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ $level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ $level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </form>
            <div class="bg-light p-3 mb-3">
                <p>{{$paragraph}}</p>
                <strong>{{$question}}</strong>
            </div>

            <input type="hidden" id="paragraph" value="{{ $paragraph }}">
            <input type="hidden" id="correct_answer" value="{{ $answer }}">
            <input type="hidden" id="level" value="{{ $level }}">
            <label>Your Answer</label>
            <textarea id="answer" class="form-control" rows="4"></textarea>
            <button onclick="submitAnswer()" class="btn btn-primary mt-3">
                Submit Answer
            </button>
            <div class="mt-4">
                <h4>Score</h4>
                <p id="score"></p>
                <h4>Feedback</h4>
                <p id="feedback"></p>
            </div>
        </div>
    </div>

    <script>
        function submitAnswer() {

            let paragraph       = document.getElementById("paragraph").value;
            let correct_answer  = document.getElementById("correct_answer").value;
            let answer          = document.getElementById("answer").value;
            let level           = document.getElementById("level").value;

            fetch("{{ route('cms.reading.evaluate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        paragraph: paragraph,
                        correct_answer: correct_answer,
                        answer: answer,
                        level: level
                    })
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById("score").innerText = data.score + " / 100";
                    document.getElementById("feedback").innerText = data.feedback;
                });
                location.reload();

        }
    </script>
@endsection
