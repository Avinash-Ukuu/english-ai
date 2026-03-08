@extends('cms.layouts.master')

@section('content')
    <h2>Speaking Practice</h2>

    <div class="card p-4 shadow-sm">

        <h5>Speak this sentence</h5>

        <h3 class="text-primary" id="sentence">{{ $sentence }}</h3>

        <input type="text" id="spoken" class="form-control mt-3" placeholder="Speech will appear here">
        <input type="hidden" id="level" value="{{ $level }}">
        <div class="mt-3">

            <button onclick="startRecognition()" class="btn btn-success">
                🎤 Start Speaking
            </button>

            <button onclick="stopRecognition()" class="btn btn-secondary">
                ⏹ Stop
            </button>

        </div>

    </div>

    <script>
        let recognition;

        function initSpeech() {

            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

            if (!SpeechRecognition) {
                alert("Speech recognition not supported in this browser");
                return;
            }

            recognition = new SpeechRecognition();
            recognition.lang = "en-US";
            recognition.continuous = false;
            recognition.interimResults = false;
            recognition.onresult = function(event) {
                let speech = event.results[0][0].transcript;
                document.getElementById("spoken").value = speech;
                console.log("User said:", speech);
                // send speech to backend
                data = sendSpeech(speech);
                location.reload();
            }

            recognition.onerror = function(event) {

                console.log("Speech error:", event.error);

                alert("Speech recognition error: " + event.error);

            }

        }

        function startRecognition() {

            if (!recognition) {
                initSpeech();
            }

            recognition.start();

        }

        function stopRecognition() {

            if (recognition) {
                recognition.stop();
            }

        }

        function sendSpeech(text) {
            fetch("{{ route('cms.speaking.evaluate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({

                        sentence: document.getElementById("sentence").innerText,
                        spoken: text,
                        level: document.getElementById("level").value
                    })
                })
                .then(res => res.json())
                .then(data => {

                    alert("Score: " + data.score + "% \nFeedback: " + data.feedback);

                });

        }
    </script>
@endsection
