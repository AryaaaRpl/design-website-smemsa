{{-- Grafik batang pengunjung. $points: [['label','date','count'], ...]; batang terakhir (hari/bulan berjalan) disorot kuning. --}}
@php($max = max(1, $points->max('count')))
<div class="visitor-chart" role="img" aria-label="{{ $caption }}">
    @foreach ($points as $point)
        <div class="visitor-bar {{ $loop->last ? 'is-current' : '' }}" title="{{ $point['date'] }}: {{ number_format($point['count'], 0, ',', '.') }} pengunjung">
            <span class="visitor-bar-value">{{ number_format($point['count'], 0, ',', '.') }}</span>
            <span class="visitor-bar-fill" style="height: {{ round($point['count'] / $max * 100, 1) }}%"></span>
            <span class="visitor-bar-label">{{ $point['label'] }}</span>
        </div>
    @endforeach
</div>
