@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 d-flex">
    <h1 class="anchor fw-bolder mb-5" id="striped-rounded-bordered">Data Kerjasama</h1>
    <button class="ms-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah kerjasama</button>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Nama User</th>
          <th>Nama kerjasama</th>
          <th>Tanggal mulai</th>
          <th>Tanggal selesai</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cooperations as $co)
        @php
          $start_date = date_create($co->start_date);
          $end_date = date_create($co->end_date);
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">{{ $co->user->name }}  </td>
          <td style="min-width: 100px;"><span class="badge badge-primary">{{ $co->name }}</span></td>
          <td>{{ date_format($start_date,"d F Y") }}</td>
          <td>{{ date_format($end_date,"d F Y") }}</td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $co->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $co->id }})"><i class="bi bi-x-lg"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!--end::Block-->
</div>
<!--end::Section-->

<div class="modal fade" tabindex="-1" id="tambah">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Kerjasama</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama User</label>
                <select class="form-select form-select-solid" id="tui" name="user_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama kerjasama</label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Tanggal mulai</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Tanggal selesai</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="store">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="edit">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="eti">Edit Kerjasama</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama User</label>
                <select class="form-select form-select-solid" id="eui" name="user_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama kerjasama</label>
                <input type="text" class="form-control form-control-solid" id="enm" name="name" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Tanggal mulai</label>
                <input type="date" class="form-control" id="esd" name="start_date" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Tanggal selesai</label>
                <input type="date" class="form-control" id="eed" name="end_date" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="update">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="hapus">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Hapus Kerjasama</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus kerjasama ini?</label>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" name="submit" value="destroy">Delete</button>
          </div>
        </form>
      </div>
  </div>
</div>

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