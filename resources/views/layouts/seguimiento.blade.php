@extends('home')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
    <div class="row">
        <div class="card">
            <div class="button-group">
                <button id="pestana1" type="button" class="btn btn-light-primary text-primary px-4 rounded-pill font-medium collapsed">Análisis</button>
                <button id="pestana2" type="button" class="btn btn-light-success text-success px-4 rounded-pill font-medium collapsed">Requerimientos</button>
            </div>
            <div class="card-body wizard-content">
                <h5 class="card-title mb-0">Seguimiento</h5>
            </div>
            @include(view('formatos.maquetado.edit'))
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#pestana1").click(function(){
            $('[id^="AA"]').collapse('show')
            $('[id^="PIP"]').collapse('hide')
        });
        $("#pestana2").click(function(){
            $('[id^="AA"]').collapse('hide')
            $('[id^="PIP"]').collapse('show')
        });
    });
</script>
@endsection

<script type="text/javascript">
    function arrow(id){
        icon = document.getElementById(id);
        //icon = document.getElementsByClassName('fas')
        //for(i=0; i<icon.length; i++){
            if(icon.classList == "fas fa-arrow-circle-down"){
                icon.classList.remove("fa-arrow-circle-down");
                icon.classList.toggle("fa-arrow-circle-up");
            }
            else{
                icon.classList.toggle("fa-arrow-circle-down");
                icon.classList.remove("fa-arrow-circle-up");
            }
        //}
    }
</script>

<script type="text/javascript">
    function lock(play,btn){
        button = document.getElementById(btn)
        estatus = document.getElementById(play)
        sub = document.getElementsByClassName('fa-plus')
        idSub = document.getElementsByClassName('fa-check')
        if(estatus.classList == "fas fa-play"){
            button.disabled = true;
            //sub.removeAttribute("href");
            //idSub.removeAttribute("href") 
        }
    }
</script>


