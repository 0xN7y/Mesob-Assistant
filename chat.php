```php
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BG Mesob</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    min-height: 100%;
}

body {
    font-family: 'Inter', Arial, sans-serif;
    color: #eef2ff;
    background:
        radial-gradient(circle at 15% 35%, rgba(46, 99, 210, 0.35), transparent 38%),
        radial-gradient(circle at 85% 65%, rgba(117, 68, 230, 0.30), transparent 40%),
        linear-gradient(135deg, #071525 0%, #0b1a31 45%, #10152b 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    background:
        radial-gradient(circle at 25% 70%, rgba(0, 180, 255, 0.08), transparent 35%),
        radial-gradient(circle at 75% 25%, rgba(80, 120, 255, 0.08), transparent 35%);
    z-index: 0;
}

.app {
    position: relative;
    z-index: 1;
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* HEADER */

.header {
    width: 100%;
    padding: 18px 7%;
    background: rgba(7, 15, 29, 0.55);
    border-bottom: 1px solid rgba(255,255,255,0.04);
    backdrop-filter: blur(16px);
}

.brand {
    font-size: 25px;
    font-weight: 600;
    color: #e9efff;
}

/* MAIN */

.main {
    width: 100%;
    max-width: 900px;
    margin: 0 auto;
    padding: 15px 20px 35px;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* TITLE */

.title {
    font-size: clamp(30px, 7vw, 43px);
    font-weight: 650;
    letter-spacing: -1.5px;
    text-align: center;
    margin-top: 0;
    color: #eef2ff;
}

.subtitle {
    margin-top: 26px;
    color: rgba(235,240,255,0.52);
    font-size: 17px;
    font-weight: 400;
    display: flex;
    align-items: center;
    gap: 9px;
}

/* LOGO / COMPANION */

.companion {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 8px;
}

.companion img {
    width: 38px;
    height: 38px;
    object-fit: contain;
}

.companion span {
    font-size: 18px;
}

/* MODE SWITCH */

.mode-switch {
    margin-top: 25px;
    display: flex;
    align-items: center;
    padding: 4px;
    border-radius: 30px;
    background: rgba(255,255,255,0.045);
    border: 1px solid rgba(255,255,255,0.07);
}

.mode {
    border: none;
    background: transparent;
    color: rgba(255,255,255,0.38);
    padding: 9px 20px;
    border-radius: 24px;
    font-family: inherit;
    font-size: 14px;
    cursor: pointer;
}

.mode.active {
    background: rgba(255,255,255,0.13);
    color: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
}

/* SUGGESTIONS */

.suggestions {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-top: 60px;
}

.suggestion {
    border: 1px solid rgba(255,255,255,0.08);
    background: rgba(255,255,255,0.045);
    color: rgba(245,247,255,0.78);
    border-radius: 30px;
    padding: 11px 22px;
    font-family: inherit;
    font-size: 15px;
    cursor: pointer;
    transition: 0.25s ease;
    backdrop-filter: blur(10px);
}

.suggestion:hover {
    background: rgba(255,255,255,0.09);
    transform: translateY(-2px);
    border-color: rgba(255,255,255,0.14);
}

/* CHAT */

.chat {
    width: 100%;
    max-width: 760px;
    margin-top: 35px;
    display: flex;
    flex-direction: column;
    gap: 13px;
    max-height: 280px;
    overflow-y: auto;
    padding: 4px 5px;
    scrollbar-width: thin;
}

.message {
    max-width: 78%;
    padding: 13px 22px;
    border-radius: 28px;
    font-size: 15px;
    line-height: 1.55;
    color: rgba(255,255,255,0.86);
    border: 1px solid rgba(255,255,255,0.05);
    background: rgba(255,255,255,0.035);
    backdrop-filter: blur(12px);
    text-align: left;
}

.message.user {
    align-self: flex-end;
    background: rgba(65,105,230,0.22);
    border-color: rgba(85,120,255,0.12);
}

.message.assistant {
    align-self: flex-start;
}

.message a {
    color: #9eb5ff;
    text-decoration: none;
}

.message a:hover {
    text-decoration: underline;
}

/* INPUT */

.input-area {
    width: 100%;
    max-width: 760px;
    margin-top: 38px;
}

.input-box {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 7px 6px 20px;
    border-radius: 40px;
    background: rgba(255,255,255,0.045);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(18px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.18);
}

.input-box:focus-within {
    border-color: rgba(100,130,255,0.30);
    box-shadow:
        0 15px 45px rgba(0,0,0,0.20),
        0 0 0 2px rgba(90,120,255,0.05);
}

#question {
    flex: 1;
    min-width: 0;
    border: none;
    outline: none;
    background: transparent;
    color: white;
    font-family: inherit;
    font-size: 15px;
    padding: 12px 0;
}

#question::placeholder {
    color: rgba(255,255,255,0.25);
}

/* SEND */

.send-btn {
    border: none;
    cursor: pointer;
    color: white;
    background: linear-gradient(135deg, #5879ff, #7a58f3);
    border-radius: 28px;
    padding: 11px 25px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 500;
    transition: 0.25s ease;
}

.send-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 20px rgba(86,103,255,0.25);
}

/* MICROPHONE */

.mic-btn {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    background: linear-gradient(135deg, #5275ff, #7855f5);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    transition: 0.25s ease;
}

.mic-btn:hover {
    transform: scale(1.04);
    box-shadow: 0 8px 22px rgba(90,100,255,0.3);
}

.mic-btn.listening {
    box-shadow: 0 0 0 5px rgba(110,100,255,0.16);
}

/* FOOTER */

.footer {
    text-align: center;
    padding: 5px 15px 20px;
    color: rgba(255,255,255,0.12);
    font-size: 10px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.footer div {
    margin-top: 5px;
}

/* MOBILE */

@media (max-width: 600px) {

    .header {
        padding: 17px 32px;
    }

    .brand {
        font-size: 23px;
    }

    .main {
        padding: 0 18px 20px;
    }

    .title {
        margin-top: 0;
        font-size: 32px;
        white-space: nowrap;
    }

    .subtitle {
        margin-top: 25px;
        font-size: 16px;
    }

    .mode-switch {
        margin-top: 22px;
    }

    .mode {
        padding: 9px 18px;
    }

    .suggestions {
        margin-top: 60px;
        gap: 9px;
    }

    .suggestion {
        font-size: 14px;
        padding: 10px 18px;
    }

    .chat {
        margin-top: 32px;
        max-height: 280px;
    }

    .message {
        max-width: 86%;
        font-size: 14px;
        padding: 12px 20px;
    }

    .input-area {
        margin-top: 30px;
    }

    .input-box {
        padding-left: 17px;
    }

    #question {
        font-size: 14px;
    }

    .send-btn {
        padding: 11px 20px;
    }

    .mic-btn {
        width: 46px;
        height: 46px;
    }

    .footer {
        font-size: 9px;
        padding-bottom: 18px;
    }
}
</style>
</head>

<body>

<div class="app">

    <header class="header">
        <div class="brand">BG Mesob</div>
    </header>

    <main class="main">

        <h1 class="title">Ask Me Any Question</h1>

        <div class="companion">
            <img src="assets/images/logo.png" alt="BG Mesob Logo">
            <span>Your intelligent companion</span>
        </div>

        <div class="mode-switch">

            <button type="button" class="mode" id="fastMode">
                Mesob Fast
            </button>

            <button type="button" class="mode active" id="proMode">
                Mesob Pro
            </button>

        </div>

        <div class="suggestions">

            <button
                type="button"
                class="suggestion"
                data-question="How do I get my fyda">
                How do I get my fyda
            </button>

            <button
                type="button"
                class="suggestion"
                data-question="How do I get TIN number">
                How do I get TIN number
            </button>

            <button
                type="button"
                class="suggestion"
                data-question="ፋይዳ ለማውታት">
                ፋይዳ ለማውታት
            </button>

            <button
                type="button"
                class="suggestion"
                data-question="i lost my passport">
                i lost my passport
            </button>

        </div>

        <div class="chat" id="chatMessages">

            <div class="message assistant">
                Goodbye! Have a great day.
            </div>

            <div class="message user">
                Bye
            </div>

            <div class="message assistant">
                Goodbye! Have a great day.
            </div>

        </div>

        <div class="input-area">

            <form class="input-box" id="chatForm">

                <input
                    type="text"
                    id="question"
                    autocomplete="off"
                    placeholder="Ask Mesob anything..."
                    required
                >

                <button
                    type="submit"
                    class="send-btn">
                    Send
                </button>

                <button
                    type="button"
                    class="mic-btn"
                    id="micButton"
                    title="Voice input">
                    🎙
                </button>

            </form>

        </div>

    </main>

    <footer class="footer">
        <div>CRAFTED WITH INTENTION BY NATNEAL AMSALU</div>
        <div>NATNEALNAT@GMAIL.COM</div>
    </footer>

</div>

<script>

(function () {

    const form = document.getElementById('chatForm');
    const input = document.getElementById('question');
    const messages = document.getElementById('chatMessages');
    const micButton = document.getElementById('micButton');
    const fastMode = document.getElementById('fastMode');
    const proMode = document.getElementById('proMode');

    /*
     * Add message to chat
     */

    function addMessage(text, type, allowHtml = false) {

        const message = document.createElement('div');

        message.className = 'message ' + type;

        if (allowHtml) {
            message.innerHTML = text;
        } else {
            message.textContent = text;
        }

        messages.appendChild(message);

        messages.scrollTop = messages.scrollHeight;

        return message;
    }

    /*
     * Typing indicator
     */

    function addTyping() {

        removeTyping();

        const typing = document.createElement('div');

        typing.className = 'message assistant';
        typing.id = 'typingMessage';

        typing.innerHTML = '...';

        messages.appendChild(typing);

        messages.scrollTop = messages.scrollHeight;

        return typing;
    }

    function removeTyping() {

        const typing = document.getElementById('typingMessage');

        if (typing) {
            typing.remove();
        }

    }

    /*
     * Suggestion buttons
     */

    document
        .querySelectorAll('.suggestion')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const question =
                    this.getAttribute('data-question');

                if (!question) {
                    return;
                }

                input.value = question;
                input.focus();

            });

        });

    /*
     * Chat submission
     */

    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        const question = input.value.trim();

        if (!question) {
            return;
        }

        /*
         * Show user's question
         */

        addMessage(question, 'user');

        input.value = '';

        /*
         * Show typing indicator
         */

        addTyping();

        try {

            /*
             * Send question to PHP API
             */

            const formData = new FormData();

            formData.append('question', question);

            const response = await fetch(
                'api_chat.php',
                {
                    method: 'POST',
                    body: formData
                }
            );

            /*
             * Check HTTP response
             */

            if (!response.ok) {

                throw new Error(
                    'HTTP error: ' + response.status
                );

            }

            /*
             * Convert response to JSON
             */

            const data = await response.json();

            console.log('Mesob API response:', data);

            removeTyping();

            /*
             * API returned success
             */

            if (data.ok) {

                /*
                 * Matching service found
                 */

                if (data.found && data.service) {

                    const service = data.service;

                    const answer = `
                        <strong>${escapeHtml(service.service_name || 'Service')}</strong><br><br>

                        <strong>Organization:</strong><br>
                        ${escapeHtml(service.organization || 'Not specified')}<br><br>

                        <strong>Requirements:</strong><br>
                        ${formatText(service.requirements || 'Not specified')}<br><br>

                        <strong>Processing Time:</strong><br>
                        ${escapeHtml(service.processing_time || 'Not specified')}<br><br>

                        <strong>Government Fee:</strong><br>
                        ${escapeHtml(service.government_fee || 'Not specified')}<br><br>

                        <strong>Mesob Service Fee:</strong><br>
                        ${escapeHtml(service.mesob_fee || 'Not specified')}<br><br>

                        ${
                            service.link
                                ? `<a href="${escapeAttribute(service.link)}">View Service Details</a>`
                                : ''
                        }
                    `;

                    addMessage(
                        answer,
                        'assistant',
                        true
                    );

                }

                /*
                 * No matching service
                 */

                else {

                    addMessage(
                        data.message ||
                        'I could not find a matching service in the BG Mesob service catalogue.',
                        'assistant'
                    );

                }

            }

            /*
             * API returned an error
             */

            else {

                addMessage(
                    data.message ||
                    'Sorry, something went wrong.',
                    'assistant'
                );

            }

        }

        catch (error) {

            console.error(
                'Mesob API error:',
                error
            );

            removeTyping();

            addMessage(
                'Sorry, I could not connect to Mesob. Please try again.',
                'assistant'
            );

        }

    });

    /*
     * Enter key
     */

    input.addEventListener('keydown', function (e) {

        if (
            e.key === 'Enter' &&
            !e.shiftKey
        ) {

            e.preventDefault();

            form.requestSubmit();

        }

    });

    /*
     * Mesob Fast / Mesob Pro buttons
     */

    fastMode.addEventListener('click', function () {

        fastMode.classList.add('active');
        proMode.classList.remove('active');

    });

    proMode.addEventListener('click', function () {

        proMode.classList.add('active');
        fastMode.classList.remove('active');

    });

    /*
     * Escape HTML
     *
     * This prevents service data from breaking
     * the chat interface.
     */

    function escapeHtml(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }

    /*
     * Escape URL attribute
     */

    function escapeAttribute(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');

    }

    /*
     * Format requirement text
     *
     * Converts line breaks into HTML line breaks.
     */

    function formatText(value) {

        return escapeHtml(value)
            .replace(/\r\n/g, '<br>')
            .replace(/\n/g, '<br>')
            .replace(/\r/g, '<br>');

    }

    /*
     * Microphone / speech recognition
     */

    const SpeechRecognition =
        window.SpeechRecognition ||
        window.webkitSpeechRecognition;

    if (SpeechRecognition) {

        const recognition =
            new SpeechRecognition();

        recognition.lang = 'en-US';
        recognition.interimResults = false;
        recognition.continuous = false;

        micButton.addEventListener(
            'click',
            function () {

                try {

                    recognition.start();

                    micButton.classList.add(
                        'listening'
                    );

                }

                catch (error) {

                    console.log(error);

                }

            }
        );

        recognition.addEventListener(
            'result',
            function (event) {

                const transcript =
                    event.results[0][0].transcript;

                input.value = transcript;

                input.focus();

            }
        );

        recognition.addEventListener(
            'end',
            function () {

                micButton.classList.remove(
                    'listening'
                );

            }
        );

        recognition.addEventListener(
            'error',
            function () {

                micButton.classList.remove(
                    'listening'
                );

            }
        );

    }

    else {

        micButton.addEventListener(
            'click',
            function () {

                alert(
                    'Voice input is not supported by this browser.'
                );

            }
        );

    }

})();

</script>

</body>
</html>
```
