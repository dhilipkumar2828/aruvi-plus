@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none; color: #004200; font-family: 'Playfair Display', serif; font-size: 24px; font-weight: bold;">
    @if(file_exists(public_path('auri-images/logo.png')))
        <img src="{{ config('app.url') }}/auri-images/logo.png" class="logo" alt="{{ config('app.name') }}" style="max-height: 50px;">
    @else
        {{ config('app.name') }}
    @endif
</a>
</td>
</tr>
