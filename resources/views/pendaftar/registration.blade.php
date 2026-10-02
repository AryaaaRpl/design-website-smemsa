@extends('pendaftar.layouts.app')

@section('title', 'Pendaftaran')

@php
    use App\Models\Registration;

    $current = $registration->currentStep();
    $locked = $registration->isSubmitted();
@endphp

@section('content')
    {{-- Navigasi fase: fase yang belum terbuka tidak bisa diklik --}}
    <nav class="spmb-phases" aria-label="Fase pendaftaran">
        @foreach ($phases as $key => [$label, $step])
            @if ($step <= $current)
                <a href="{{ route('pendaftar.phase', $key) }}" class="spmb-phase {{ $key === $phase ? 'is-current' : '' }} {{ $step < $current ? 'is-done' : '' }}">
                    <span>{{ $step }}</span>{{ $label }}
                </a>
            @else
                <span class="spmb-phase is-locked"><span>{{ $step }}</span>{{ $label }}</span>
            @endif
        @endforeach
    </nav>

    @if ($locked)
        <div class="alert">Pendaftaran sudah dikirim pada {{ $registration->submitted_at->translatedFormat('d F Y, H:i') }} dan data dikunci. Hubungi panitia lewat menu Bantuan untuk perubahan.</div>
    @endif

    <form method="POST" action="{{ route('pendaftar.phase.update', $phase) }}" @if ($phase === 'berkas') enctype="multipart/form-data" @endif>
        @csrf

        @switch($phase)
            @case('jalur')
                <div class="card spmb-card">
                    <div class="card-header">Pilih Jalur Pendaftaran</div>
                    <div class="card-body spmb-choices">
                        @foreach (Registration::PATHWAYS as $pathway)
                            <label class="spmb-choice">
                                <input type="radio" name="pathway" value="{{ $pathway }}" @checked(old('pathway', $registration->pathway) === $pathway) @disabled($locked) required>
                                <span>{{ $pathway }}</span>
                            </label>
                        @endforeach
                        @error('pathway') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                @break

            @case('data-diri')
                <div class="card spmb-card">
                    <div class="card-header">Isi Data Diri</div>
                    <div class="card-body form-grid">
                        @include('pendaftar.partials.field', ['name' => 'name', 'label' => 'Nama Lengkap', 'full' => true])
                        @include('pendaftar.partials.field', ['name' => 'gender', 'label' => 'Jenis Kelamin', 'type' => 'select', 'options' => Registration::GENDERS])
                        @include('pendaftar.partials.field', ['name' => 'religion', 'label' => 'Agama', 'type' => 'select', 'options' => Registration::RELIGIONS])
                        @include('pendaftar.partials.field', ['name' => 'birth_place', 'label' => 'Tempat Lahir'])
                        @include('pendaftar.partials.field', ['name' => 'birth_date', 'label' => 'Tanggal Lahir', 'type' => 'date'])
                        @include('pendaftar.partials.field', ['name' => 'nisn', 'label' => 'NISN', 'digits' => 10])
                        @include('pendaftar.partials.field', ['name' => 'nik', 'label' => 'NIK', 'digits' => 16])
                        @include('pendaftar.partials.field', ['name' => 'kk_number', 'label' => 'No. KK', 'digits' => 16])
                        @include('pendaftar.partials.field', ['name' => 'phone', 'label' => 'No. Handphone', 'type' => 'tel'])
                        @include('pendaftar.partials.field', ['name' => 'shirt_size', 'label' => 'Ukuran Baju/Kaos', 'type' => 'select', 'options' => Registration::SHIRT_SIZES])
                    </div>
                </div>
                @break

            @case('formulir')
                <div class="card spmb-card">
                    <div class="card-header">Pendidikan Sebelumnya</div>
                    <div class="card-body">
                        @include('pendaftar.partials.field', ['name' => 'school_origin', 'label' => 'Nama SMP/MTs'])
                    </div>
                </div>

                @foreach (['father' => 'Data Ayah', 'mother' => 'Data Ibu'] as $key => $title)
                    <div class="card spmb-card">
                        <div class="card-header">{{ $title }} Kandung</div>
                        <div class="card-body form-grid">
                            @include('pendaftar.partials.field', ['name' => "{$key}_name", 'label' => 'Nama'])
                            @include('pendaftar.partials.field', ['name' => "{$key}_status", 'label' => 'Status', 'type' => 'select', 'options' => Registration::PARENT_STATUSES])
                            @include('pendaftar.partials.field', ['name' => "{$key}_job", 'label' => 'Pekerjaan'])
                            @include('pendaftar.partials.field', ['name' => "{$key}_phone", 'label' => 'No. HP', 'type' => 'tel', 'optional' => true])
                        </div>
                    </div>
                @endforeach

                <div class="card spmb-card">
                    <div class="card-header">Biodata Wali</div>
                    <div class="card-body form-grid">
                        @include('pendaftar.partials.field', ['name' => 'guardian_name', 'label' => 'Nama'])
                        @include('pendaftar.partials.field', ['name' => 'guardian_relation', 'label' => 'Hubungan', 'type' => 'select', 'options' => Registration::GUARDIAN_RELATIONS])
                        @include('pendaftar.partials.field', ['name' => 'guardian_job', 'label' => 'Pekerjaan'])
                        @include('pendaftar.partials.field', ['name' => 'guardian_phone', 'label' => 'No. HP', 'type' => 'tel'])
                    </div>
                </div>

                <div class="card spmb-card">
                    <div class="card-header">Status Tempat Tinggal &amp; Alamat</div>
                    <div class="card-body form-grid">
                        @include('pendaftar.partials.field', ['name' => 'residence_status', 'label' => 'Status Tempat Tinggal', 'type' => 'select', 'options' => Registration::RESIDENCES, 'full' => true])
                        @include('pendaftar.partials.field', ['name' => 'address', 'label' => 'Alamat Rumah sesuai KK/Domisili', 'type' => 'textarea', 'full' => true])
                    </div>
                </div>
                @break

            @case('berkas')
                <div class="card spmb-card">
                    <div class="card-header">Unggah Berkas</div>
                    <div class="card-body">
                        <p class="form-help" style="margin: 0 0 16px;">Format PDF, JPG, atau PNG, maksimal 2 MB per berkas. Unggah ulang untuk mengganti.</p>
                        <div class="spmb-docs">
                            @foreach (Registration::DOCUMENTS as $type => $label)
                                <div class="spmb-doc {{ isset($documents[$type]) ? 'is-done' : '' }}">
                                    <div class="spmb-doc-head">
                                        <strong>{{ $label }} <span class="required">*</span></strong>
                                        @if (isset($documents[$type]))
                                            <a href="{{ route('pendaftar.document', $documents[$type]) }}" target="_blank" rel="noopener">&#10003; {{ $documents[$type]->original_name }}</a>
                                        @else
                                            <span class="text-muted">Belum diunggah</span>
                                        @endif
                                    </div>
                                    @unless ($locked)
                                        <input type="file" name="{{ $type }}" class="form-input" accept=".pdf,.jpg,.jpeg,.png">
                                    @endunless
                                    @error($type) <div class="form-error">{{ $message }}</div> @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @break

            @case('jurusan')
                <div class="card spmb-card">
                    <div class="card-header">Pilih Jurusan (Konsentrasi Keahlian)</div>
                    <div class="card-body spmb-choices">
                        @foreach ($majors as $major)
                            <label class="spmb-choice">
                                <input type="radio" name="major_id" value="{{ $major->id }}" @checked((int) old('major_id', $registration->major_id) === $major->id) @disabled($locked) required>
                                <span><strong>{{ $major->code }}</strong> &mdash; {{ $major->name }}</span>
                            </label>
                        @endforeach
                        @error('major_id') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                @break
        @endswitch

        @unless ($locked)
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan &amp; Lanjutkan</button>
            </div>
        @endunless
    </form>

    {{-- Semua fase lengkap: kirim pendaftaran (data lalu dikunci) --}}
    @if (! $locked && $current >= 6)
        <form method="POST" action="{{ route('pendaftar.submit') }}" class="card spmb-card spmb-submit"
            onsubmit="return confirm('Kirim pendaftaran? Setelah dikirim, data tidak bisa diubah lagi.')">
            @csrf
            <div class="card-body">
                <strong>Semua fase sudah lengkap.</strong>
                <p>Periksa kembali data Anda, lalu kirim pendaftaran untuk diverifikasi panitia.</p>
                <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
            </div>
        </form>
    @endif
@endsection
