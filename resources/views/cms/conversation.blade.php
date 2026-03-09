@extends('cms.layouts.master')
@section('content')
    <div class="container">
        <h2 class="mb-4">AI English Conversation Practice</h2>
        <div class="card shadow">
            <div class="card-body">
                <div id="chatBox" style="height:400px;overflow-y:auto">
                    @foreach ($messages as $msg)
                        <div class="mb-3">
                            <div class="p-2 bg-primary text-white rounded mb-1">
                                <b>You:</b> {{ $msg->user_message }}
                            </div>
                            <div class="p-2 bg-light border rounded">
                                <b>AI:</b> {{ $msg->ai_message }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="input-group mt-3">
                    <input type="text" id="message" class="form-control" placeholder="Type your message..."
                        autocomplete="off">
                    <button id="sendBtn" onclick="sendMessage()" class="btn btn-success">
                        Send
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const messageInput = document.getElementById("message");
        const chatBox = document.getElementById("chatBox");
        const sendBtn = document.getElementById("sendBtn");

        messageInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                sendMessage();
            }
        });

        function sendMessage() {
            let message = messageInput.value.trim();
            if (message === "") {
                return;
            }
            sendBtn.disabled = true;
            chatBox.innerHTML   += `
                                    <div class="mb-3">
                                        <div class="p-2 bg-primary text-white rounded mb-1">
                                            <b>You:</b> ${message}
                                        </div>

                                        <div class="p-2 bg-light border rounded ai-typing">
                                            <b>AI:</b> Typing...
                                        </div>
                                    </div>`;

            chatBox.scrollTop = chatBox.scrollHeight;
            fetch("{{ route('cms.conversation.send') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(res => res.json())
                .then(data => {
                    let typing = document.querySelector(".ai-typing");
                    typing.innerHTML = `<b>AI:</b> ${data.ai}`;
                    messageInput.value = "";
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(() => {
                    alert("Error connecting to AI server");
                })
                .finally(() => {
                    sendBtn.disabled = false;
                });
        }
    </script>
@endsection
