<?php
$pageTitle = "Search MISA ";
require_once "config/database.php";
include "includes/header.php";
?>

<style>


@import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: #0c0d12;
    min-height: 100vh;
    color: #f0f2f8;
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}



::-webkit-scrollbar {
    width: 5px;
}

::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.02);
    border-radius: 12px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.15);
    border-radius: 12px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(255,255,255,0.25);
}

/* =========================================================
   BACKGROUND
   ========================================================= */

.bg-mesh {
    position: fixed;
    inset: 0;
    z-index: 0;

    background:
        radial-gradient(
            circle at 20% 30%,
            rgba(66,133,244,0.25) 0%,
            transparent 45%
        ),
        radial-gradient(
            circle at 80% 70%,
            rgba(123,97,255,0.2) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 40% 80%,
            rgba(0,212,255,0.15) 0%,
            transparent 40%
        ),
        radial-gradient(
            circle at 70% 20%,
            rgba(52,168,83,0.08) 0%,
            transparent 35%
        );

    background-color: #0b0d14;

    animation: meshFloat 22s ease-in-out infinite alternate;

    will-change: transform, opacity;
}

.bg-blur-glow {
    position: fixed;
    inset: 0;
    z-index: 0;
    pointer-events: none;

    filter: blur(100px);
    opacity: 0.3;

    background:
        radial-gradient(
            circle at 15% 25%,
            #4285F4 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 85% 60%,
            #7B61FF 0%,
            transparent 60%
        ),
        radial-gradient(
            circle at 50% 90%,
            #00D4FF 0%,
            transparent 40%
        );

    animation: glowDrift 30s ease-in-out infinite alternate;
}

@keyframes meshFloat {
    0% {
        transform: scale(1) rotate(0deg);
    }

    100% {
        transform: scale(1.08) rotate(1.5deg);
    }
}

@keyframes glowDrift {
    0% {
        transform: translate(0, 0) scale(1);
        opacity: 0.2;
    }

    100% {
        transform: translate(4%, -3%) scale(1.2);
        opacity: 0.4;
    }
}



.app-container {
    position: relative;
    z-index: 2;

    min-height: 100vh;

    display: flex;
    flex-direction: column;

    backdrop-filter: blur(2px);
}



.glass-nav {
    padding: 1.2rem 2.5rem;

    background: rgba(255,255,255,0.03);

    backdrop-filter: blur(18px) saturate(180%);
    -webkit-backdrop-filter: blur(18px) saturate(180%);

    border-bottom: 1px solid rgba(255,255,255,0.04);

    display: flex;
    align-items: center;
    justify-content: space-between;

    flex-wrap: wrap;
    gap: 0.8rem;

    transition: all 0.3s ease;
}

.brand {
    font-weight: 600;
    font-size: 1.3rem;
    letter-spacing: -0.02em;

    background: linear-gradient(
        135deg,
        #f0f2f8 0%,
        #b0b8d0 100%
    );

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;

    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.brand-mark {
    width: 30px;
    height: 30px;

    border-radius: 9px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        135deg,
        #4285F4,
        #7B61FF
    );

    color: #fff;

    font-size: 14px;
    font-weight: 700;

    -webkit-text-fill-color: #fff;

    box-shadow:
        0 6px 18px rgba(66,133,244,0.2);
}

.nav-actions {
    display: flex;
    gap: 1.2rem;
    align-items: center;
}

.nav-actions span {
    font-size: 1.3rem;
    color: rgba(255,255,255,0.5);

    transition: all 0.25s ease;

    cursor: default;
}

.nav-actions span:hover {
    color: #fff;
    transform: translateY(-1px) scale(1.05);
}


.hero {
    flex: 1;

    display: flex;
    flex-direction: column;

    justify-content: center;
    align-items: center;

    padding: 2rem 1.5rem 4rem;

    max-width: 900px;
    margin: 0 auto;

    width: 100%;

    text-align: center;
}

/* =========================================================
   GREETING
   ========================================================= */

.greeting-wrap {
    margin-bottom: 0.3rem;
    overflow: hidden;
}

.greeting {
    font-size: clamp(3.8rem, 14vw, 6.8rem);

    font-weight: 600;

    letter-spacing: -0.04em;
    line-height: 1.05;

    background: linear-gradient(
        135deg,
        #f0f2f8 0%,
        #b0b8d0 40%,
        #7B61FF 70%,
        #4285F4 100%
    );

    background-size: 300% 300%;

    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;

    animation:
        floatUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards,
        gradShift 10s ease-in-out infinite alternate;

    animation-delay: 0.1s, 0.1s;

    transform: translateY(40px);
    opacity: 0;
}

@keyframes floatUp {
    0% {
        opacity: 0;
        transform: translateY(40px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes gradShift {
    0% {
        background-position: 0% 50%;
    }

    100% {
        background-position: 100% 50%;
    }
}



.sub-greeting {
    font-size: clamp(1.2rem, 4vw, 2.2rem);

    font-weight: 400;

    letter-spacing: -0.01em;

    color: rgba(255,255,255,0.6);

    margin-top: -0.2rem;
    margin-bottom: 1.8rem;

    opacity: 0;

    animation:
        fadeUp 0.9s cubic-bezier(0.16, 1, 0.3, 1)
        forwards;

    animation-delay: 0.6s;
}

@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}



.suggest-grid {
    display: flex;
    flex-wrap: wrap;

    justify-content: center;

    gap: 1rem;

    margin-top: 2.2rem;

    width: 100%;
}

.suggest-card {
    flex: 0 1 auto;

    min-width: 150px;

    padding: 0.9rem 1.6rem;

    background: rgba(255,255,255,0.04);

    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    border: 1px solid rgba(255,255,255,0.06);

    border-radius: 40px;

    box-shadow:
        0 12px 30px -12px rgba(0,0,0,0.4);

    color: rgba(255,255,255,0.75);

    font-weight: 450;

    letter-spacing: -0.01em;

    transition:
        all 0.35s cubic-bezier(0.16, 1, 0.3, 1);

    cursor: pointer;

    backdrop-filter: blur(12px);

    transform: translateY(20px);
    opacity: 0;

    animation:
        cardRise
        0.7s
        cubic-bezier(0.16, 1, 0.3, 1)
        forwards;
}

.suggest-card:nth-child(1) {
    animation-delay: 0.9s;
}

.suggest-card:nth-child(2) {
    animation-delay: 1.05s;
}

.suggest-card:nth-child(3) {
    animation-delay: 1.2s;
}

@keyframes cardRise {
    0% {
        opacity: 0;
        transform: translateY(20px) scale(0.96);
    }

    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.suggest-card:hover {
    transform:
        translateY(-6px)
        scale(1.02)
        rotate(0.5deg);

    background: rgba(255,255,255,0.08);

    border-color: rgba(255,255,255,0.15);

    box-shadow:
        0 20px 40px -12px rgba(66,133,244,0.2),
        0 0 0 1px rgba(255,255,255,0.02);
}

.suggest-card .icon {
    margin-right: 0.6rem;

    color: #7B61FF;

    font-size: 1.1rem;

    transition: transform 0.25s ease;
}

.suggest-card:hover .icon {
    transform: rotate(6deg) scale(1.1);
}



.chat-input-wrap {
    width: 100%;

    max-width: 720px;

    margin: 2.2rem auto 0;

    padding: 0 0.5rem;
}

.input-glass {
    display: flex;
    align-items: center;

    background: rgba(255,255,255,0.04);

    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);

    border: 1px solid rgba(255,255,255,0.06);

    border-radius: 60px;

    padding:
        0.3rem
        0.3rem
        0.3rem
        1.8rem;

    box-shadow:
        0 16px 40px -16px rgba(0,0,0,0.5);

    transition:
        all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.input-glass:focus-within {
    box-shadow:
        0 20px 50px -16px rgba(66,133,244,0.2),
        0 0 0 2px rgba(66,133,244,0.08);

    transform: scale(1.01);

    background: rgba(255,255,255,0.06);

    border-color: rgba(255,255,255,0.1);
}

.input-glass input {
    flex: 1;

    min-width: 0;

    background: transparent;

    border: none;
    outline: none;

    color: #f0f2f8;

    font-size: 1rem;

    padding: 0.9rem 0;

    font-weight: 400;

    letter-spacing: -0.01em;

    font-family: inherit;
}

.input-glass input::placeholder {
    color: rgba(255,255,255,0.25);

    font-weight: 350;

    transition: opacity 0.3s ease;
}

.input-glass input:focus::placeholder {
    opacity: 0.2;
}

.input-glass button {
    background: linear-gradient(
        135deg,
        #4285F4,
        #7B61FF
    );

    border: none;

    border-radius: 40px;

    padding: 0.6rem 1.3rem;

    color: #fff;

    font-weight: 500;

    font-size: 0.95rem;

    display: flex;
    align-items: center;

    gap: 0.5rem;

    transition:
        all 0.3s cubic-bezier(0.16, 1, 0.3, 1);

    box-shadow:
        0 4px 12px rgba(66,133,244,0.2);

    cursor: pointer;

    font-family: inherit;
}

.input-glass button:hover {
    transform:
        translateY(-2px)
        scale(1.02);

    box-shadow:
        0 12px 24px -8px rgba(66,133,244,0.4);
}

.input-glass button:active {
    transform: scale(0.94);
}

.input-glass button .arrow {
    font-size: 1.1rem;
}


.chat-preview {
    width: 100%;

    max-width: 720px;

    margin: 1.5rem auto 0;

    padding: 0 0.5rem;

    display: flex;

    flex-direction: column;

    gap: 0.8rem;

    max-height: 300px;

    overflow-y: auto;

    scrollbar-width: thin;
}

.msg {
    padding: 0.9rem 1.4rem;

    border-radius: 28px;

    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);

    background: rgba(255,255,255,0.03);

    border: 1px solid rgba(255,255,255,0.04);

    max-width: 80%;

    animation:
        msgSlide
        0.5s
        cubic-bezier(0.16, 1, 0.3, 1)
        forwards;

    opacity: 0;

    transform: translateY(12px);

    font-weight: 400;

    line-height: 1.5;

    box-shadow:
        0 6px 18px -8px rgba(0,0,0,0.2);

    text-align: left;
}

.msg.user {
    align-self: flex-end;

    background: rgba(66,133,244,0.12);

    border-color: rgba(66,133,244,0.1);

    transform: translateX(20px);

    animation:
        msgSlideRight
        0.5s
        cubic-bezier(0.16, 1, 0.3, 1)
        forwards;
}

.msg.assistant {
    align-self: flex-start;

    background: rgba(255,255,255,0.02);

    border-color: rgba(255,255,255,0.04);
}

@keyframes msgSlide {
    0% {
        opacity: 0;
        transform: translateY(12px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes msgSlideRight {
    0% {
        opacity: 0;
        transform: translateX(20px);
    }

    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.msg:nth-child(1) {
    animation-delay: 0.3s;
}

.msg:nth-child(2) {
    animation-delay: 0.5s;
}

.msg:nth-child(3) {
    animation-delay: 0.7s;
}



.typing-indicator {
    display: flex;
    align-items: center;

    gap: 6px;

    padding:
        0.4rem
        1rem;

    background: rgba(255,255,255,0.02);

    border-radius: 40px;

    width: fit-content;

    backdrop-filter: blur(4px);

    border: 1px solid rgba(255,255,255,0.02);

    margin-top: 0.2rem;

    opacity: 0;

    animation:
        fadeUp
        0.6s
        ease
        forwards;

    animation-delay: 1s;
}

.typing-indicator span {
    width: 8px;
    height: 8px;

    background: rgba(255,255,255,0.2);

    border-radius: 40px;

    display: inline-block;

    animation:
        pulseDot
        1.4s
        ease-in-out
        infinite;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes pulseDot {
    0%, 100% {
        transform: scale(0.6);
        opacity: 0.3;
    }

    50% {
        transform: scale(1);
        opacity: 0.8;
    }
}



.footer-meta {
    margin-top: 2rem;

    color: rgba(255,255,255,0.12);

    font-size: 0.7rem;

    letter-spacing: 0.02em;

    text-transform: uppercase;

    font-weight: 400;
}

/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 640px) {

    .glass-nav {
        padding: 0.8rem 1.2rem;

        flex-direction: column;

        align-items: flex-start;

        gap: 0.3rem;
    }

    .hero {
        padding:
            1.5rem
            1rem;
    }

    .suggest-card {
        min-width: 120px;

        padding:
            0.6rem
            1.2rem;

        font-size: 0.9rem;
    }

    .input-glass {
        border-radius: 40px;

        padding:
            0.2rem
            0.2rem
            0.2rem
            1.2rem;
    }

    .input-glass input {
        font-size: 0.9rem;

        padding: 0.6rem 0;
    }

    .input-glass button {
        padding:
            0.4rem
            1rem;

        font-size: 0.8rem;
    }

    .msg {
        max-width: 90%;
    }
}
</style>



<div class="bg-mesh"></div>
<div class="bg-blur-glow"></div>



<div class="app-container">



<nav class="glass-nav">

    <div class="brand">

        <div class="brand-mark">
            M
        </div>

        Mesob

    </div>


    <div class="nav-actions">

        <span title="Theme">☾</span>
        <span title="Settings">⚙</span>
        <span title="Account">●</span>

    </div>

</nav>



<main class="hero">


    <!-- GREETING -->

    <div class="greeting-wrap">

        <div class="greeting">
            Hello
        </div>

    </div>


    <div class="sub-greeting">
        Search Mesob 
    </div>


   

    <div class="suggest-grid">

        <button
            type="button"
            class="suggest-card"
            data-q="passport renewal"
        >
            <span class="icon">✦</span>
            Passport
        </button>


        <button
            type="button"
            class="suggest-card"
            data-q="Tin number"
        >
            <span class="icon">⚡</span>
            Tin number
        </button>


        <button
            type="button"
            class="suggest-card"
            data-q="business registration"
        >
            <span class="icon">▤</span>
            Business registration
        </button>

    </div>




    <div
        id="chatMessages"
        class="chat-preview"
    >

        <div class="msg assistant">
            How can I help you today?
        </div>


        <div class="msg user">
             Mesob.
        </div>


        <div class="msg assistant">
            Mesob is an Ethiopian service assistant.
        </div>


        <div
            id="typingIndicator"
            class="typing-indicator"
        >
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>



    <div class="chat-input-wrap">

        <form
            id="chatForm"
            class="input-glass"
        >

            <input
                id="question"
                type="text"
                autocomplete="off"
                placeholder="Searck Mesob ..."
                aria-label="chat input"
                required
            >


            <button
                type="submit"
            >
                <span class="arrow">↑</span>
                Send
            </button>

        </form>

    </div>


    <div class="footer-meta">
        MISA
    </div>

</main>


</div>

<script>
(function () {

    const form = document.getElementById('chatForm');
    const input = document.getElementById('question');
    const messages = document.getElementById('chatMessages');
    const typing = document.getElementById('typingIndicator');



    function addMessage(text, type) {

        const message = document.createElement('div');

        message.className = 'msg ' + type;

        message.textContent = text;

        messages.insertBefore(
            message,
            typing
        );

        messages.scrollTop =
            messages.scrollHeight;

        return message;
    }


    document
        .querySelectorAll('.suggest-card')
        .forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    const question =
                        this.getAttribute('data-q');

                    if (!question) {
                        return;
                    }

                    input.value = question;

                    input.focus();

                }
            );

        });


    

    if (form) {

        form.addEventListener(
            'submit',
            function (e) {

                e.preventDefault();

                const question =
                    input.value.trim();

                if (!question) {
                    return;
                }


                /* Add user's message */

                addMessage(
                    question,
                    'user'
                );


                input.value = '';


         

                if (typing) {
                    typing.style.opacity = '1';
                }


                /*
                 *  Query from db  
                 * 
                 *
               
                 */


                messages.scrollTop =
                    messages.scrollHeight;

            }
        );

    }




    if (input) {

        input.addEventListener(
            'keydown',
            function (e) {

                if (
                    e.key === 'Enter' &&
                    !e.shiftKey
                ) {

                    e.preventDefault();

                    form.dispatchEvent(
                        new Event('submit')
                    );

                }

            }
        );

    }


})();
</script>

<?php
include "includes/footer.php";
?>
