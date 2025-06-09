const WIKI_CONTEXT_URL = window.GEMINI_CONFIG.WIKI_CONTEXT_URL;
const GEMINI_ROUTE = window.GEMINI_CONFIG.GEMINI_ROUTE;
const CSRF_TOKEN = window.GEMINI_CONFIG.CSRF_TOKEN;

document.addEventListener("DOMContentLoaded", function () {
    const inputBox = document.getElementById('userInput');
    if (inputBox) {
        inputBox.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                consultarWikiGemini();
            }
        });
    }
});

async function consultarWikiGemini() {
    const inputBox = document.getElementById('userInput');
    const pregunta = inputBox.value.trim();
    if (!pregunta) return;

    inputBox.value = '';

    const respuestaDiv = document.getElementById('chatbot-response');
    const pensandoId = 'pensando_' + Date.now();
    respuestaDiv.innerHTML += `<div id="${pensandoId}" style="margin-bottom: 10px; width: 100%;">⏳ Pensando...</div>`;
    respuestaDiv.scrollTop = respuestaDiv.scrollHeight;

    try {
        const contextoRaw = await fetch(WIKI_CONTEXT_URL);
        const html = await contextoRaw.text();
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        //const parser = new DOMParser();
        //const doc = parser.parseFromString(html, 'text/html');
        let textoPlano = tempDiv.innerHTML;
        const imagenesRelacionadas = [];
//// imagenes
        const allImages = Array.from(tempDiv.querySelectorAll('img'));
        const palabrasIgnoradas = new Set(['hola', 'que', 'cómo', 'dónde', 'cuál', 'cuándo', 'buenos', 'buenas', 'tú', 'usted', 'yo', 'gracias', 'es', 'la', 'el', 'de', 'en', 'a', 'con', 'por', 'para']);

        allImages.forEach(img => {
        let src = img.getAttribute('src');
        if (!src) return;

        if (src.startsWith('/')) {
            const baseUrl = new URL(WIKI_CONTEXT_URL);
            src = baseUrl.origin + src;
        } else if (!src.startsWith('http')) {
            //src = WIKI_CONTEXT_URL + src;
            const basePath = WIKI_CONTEXT_URL.replace(/\/[^/]*\.html?$/, '/');
            src = basePath + src.replace(/^\.?\/?IMAGES\//, 'IMAGES/');
        }

        let descripcion = '';
        const padre = img.closest('p') || img.parentElement;
        if (padre) descripcion = padre.innerText.trim();

        const alt = img.getAttribute('alt')?.trim() || '';
        const nombreArchivo = decodeURIComponent(src.split('/').pop() || '')
            .replace(/\.[a-z]{3,4}$/i, '')
            .replace(/[_\-]/g, ' ');

        const descLower = (descripcion + ' ' + alt + ' ' + nombreArchivo).toLowerCase();

        if (descLower.length < 10) return;

        const preguntaLower = pregunta.toLowerCase();
        const palabrasClave = preguntaLower.split(/\s+/).filter(p => p.length > 3 && !palabrasIgnoradas.has(p));

        if (palabrasClave.length === 0) return;

        const coincidencias = palabrasClave.filter(palabra => descLower.includes(palabra));
        if (coincidencias.length >= 1) {
            imagenesRelacionadas.push(src);
        }
        });

        const contexto = `${textoPlano}\n\n${imagenesRelacionadas.map(img => 'Imagen: ' + img).join('\n')}`;
////fin imagenes
        const completions = await fetch(GEMINI_ROUTE, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": CSRF_TOKEN
            },
            body: JSON.stringify({
                prompt: pregunta,
                context: contexto
            })
        });

        const data = await completions.json();

        if (data && data.candidates && data.candidates[0]?.content?.parts) {
            let rawText = data.candidates[0].content.parts[0].text;

            rawText = rawText
                .replace(/`([^`]+)`/g, '$1')
                .replace(/<\s*(https?:\/\/[^>]+)\s*>/g, '$1')
                .replace(/(https?:\/\/[^\s]+)/g, (match) => {
                    return match.endsWith('.') ? match.slice(0, -1) : match;
                });

            function formatearRespuesta(texto) {
                return texto
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" style="color:#0645AD;">$1</a>')
                .replace(/\{color:([#\w]+)\}(.*?)\{\/color\}/g, '<span style="color:$1;">$2</span>')
                .replace(/(https?:\/\/[^\s"'<>]+?\.(jpg|jpeg|png|gif))/gi,
                    '<div><a href="$1" target="_blank"><img src="$1" alt="imagen" style="max-width:50%; height:auto; margin-top:10px; border-radius:8px;" /></a></div>')
                .replace(/(https?:\/\/[^\s"'<>]+)(?![^<]*>)/g,
                    (_match, url) => `<a href="${url}" target="_blank" style="color:#0645AD;">${url}</a>`)
                .replace(/\n/g, "<br>");
            }

            const textoRespuesta = formatearRespuesta(rawText);

            let imagenesHTML = '';
            imagenesRelacionadas.forEach(src => {
                imagenesHTML += `<div style="background-color:#f8f9fa; text-align:center; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px;"><a href="${src}" target="_blank"><img src="${src}" alt="imagen relacionada" style="max-width:30%; height:auto; margin-top:10px; border-radius:8px;" /></a><br></div>`;
            });

            document.getElementById(pensandoId).outerHTML = `
                <div style="margin-bottom: 10px;">
                    <b>Tú:</b><br>
                    <div style="white-space: pre-wrap; background: #d4edda; padding: 5px; border-radius: 6px;">${pregunta}</div>
                    <b><br>Inteligencia artificial:</b><br>
                    <div style="white-space: pre-wrap; background: #f8f9fa; padding: 5px; border-radius: 6px;">${textoRespuesta}</div>
                    ${imagenesHTML}
                </div>
            `;
            respuestaDiv.scrollTop = respuestaDiv.scrollHeight;
        } else if (data.error) {
            respuestaDiv.innerHTML = "⚠️ Error de Gemini: " + data.error.message;
        } else {
            respuestaDiv.innerHTML = "⚠️ Respuesta inesperada de Gemini.";
        }

    } catch (err) {
        console.error(err);
        respuestaDiv.innerHTML = "⚠️ Ocurrió un error al consultar Gemini.";
    }
}
