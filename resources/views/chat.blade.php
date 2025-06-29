<!DOCTYPE html>
<html>
<head>
    <title>Chat with AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Ask AI Anything</h1>

    <form id="chatForm">
        <input type="text" id="message" name="message" placeholder="Ask something..." required>
        <button type="submit">Send</button>
    </form>

    <div id="response" style="margin-top: 20px; font-weight: bold;"></div>

    <script>
document.getElementById('chatForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const message = document.getElementById('message').value;

    try {
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
        console.log("Response from server:", data); 

        document.getElementById('response').innerText = data.reply ?? 'No reply received.';
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('response').innerText = 'Error talking to AI.';
    }
});

    </script>
</body>
</html>
