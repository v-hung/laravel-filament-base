@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
@php
$logo = setting_image('shop.site_logo');
$logoUrl = $logo['url'] ?? null;
$siteName = setting('shop.site_name', config('app.name'));
@endphp

@if ($logoUrl)
<img src="{{ $logoUrl }}" class="logo" alt="{{ $siteName }}">
@else
{{ $siteName }}
@endif
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
