<x-mail::message>


    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        {{ $line }}
    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
        <?php
        $color = match ($level) {
            'success', 'error' => $level,
            default => 'primary',
        };
        ?>
        <x-mail::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mail::button>
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        {{ $line }}
    @endforeach

    {{-- Salutation --}}
    {{-- @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('Regards'),<br>
        {{ config('app.name') }}
    @endif --}}
    "MALAYSIA MADANI"

    "BERKHIDMAT UNTUK NEGARA"

    Saya yang menjalankan amanah,

    - melalui e-mel -
    ……………………..
    Unit Aduan
    b. p. Pengarah Bahagian Korporat
    Perbadanan Pengurusan Sisa Pepejal dan Pembersihan Awam (SWCorp)

    Nota : E-mel ini tidak perlu dibalas

    {{-- Subcopy --}}
    @isset($actionText)
        <x-slot:subcopy>
            @lang("Sekiranya mempunyai masalah butang \":actionText\" , copy dan paste  URL dibawah\n" . 'ke browser anda:', [
                'actionText' => $actionText,
            ]) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        </x-slot:subcopy>
    @endisset
</x-mail::message>
