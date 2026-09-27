@extends('layouts.app')

@section('content')
  @php
    $steps = ['Pendaftaran Diterima', 'Verifikasi Berkas', 'Hasil Seleksi'];
  @endphp

  <main>
    <header class="page-header">
      <div class="container">
        <div class="badge-amber mb-2">SPMB {{ $site->get('spmb_academic_year') }}</div>
        <h1 class="page-title">Cek Status Pendaftaran</h1>
        <p class="page-subtitle">
          Lihat apakah berkas Anda sudah diverifikasi panitia tanpa perlu menelepon. Masukkan nomor pendaftaran dan tanggal lahir calon siswa.
        </p>
      </div>
    </header>

    <section class="spmb-section">
      <div class="container status-wrap">
        <form method="POST" action="{{ route('spmb.status.check') }}" class="status-form">
          @csrf
          <div class="status-field">
            <label for="registration_number">Nomor Pendaftaran</label>
            <input type="text" id="registration_number" name="registration_number" autocomplete="off"
              value="{{ old('registration_number', request('registration_number')) }}"
              placeholder="SPMB-{{ $site->spmbYear() }}-XXXXX" required>
            @error('registration_number') <div class="status-error">{{ $message }}</div> @enderror
          </div>
          <div class="status-field">
            <label for="birth_date">Tanggal Lahir</label>
            <input type="date" id="birth_date" name="birth_date"
              value="{{ old('birth_date', request('birth_date')) }}" required>
            @error('birth_date') <div class="status-error">{{ $message }}</div> @enderror
          </div>
          <button type="submit" class="btn btn-primary status-submit">Cek Status</button>
        </form>

        @if (! empty($notFound))
          <div class="status-card status-card-empty" role="alert">
            <h2>Data tidak ditemukan</h2>
            <p>
              Pastikan nomor pendaftaran dan tanggal lahir sudah benar. Nomor pendaftaran diberikan panitia setelah Anda mendaftar.
              Jika masih belum ditemukan, hubungi panitia.
            </p>
            <a href="{{ $site->whatsappLink('spmb', 'Halo Panitia SPMB, saya ingin menanyakan nomor pendaftaran saya.') }}"
              target="_blank" rel="noopener noreferrer" class="btn btn-outline">Hubungi Panitia (WhatsApp)</a>
          </div>
        @elseif (! empty($registration))
          @php $status = $registration->status; @endphp
          <div class="status-card">
            <div class="status-card-head">
              <div>
                <div class="status-number">{{ $registration->registration_number }}</div>
                <h2>{{ $registration->masked_name }}</h2>
              </div>
              <span class="status-badge status-badge-{{ $status->tone() }}">{{ $status->label() }}</span>
            </div>

            <ol class="status-steps">
              @foreach ($steps as $index => $label)
                @php
                  $number = $index + 1;
                  $isLastRejected = $number === 3 && $status === \App\Enums\RegistrationStatus::Rejected;
                @endphp
                <li class="{{ $number <= $status->step() ? ($isLastRejected ? 'is-rejected' : 'is-done') : '' }}">
                  <span class="status-step-dot">{{ $number }}</span>
                  <span>{{ $number === 3 && $status->step() === 3 ? $status->label() : $label }}</span>
                </li>
              @endforeach
            </ol>

            <p class="status-desc">{{ $status->description() }}</p>

            @if ($registration->note)
              <div class="status-note">
                <strong>Catatan Panitia</strong>
                <p>{{ $registration->note }}</p>
              </div>
            @endif

            <dl class="status-detail">
              <div><dt>Jurusan Pilihan</dt><dd>{{ $registration->major?->name ?? '-' }}</dd></div>
              <div><dt>Jalur</dt><dd>{{ $registration->pathway ?? '-' }}</dd></div>
              <div><dt>Asal Sekolah</dt><dd>{{ $registration->school_origin ?? '-' }}</dd></div>
              <div><dt>Terakhir Diperbarui</dt><dd>{{ $registration->updated_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</dd></div>
            </dl>

            <a href="{{ $site->whatsappLink('spmb', "Halo Panitia SPMB, saya ingin bertanya tentang pendaftaran {$registration->registration_number}.") }}"
              target="_blank" rel="noopener noreferrer" class="btn btn-outline">Tanya Panitia (WhatsApp)</a>
          </div>
        @endif

        <p class="status-back"><a href="{{ url('/spmb') }}">&larr; Kembali ke informasi SPMB</a></p>
      </div>
    </section>
  </main>
@endsection
