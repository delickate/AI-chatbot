<!DOCTYPE html>
<html>
<head>
    <title>Delickate AI Agent</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial; padding: 40px; background: #f8f9fa; }
        .chat-box { max-width: 700px; margin: auto; background: white; padding: 20px; border-radius: 8px; display: flex; flex-direction: column; height: 80vh; }
        #chatHistory { overflow-y: auto; flex-grow: 1; padding-bottom: 20px; }
        .msg { margin-bottom: 15px; padding: 10px 15px; border-radius: 6px; max-width: 75%; }
        .user { background: #007bff; color: white; margin-left: auto; }
        .ai { background: #e9ecef; color: #333; }
        textarea { width: 100%; height: 80px; margin-top: 10px; padding: 10px; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; margin-top: 5px; }
        .loading { color: #777; padding: 10px; }
    </style>
</head>

<body>
<div class="chat-box">
    <h2>Delickate AI Agent</h2>

    <div id="chatHistory"></div>

    <div id="loading" class="loading" style="display:none;">Thinking...</div>

    <textarea id="message" placeholder="Type your message..."></textarea>
    <button class="btn" id="sendBtn">Send</button>
</div>

<script>
document.getElementById('sendBtn').addEventListener('click', sendMessage);

function sendMessage() {
    let message = document.getElementById('message').value;
    let csrf = document.querySelector('meta[name="csrf-token"]').content;

    if (!message.trim()) return;

    appendMessage(message, "user");   // add user message to chat
    document.getElementById('message').value = "";

    document.getElementById('loading').style.display = 'block';

    fetch("{{ route('chat.send') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": csrf
        },
        body: JSON.stringify({ message: message })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('loading').style.display = 'none';
        appendMessage(data.reply, "ai");  // add AI response to chat
    })
    .catch(err => {
        document.getElementById('loading').style.display = 'none';
        appendMessage("Error: " + err, "ai");
    });
}

function appendMessage(text, sender) {
    let box = document.getElementById('chatHistory');
    let div = document.createElement('div');
    div.classList.add('msg', sender);
    div.innerText = text;
    box.appendChild(div);

    // auto scroll to bottom
    box.scrollTop = box.scrollHeight;
}
</script>
</body>
</html>
