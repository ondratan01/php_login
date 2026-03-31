const chatBox = document.getElementById('chat-box');
const chatInput = document.getElementById('chat-input');
const sendBtn = document.getElementById('send-btn');


sendBtn.addEventListener('click', () => {
    const message = chatInput.value.trim();
    if (!message) return;

    fetch('send.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `message=${encodeURIComponent(message)}`
    }).then(() => {
        chatInput.value = '';
        loadMessages(); 
    });
});

//nacitani zprav kazdou sekundu
function loadMessages() {
    fetch('load.php')
        .then(response => response.text())
        .then(data => {
            chatBox.innerHTML = data;
            chatBox.scrollTop = chatBox.scrollHeight; //autoscroll dolu
        });
}

setInterval(loadMessages, 1000);
loadMessages();