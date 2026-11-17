<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
   <img src="https://www.thousandslink.com/images/logo.png" class="logo" alt="ThousandsLink Affiliate Network">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} ThousandsLink. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
