@extends('layouts.print')

@section('content')
<div class="m-5">
  <table id="myTable2" class="table table-bordered border gs-7" style="font-size: 13px">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
        <th>No</th>
        <th>Nama</th>
        <th>Nama Sertifikasi</th>
        <th>Lokasi</th>
        <th>Tanggal selesai</th>
      </tr>
    </thead>
    <tbody>
      @foreach($certifications as $cert)
      @php
        $months = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $issue_date = date_create($cert->issue_date);
      @endphp
      <tr>
        <td style="width: 12px" class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $cert->user->name }}</td>
        <td style="width: 200px">{{ $cert->name }}</td>
        <td style="width: 100px" class="text-center">{{ $cert->location }}</td>
        <td style="width: 150px">
          {{date_format($issue_date,"d")}} {{$months[intval(date_format($issue_date,"m"))]}} {{date_format($issue_date,"Y")}}
        </td>
      </tr>
      @endforeach
      <tr class="d-none"></tr>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  
</script>
@endsection