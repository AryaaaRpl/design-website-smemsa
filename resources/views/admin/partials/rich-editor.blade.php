{{-- Editor isi (Trix). $name, $value. Nilai disimpan ke input tersembunyi lalu dikirim bersama form. --}}
@vite('resources/js/editor.js')
<input type="hidden" id="{{ $name }}" name="{{ $name }}" value="{{ \App\Support\RichText::forEditor($value) }}">
<trix-editor input="{{ $name }}" class="trix-content form-input rich-editor"></trix-editor>
