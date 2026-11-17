@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <img src="https://www.thousandslink.com/images/logo.png" class="logo" alt="ThousandsLink Affiliate Network">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
