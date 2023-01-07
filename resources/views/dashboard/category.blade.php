@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Kategori Produk</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
        <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
        <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
        <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
        <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
        <button class="btn btn-primary px-2" onClick="dataexport('print')">Print</button>
      </div>
      {{-- <button class="btn btn-primary me-auto me-md-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button> --}}
    </div>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Jumlah Produk</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $ct)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">{{ $ct->name }}  </td>
          <td style="min-width: 100px;"><span class="badge badge-primary">{{ count($ct->product) }}</span></td>
          {{-- <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $ct->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $ct->id }})"><i class="bi bi-x-lg"></i></a>
          </td> --}}
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!--end::Block-->
</div>
<!--end::Section-->



<script type="text/javascript">
  $(document).ready(function () {
    $('#tui').select2({  dropdownParent: $("#tambah")  });
    $('#eui').select2({  dropdownParent: $("#edit")  });
  });
  function edit(id){
    $.ajax({
      url: "/api/cooperation/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#eid").val(id);
        $("#eui").val(mydata.user_id);
        $("#enm").val(mydata.name);
        $("#esd").val(mydata.start_date);
        $("#eed").val(mydata.end_date);
        $("#eti").text("Edit "+mydata.name);
        $('#eui').select2({  dropdownParent: $("#edit")  });
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/cooperation/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#hi").val(id);
        $("#hd").text("Apakah anda yakin ingin menghapus "+mydata.name+"?");
      }
    });
  }
</script>
@endsection