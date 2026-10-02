@extends('pendaftar.layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="card spmb-card">
        <div class="card-header">Data Pendaftaran</div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor WhatsApp</th>
                        <th>Sekolah Terdaftar</th>
                        <th>Jalur Pendaftaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="No. Pendaftaran"><strong>{{ $registration->registration_number }}</strong></td>
                        <td data-label="Nama">{{ $registration->name }}</td>
                        <td data-label="Email">{{ auth('applicant')->user()->email }}</td>
                        <td data-label="Nomor WhatsApp">{{ $registration->phone }}</td>
                        <td data-label="Sekolah Terdaftar">SMK Muhammadiyah 1 Genteng</td>
                        <td data-label="Jalur Pendaftaran">{{ $registration->pathway ?: 'Belum dipilih' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card spmb-card">
        <div class="card-header">Alur Pendaftaran</div>
        <div class="card-body">
            @include('pendaftar.partials.steps')
            <a href="{{ route('pendaftar.registration') }}" class="btn btn-primary">Lanjutkan Pendaftaran &rarr;</a>
        </div>
    </div>

    {{-- Tata cara pendaftaran: tampil sekali setelah data awal disimpan --}}
    @if (session('show_guide'))
        <dialog class="spmb-guide" id="spmb-guide">
            <h2>Tata Cara Pendaftaran</h2>
            <ol>
                <li><strong>Pilih Jalur</strong> &mdash; Reguler, Prestasi, atau Beasiswa &amp; KIP.</li>
                <li><strong>Isi Data Diri</strong> &mdash; identitas calon peserta didik.</li>
                <li><strong>Formulir</strong> &mdash; sekolah asal, data orang tua, wali &amp; alamat.</li>
                <li><strong>Unggah Berkas</strong> &mdash; KK, Akte, Ijazah SMP, Pas Foto 3x4.</li>
                <li><strong>Pilih Jurusan</strong> &mdash; satu konsentrasi keahlian.</li>
                <li><strong>Pengumuman</strong> &mdash; hasil seleksi dari panitia.</li>
            </ol>
            <form method="dialog">
                <button type="submit" class="btn btn-primary btn-block">Saya Mengerti</button>
            </form>
        </dialog>
        <script>
            // Animasi masuk & keluar sama dengan modal konfirmasi (kelas is-open).
            const guide = document.getElementById("spmb-guide");
            const closeGuide = (event) => {
                event.preventDefault();
                guide.classList.remove("is-open");
            };

            guide.addEventListener("submit", closeGuide);
            guide.addEventListener("cancel", closeGuide);
            guide.addEventListener("transitionend", (event) => {
                if (event.target === guide && !guide.classList.contains("is-open")) guide.close();
            });

            guide.showModal();
            requestAnimationFrame(() => requestAnimationFrame(() => guide.classList.add("is-open")));
        </script>
    @endif
@endsection
