@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar')

@php
    use App\Models\Registration;

    $sections = [
        'Data Diri' => [
            'Nama Lengkap' => $registration->name,
            'Jenis Kelamin' => $registration->gender,
            'Tempat, Tanggal Lahir' => trim(($registration->birth_place ? $registration->birth_place.', ' : '').$registration->birth_date?->translatedFormat('d F Y')),
            'Agama' => $registration->religion,
            'NISN' => $registration->nisn,
            'NIK' => $registration->nik,
            'No. KK' => $registration->kk_number,
            'No. HP' => $registration->phone,
            'Ukuran Baju' => $registration->shirt_size,
        ],
        'Pendaftaran' => [
            'Email Akun' => $registration->applicant?->email,
            'Jalur' => $registration->pathway,
            'Jurusan' => $registration->major ? $registration->major->code.' - '.$registration->major->name : null,
            'Asal Sekolah' => $registration->school_origin,
            'Dikirim' => $registration->submitted_at?->translatedFormat('d F Y, H:i'),
        ],
        'Data Ayah' => [
            'Nama' => $registration->father_name, 'Status' => $registration->father_status,
            'Pekerjaan' => $registration->father_job, 'No. HP' => $registration->father_phone,
        ],
        'Data Ibu' => [
            'Nama' => $registration->mother_name, 'Status' => $registration->mother_status,
            'Pekerjaan' => $registration->mother_job, 'No. HP' => $registration->mother_phone,
        ],
        'Biodata Wali' => [
            'Nama' => $registration->guardian_name, 'Hubungan' => $registration->guardian_relation,
            'Pekerjaan' => $registration->guardian_job, 'No. HP' => $registration->guardian_phone,
        ],
        'Tempat Tinggal' => [
            'Status' => $registration->residence_status, 'Alamat' => $registration->address,
        ],
    ];
@endphp

@section('content')
    <div class="page-header page-header-action">
        <div>
            <h1>{{ $registration->name }}</h1>
            <p>{{ $registration->registration_number }} ·
                <span class="status status-{{ $registration->status->tone() }}">{{ $registration->status->label() }}</span>
            </p>
        </div>
        <div class="table-actions">
            <a href="{{ route('admin.registrations.edit', $registration) }}" class="btn btn-primary">Ubah Status</a>
            @if ($registration->isSubmitted())
                <form method="POST" action="{{ route('admin.registrations.unlock', $registration) }}"
                    data-confirm-title="Buka Kunci Data?" data-confirm-ok="Ya, Buka Kunci" data-confirm="Buka kunci data {{ $registration->registration_number }}? Pendaftar bisa mengubah data lalu mengirim ulang.">
                    @csrf
                    <button type="submit" class="btn btn-outline">Buka Kunci</button>
                </form>
            @endif
            @if ($registration->applicant)
                <form method="POST" action="{{ route('admin.registrations.reset-password', $registration) }}"
                    data-confirm-title="Reset Kata Sandi?" data-confirm-ok="Ya, Reset" data-confirm="Buat kata sandi baru untuk {{ $registration->applicant->email }}?">
                    @csrf
                    <button type="submit" class="btn btn-outline">Reset Kata Sandi</button>
                </form>
            @endif
        </div>
    </div>

    <div class="form-layout">
        @foreach ($sections as $title => $rows)
            <div class="card form-card">
                <div class="card-header">{{ $title }}</div>
                <div class="table-wrap">
                    <table class="table">
                        @foreach ($rows as $label => $value)
                            <tr>
                                <th style="width: 40%;">{{ $label }}</th>
                                <td>{{ filled($value) ? $value : '-' }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach

        <div class="card form-card">
            <div class="card-header">Berkas</div>
            <div class="table-wrap">
                <table class="table">
                    @foreach (Registration::DOCUMENTS as $type => $label)
                        <tr>
                            <th style="width: 40%;">{{ $label }}</th>
                            <td>
                                @isset($documents[$type])
                                    <a href="{{ route('admin.registrations.document', $documents[$type]) }}" target="_blank" rel="noopener">Lihat berkas</a>
                                @else
                                    <span class="text-muted">Belum diunggah</span>
                                @endisset
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline">Kembali</a>
    </div>
@endsection
