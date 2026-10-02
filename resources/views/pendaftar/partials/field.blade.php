{{-- Satu isian formulir. $name, $label, $type (text/date/tel/select/textarea), $options (untuk select), $full, $hint, $optional --}}
@php
    $type ??= 'text';
    $value = old($name, $registration->{$name} instanceof \Carbon\CarbonInterface ? $registration->{$name}->toDateString() : $registration->{$name});
    $locked = $registration->isSubmitted();
@endphp
<div class="form-group {{ ! empty($full) ? 'form-full' : '' }}">
    <label for="{{ $name }}" class="form-label">{{ $label }} @unless (! empty($optional))<span class="required">*</span>@endunless</label>

    @if ($type === 'select')
        <select id="{{ $name }}" name="{{ $name }}" class="form-input" @disabled($locked) @required(empty($optional))>
            <option value="">Pilih {{ mb_strtolower($label) }}</option>
            @foreach ($options as $option)
                <option value="{{ $option }}" @selected($value === $option)>{{ $option }}</option>
            @endforeach
        </select>
    @elseif ($type === 'textarea')
        <textarea id="{{ $name }}" name="{{ $name }}" class="form-input" rows="3" @disabled($locked) @required(empty($optional))>{{ $value }}</textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-input" value="{{ $value }}"
            @if (! empty($digits)) inputmode="numeric" pattern="[0-9]{{ '{'.$digits.'}' }}" maxlength="{{ $digits }}" @endif
            @if ($type === 'tel') inputmode="tel" placeholder="081234567890" @endif
            @disabled($locked) @required(empty($optional))>
    @endif

    @if (! empty($hint)) <div class="form-help">{{ $hint }}</div> @endif
    @error($name) <div class="form-error">{{ $message }}</div> @enderror
</div>
