<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
        <title></title>
    </head>
    <body onload="javascript:cambiarPestanna(pestanas,pestana1);">
        <div class="contenedor">
            <div id="pestanas">
                <ul id=lista>
                    <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>Analisis</a></li>
                    <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>Requerimientos</a></li>
                    <!--<li id="pestana3"><a href='javascript:cambiarPestanna(pestanas,pestana3);'>JavaScript</a></li>
                    <li id="pestana4"><a href='javascript:cambiarPestanna(pestanas,pestana4);'>PHP</a></li>
                    <li id="pestana5"><a href='javascript:cambiarPestanna(pestanas,pestana5);'>Java EE</a></li>
                    <li id="pestana6"><a href='javascript:cambiarPestanna(pestanas,pestana6);'>Android</a></li>
                    <li id="pestana7"><a href='javascript:cambiarPestanna(pestanas,pestana7);'>Contenido HTML</a></li>-->
                </ul>
            </div>
            
            
        
            <div id="contenidopestanas">
                <div id="cpestana1">
                    HTML, siglas de HyperText Markup Language («lenguaje de marcado de hipertexto»), hace referencia al lenguaje de marcado predominante para la elaboración de páginas web que se utiliza para describir y traducir la estructura y la información en forma de texto, así como para complementar el texto con objetos tales como imágenes. El HTML se escribe en forma de «etiquetas», rodeadas por corchetes angulares (<,>). HTML también puede describir, hasta un cierto punto, la apariencia de un documento, y puede incluir un script (por ejemplo JavaScript), el cual puede afectar el comportamiento de navegadores web y otros procesadores de HTML. 
                </div>
                <div id="cpestana2">
                    El nombre hojas de estilo en cascada viene del inglés Cascading Style Sheets, del que toma sus siglas. CSS es un lenguaje usado para definir la presentación de un documento estructurado escrito en HTML o XML2 (y por extensión en XHTML). El W3C (World Wide Web Consortium) es el encargado de formular la especificación de las hojas de estilo que servirán de estándar para los agentes de usuario o navegadores.
                </div>
                <div id="cpestana3">
                    JavaScript es un lenguaje de programación interpretado, dialecto del estándar ECMAScript. Se define como orientado a objetos,3 basado en prototipos, imperativo, débilmente tipado y dinámico.
                </div>
                <div id="cpestana4">
                    PHP es un lenguaje de programación de uso general de script del lado del servidor originalmente diseñado para el desarrollo web de contenido dinámico. Fue uno de los primeros lenguajes de programación del lado del servidor que se podían incorporar directamente en el documento HTML en lugar de llamar a un archivo externo que procese los datos. El código es interpretado por un servidor web con un módulo de procesador de PHP que genera la página Web resultante. PHP ha evolucionado por lo que ahora incluye también una interfaz de línea de comandos que puede ser usada en aplicaciones gráficas independientes. PHP puede ser usado en la mayoría de los servidores web al igual que en casi todos los sistemas operativos y plataformas sin ningún costo.
                </div>
                <div id="cpestana5">
                    Java Platform, Enterprise Edition o Java EE (anteriormente conocido como Java 2 Platform, Enterprise Edition o J2EE hasta la versión 1.4; traducido informalmente como Java Empresarial), es una plataforma de programación—parte de la Plataforma Java—para desarrollar y ejecutar software de aplicaciones en el lenguaje de programación Java. Permite utilizar arquitecturas de N capas distribuidas y se apoya ampliamente en componentes de software modulares ejecutándose sobre un servidor de aplicaciones. La plataforma Java EE está definida por una especificación. Similar a otras especificaciones del Java Community Process, Java EE es también considerada informalmente como un estándar debido a que los proveedores deben cumplir ciertos requisitos de conformidad para declarar que sus productos son conformes a Java EE; estandarizado por The Java Community Process / JCP.
                </div>
                <div id="cpestana6">
                    Android es un sistema operativo móvil basado en Linux, que junto con aplicaciones middleware8 está enfocado para ser utilizado en dispositivos móviles como teléfonos inteligentes, tabletas, Google TV y otros dispositivos.9 Es desarrollado por la Open Handset Alliance, la cual es liderada por Google. Este sistema por lo general maneja aplicaciones como Google Play.
                </div>
                <div id="cpestana7">
                    <p>Se puede incluir cualquier tag html sin problemas, como por ejemplo html embebido con object.</p>
                    <object width="1000" height="400" data="https://codepen.io/isc7" type="text/html"></object> 
                </div>
            </div>
        </div>
<style>
    body {
        background: rgb(241, 220, 220);    
    }

    .contenedor{
        width: 1080px;
        margin: auto;
        background: lightgray;
        color: black;
        padding: 20px 15px 50px 50px;
        border-radius: 10px;
        box-shadow: 0 10px 10px 0px rgba(0, 0, 0, 0.8);
    }

    .contenedor .titulo{
        font-size: 3.5ex;
        font-weight: bold;
        margin-left: 10px;
        margin-bottom: 10px;
    }

    #pestanas {
        float: top;
        font-size: 3ex;
        font-weight: bold;
    }

    #pestanas ul{
        margin-left: -40px;    
    }

    #pestanas li{
        list-style-type: none;
        float: left;
        text-align: center;
        margin: 0px 2px -2px -0px;
        background: darkgrey;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border: 2px solid lightslategray;
        border-bottom: dimgray;
        padding: 0px 20px 0px 20px;
    }

    #pestanas a:link{
        text-decoration: none;
        color: lightslategray;
    }

    #contenidopestanas{
        clear: both;  
        background: lightsteelblue;
        padding: 20px 0px 20px 20px;
        border-radius: 5px;
        border-top-left-radius: 0px;
        border: 2px solid lightslategray;
        width: 1025px;
    }
</style>
<script>            
// Dadas la division que contiene todas las pestañas y la de la pestaña que se 
// quiere mostrar, la funcion oculta todas las pestañas a excepcion de esa.
function cambiarPestanna(pestannas,pestanna) {
    
    // Obtiene los elementos con los identificadores pasados.
    pestanna = document.getElementById(pestanna.id);
    listaPestannas = document.getElementById(pestannas.id);
    
    // Obtiene las divisiones que tienen el contenido de las pestañas.
    cpestanna = document.getElementById('c'+pestanna.id);
    listacPestannas = document.getElementById('contenido'+pestannas.id);
    
    i=0;
    // Recorre la lista ocultando todas las pestañas y restaurando el fondo 
    // y el padding de las pestañas.
    while (typeof listacPestannas.getElementsByTagName('div')[i] != 'undefined'){
        $(document).ready(function(){
            $(listacPestannas.getElementsByTagName('div')[i]).css('display','none');
            $(listaPestannas.getElementsByTagName('li')[i]).css('background','');
            $(listaPestannas.getElementsByTagName('li')[i]).css('padding-bottom','');
        });
        i += 1;
    }

    $(document).ready(function(){
        // Muestra el contenido de la pestaña pasada como parametro a la funcion,
        // cambia el color de la pestaña y aumenta el padding para que tape el  
        // borde superior del contenido que esta juesto debajo y se vea de este 
        // modo que esta seleccionada.
        $(cpestanna).css('display','');
        $(pestanna).css('background','dimgray');
        $(pestanna).css('padding-bottom','2px'); 
    });

}
</script>
    </body>
</html>
