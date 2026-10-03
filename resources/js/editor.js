// Editor isi (Trix), hanya dimuat di form yang memakainya: @include('admin.partials.rich-editor').
import 'trix';
import 'trix/dist/trix.css';

// Tanpa unggah gambar/berkas di dalam isi: thumbnail sudah punya kolom sendiri.
document.addEventListener('trix-file-accept', (event) => event.preventDefault());
