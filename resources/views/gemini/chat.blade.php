<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="chatModalLabel">Asistente virtual</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div id="chatbot-widget">
          <div style="overflow-y: auto;">
            <div id="chatbot-response">
                Hola, estoy listo para responder tus dudas.
            </div>
          </div>
          <textarea id="userInput" class="form-control mt-3" placeholder="Escribe tu pregunta..."></textarea>
          <button class="btn mt-2" onclick="consultarWikiGemini()">Enviar pregunta</button>
        </div>
      </div>
    </div>
  </div>
</div>
<link href="{{ asset("assets/extra-libs/chatbot/css/chatbot.css") }}" rel="stylesheet">
<script>
    window.GEMINI_CONFIG = {
        WIKI_CONTEXT_URL: "{{ asset('assets/gemini/diccionario.html') }}",
        GEMINI_ROUTE: "{{ route('GeminiChat') }}",
        CSRF_TOKEN: "{{ csrf_token() }}"
    };
</script>
<script src="{{ asset("assets/extra-libs/chatbot/js/chatbot.js") }}"></script>