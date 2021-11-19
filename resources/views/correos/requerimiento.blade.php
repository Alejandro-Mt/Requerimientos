@component('mail::message')
# Introduction

Test de respuesta cliente

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
