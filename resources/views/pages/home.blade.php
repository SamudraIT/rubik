@extends('layouts.dashboard')

@section('content')
<div class="container my-4">
  <h1 class="mb-4">Dashboard</h1>

  <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 gap-2">
    <!-- Stats Widget 1 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">10</h5>
          <p class="card-text">Laporan Jentik</p>
        </div>
      </div>
    </div>

    <!-- Stats Widget 2 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <!-- Your stats widget content goes here -->
          <h5 class="card-title">10</h5>
          <p class="card-text">Laporan Kasus DBD</p>
        </div>
      </div>
    </div>

    <!-- Stats Widget 3 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <!-- Your stats widget content goes here -->
          <h5 class="card-title">10</h5>
          <p class="card-text">Jumlah Penghuni</p>
        </div>
      </div>
    </div>

    <!-- Stats Widget 4 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <!-- Your stats widget content goes here -->
          <h5 class="card-title">10</h5>
          <p class="card-text">Jumlah Fasilitas Umum</p>
        </div>
      </div>
    </div>

    <!-- Stats Widget 5 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <!-- Your stats widget content goes here -->
          <h5 class="card-title">10</h5>
          <p class="card-text">Angka Jentik</p>
        </div>
      </div>
    </div>

    <!-- Stats Widget 6 -->
    <div class="col mb-2">
      <div class="card">
        <div class="card-body">
          <!-- Your stats widget content goes here -->
          <h5 class="card-title">10</h5>
          <p class="card-text">Angka Bebas Jentik</p>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-4 row justify-content-center">
    <div class="col">
      <h1>{{ $chart1->options['chart_title'] }}</h1>
      {!! $chart1->renderHtml() !!}
    </div>
  </div>
</div>
@endsection

@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection
