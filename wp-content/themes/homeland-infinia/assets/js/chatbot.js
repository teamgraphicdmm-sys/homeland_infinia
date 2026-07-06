(function () {
    function initChatbot() {
        const launcher = document.querySelector('#chatLauncher');
        const chatWindow = document.querySelector('#chatWindow');
        const closeBtn = document.querySelector('#chatClose');
        const sendBtn = document.querySelector('#sendMessage');
        const messageInput = document.querySelector('#messageInput');
        const chatBody = document.querySelector('#chatBody');

        if (!launcher || !chatWindow) return; // chatbot disabled from wp-admin

        let greeted = false;

        function timeNow() {
            const d = new Date();
            const h = d.getHours().toString().padStart(2, '0');
            const m = d.getMinutes().toString().padStart(2, '0');
            return `${h}:${m}`;
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function appendBubble(text, sender) {
            const wrapper = document.createElement('div');
            wrapper.className = `bubble ${sender}`;
            if (sender === 'bot') {
                wrapper.innerHTML = `${text}<span class="bubble-time">${timeNow()}</span>`;
            } else {
                wrapper.innerHTML = `${escapeHtml(text)}<span class="bubble-time">${timeNow()}</span>`;
            }
            chatBody.appendChild(wrapper);
            chatBody.scrollTop = chatBody.scrollHeight;
            return wrapper;
        }

        function showTyping() {
            const wrapper = document.createElement('div');
            wrapper.className = 'bubble bot typing';
            wrapper.id = 'typingBubble';
            wrapper.innerHTML = `<span class="typing-dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>`;
            chatBody.appendChild(wrapper);
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function hideTyping() {
            const typing = document.querySelector('#typingBubble');
            if (typing) typing.remove();
        }

        function openChat() {
            chatWindow.classList.remove('is-hidden');
            launcher.classList.add('is-hidden');
            if (!greeted) {
                greeted = true;
                appendBubble("Hi there! I'm your Virtual Assistant. Ask me about Homeland Infinia — pricing, location, the virtual tour, or booking a site visit.", 'bot');
            }
            messageInput.focus();
        }

        function closeChat() {
            chatWindow.classList.add('is-hidden');
            launcher.classList.remove('is-hidden');
        }

        async function sendMessage() {
            const text = messageInput.value.trim();
            if (text === '') return;

            sendBtn.disabled = true;
            appendBubble(text, 'user');
            messageInput.value = '';

            const typingStartTime = Date.now();
            const minTypingDuration = 700;
            showTyping();

            try {
                const body = new URLSearchParams();
                body.set('action', 'hi_chatbot_message');
                body.set('nonce', hiChatbot.nonce);
                body.set('message', text);

                const response = await fetch(hiChatbot.ajaxUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: body.toString(),
                });

                if (!response.ok) throw new Error('Request failed');

                const botResponseText = await response.text();
                const elapsed = Date.now() - typingStartTime;
                const remaining = minTypingDuration - elapsed;
                if (remaining > 0) await new Promise((r) => setTimeout(r, remaining));

                hideTyping();
                appendBubble(botResponseText || 'Sorry, something went wrong.', 'bot');
            } catch (error) {
                const elapsed = Date.now() - typingStartTime;
                const remaining = minTypingDuration - elapsed;
                if (remaining > 0) await new Promise((r) => setTimeout(r, remaining));

                hideTyping();
                appendBubble("Sorry, I couldn't reach the server. Please try again.", 'bot');
                console.error('Error:', error);
            } finally {
                sendBtn.disabled = false;
                messageInput.focus();
            }
        }

        launcher.addEventListener('click', openChat);
        closeBtn.addEventListener('click', closeChat);
        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChatbot);
    } else {
        initChatbot();
    }
})();
