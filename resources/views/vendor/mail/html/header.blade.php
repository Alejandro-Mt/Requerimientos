<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Logo 3TI">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
