@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Transaksi</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
        <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
        <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
        <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
        <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
        <button class="btn btn-primary px-2 pe-3" data-bs-toggle="modal" data-bs-target="#cetak">Print</button>
      </div>
      @if(in_array("6", explode(",",$profil->previlege)))          
      <button class="btn btn-primary me-auto me-md-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
      @endif
    </div>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Nama User</th>
          <th>Penerimaan</th>
          <th>Peminjaman</th>
          <th>Tanggal transaksi</th>
          @if(in_array("6", explode(",",$profil->previlege)))  <th>Action</th> @endif
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $tr)
        @php
          $date = date_create($tr->date);
          //Set Price
          $rc = "Rp. ".number_format($tr->reception, 0, '.', '.');
          $ln = "Rp. ".number_format($tr->loan, 0, '.', '.');
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">{{ $tr->user->name }}  </td>
          <td style="min-width: 100px;"><span class="badge badge-success">{{ $rc }}</span></td>
          <td style="min-width: 100px;"><span class="badge badge-primary">{{ $ln }}</span></td>
          <td style="min-width: 130px;">{{ date_format($date,"d F Y") }}</td>
          @if(in_array("6", explode(",",$profil->previlege))) 
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $tr->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $tr->id }})"><i class="bi bi-x-lg"></i></a>
          </td>
          @endif
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
          <h3 class="modal-title">Tambah Transaksi</h3>
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
                <label class="required fw-bold mb-2">Tanggal transaksi</label>
                <input type="date" class="form-control form-control-solid" id="date" name="date" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Penerimaan</label>
                <input type="number" class="form-control form-control-solid" id="reception" name="reception" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Peminjaman</label>
                <input type="number" class="form-control form-control-solid" id="loan" name="loan" required>
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
          <h3 class="modal-title" id="eti">Edit Transaksi</h3>
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
                <label class="required fw-bold mb-2">Tanggal transaksi</label>
                <input type="date" class="form-control" id="edt" name="date" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Penerimaan</label>
                <input type="number" class="form-control form-control-solid" id="erc" name="reception" required>
              </div>
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Peminjaman</label>
                <input type="number" class="form-control" id="eln" name="loan" required>
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
          <h3 class="modal-title">Hapus Transaksi</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus transaksi ini?</label>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" name="submit" value="destroy">Delete</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="cetak">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Print Transaksi</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="required fw-bold mb-2">Pilih Karyawan</label>
                <select class="form-select form-select-solid" id="pui" name="user_id" tabindex="-1" aria-hidden="true" required>
                  <option value="">Semua</option>
                  @foreach ($users as $user)
                    @if (!empty($user->transaction[0]))
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onClick="printlaporan('transaction')">Print</button>
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
      url: "/api/transaction/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#eid").val(id);
        $("#eui").val(mydata.user_id);
        $("#erc").val(mydata.reception);
        $("#eln").val(mydata.loan);
        $("#edt").val(mydata.date);
        //$("#eti").text("Edit "+mydata.name);
        $('#eui').select2({  dropdownParent: $("#edit")  });
      }
    });
  }
  function hapus(id){
    $("#hi").val(id);
  }
</script>
@endsection