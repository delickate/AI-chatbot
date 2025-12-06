# 🤖 Delickate AI Agent  
A fully functional **ChatGPT-style AI chatbot** built using **Laravel**, **Blade**, and **Ollama** (running Llama 3 or any local model).  
The chat interface supports **real-time streaming responses**, message bubbles, auto-scrolling, and a clean UX similar to ChatGPT.

---

## 🚀 Features

### ✔ Real-time Streaming (token-by-token)
The AI responds progressively like ChatGPT using Ollama's `stream: true` API.

### ✔ Clean Chat Interface
- User messages in blue (right aligned)
- AI messages in grey (left aligned)
- Auto scroll-to-bottom
- Mobile-friendly UI

### ✔ Local & Private AI
Runs entirely on **your machine** using Ollama.  
Zero data leaves your device.

### ✔ Easy to Customize
You can swap models instantly:
```json
"model": "llama3:8b"

![chatbot](image.png)