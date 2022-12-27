@extends('layouts.print')

@section('content')
<div class="m-5">
  <table id="myTable2" class="table table-bordered border gs-7" style="font-size: 13px">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
        <th>No</th>
        <th>Nama</th>
        <th>Penerimaan</th>
        <th>Peminjaman</th>
        <th>Tanggal transaksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($transactions as $tr)
      @php
        $months = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $date = date_create($tr->date);
        //Set Price
        $rc = "Rp. ".number_format($tr->reception, 0, '.', '.');
        $ln = "Rp. ".number_format($tr->loan, 0, '.', '.');
      @endphp
      <tr>
        <td style="width: 12px" class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $tr->user->name }}</td>
        <td style="width: 100px" class="text-center">{{ $rc }}</td>
        <td style="width: 100px" class="text-center">{{ $ln }}</td>
        <td style="width: 150px">
          {{date_format($date,"d")}} {{$months[intval(date_format($date,"m"))]}} {{date_format($date,"Y")}}
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