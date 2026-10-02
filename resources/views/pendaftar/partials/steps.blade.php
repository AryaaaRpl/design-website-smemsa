{{-- Alur pendaftaran: langkah 1 s.d. langkah yang sedang dikerjakan menyala. --}}
@php($current = $registration->currentStep())
<ol class="spmb-steps">
    @foreach (array_keys($registration->steps()) as $i => $label)
        <li class="spmb-step {{ $i + 1 <= $current ? 'is-active' : '' }} {{ $i + 1 === $current ? 'is-current' : '' }}">
            <span class="spmb-step-num">{{ $i + 1 }}</span>
            <span class="spmb-step-label">{{ $label }}</span>
        </li>
    @endforeach
</ol>
