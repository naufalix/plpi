@extends('layouts.print')

@section('content')
<div class="m-5">
  <table id="myTable2" class="table table-bordered border gs-7" style="font-size: 13px">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Tanggal selesai</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      @php
        $months = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $end_date = date_create($user->end_date);
      @endphp
      <tr>
        <td style="width: 12px" class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td style="width: 120px">{{ $user->phone }}</td>
        <td style="width: 150px">
          {{date_format($end_date,"d")}} {{$months[intval(date_format($end_date,"m"))]}} {{date_format($end_date,"Y")}}
        </td>
        <td style="width: 100px" class="text-center">{{ $user->status }}</td>
      </tr>
      @endforeach
      <tr class="d-none"></tr>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  
</script>
@endsection