<!DOCTYPE html>
<html>
<head>
    <title>Gemini AI Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Talk to Gemini AI</h1>

    <form id="chatForm">
        <input type="text" id="message" name="message" placeholder="Ask something..." required>
        <button type="submit">Send</button>
    </form>

    <div id="response" style="margin-top: 20px; font-weight: bold;"></div>

    <script>
        document.getElementById('chatForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const message = document.getElementById('message').value;

            const response = await fetch('/ask-ai', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            document.getElementById('response').innerText = data.reply;
        });
    </script>
</body>
</html>
