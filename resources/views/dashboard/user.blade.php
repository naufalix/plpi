@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 d-flex">
    <h1 class="anchor fw-bolder mb-5" id="striped-rounded-bordered">Data User</h1>
    <button class="ms-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah User</button>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($users as $user) {
            $photo       = $user->photo;
            if (empty($photo)) {$photo="default.png";}
        ?>
        <tr>
          <td>{{ $user->id }}</td>
          <td style="min-width: 320px;">
            <div class="symbol symbol-30px me-5">
              <img src="/assets/img/user/{{ $photo }}" class="h-30 align-self-center of-cover rounded-circle" alt="">
            </div>
            {{ $user->name }}  
          </td>
          <td>{{ $user->email }}</td>
          <td style="min-width: 100px;">
            <span class="badge badge-primary">{{ $user->role }}</span>
          </td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $user->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#foto" onclick="foto({{ $user->id }})"><i class="bi bi-image-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $user->id }})"><i class="bi bi-x-lg"></i></a>
          </td>
        </tr>
        <?php } ?>
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
          <h3 class="modal-title">Tambah User</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-6">
                <label class="required fw-bold mb-2">Nama</label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" required>
              </div>
              <div class="col-6 col-md-3">
                <label class="required fw-bold mb-2">Role</label>
                <select class="form-select form-select-solid" name="role" tabindex="-1" aria-hidden="true" required>
                  <option value="admin">Admin</option>
                  <option value="superadmin">Superadmin</option>
                  <option value="user">User</option>
                </select>
              </div>
              <div class="col-6 col-md-3">
                <label class="required fw-bold mb-2">Provinsi</label>
                <select class="form-select form-select-solid" id="tpv" name="province_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($provinces as $province)
                    <option value='{{$province->id}}'>{{ucwords(strtolower($province->name))}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-4">
                <label class="required fw-bold mb-2">Username</label>
                <input type="text" class="form-control form-control-solid" id="username" name="username" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="fw-bold mb-2">Email</label>
                <input type="email" class="form-control form-control-solid" id="email" name="email" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="fw-bold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid" id="password" name="password" required>
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
          <h3 class="modal-title" id="eti">Edit User</h3>
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
                <label class="required fw-bold mb-2">Nama</label>
                <input type="text" class="form-control form-control-solid" id="enm" name="name" required>
              </div>
              <div class="col-6 col-md-3">
                <label class="required fw-bold mb-2">Role</label>
                <select class="form-select form-select-solid" id="erl" name="role" tabindex="-1" aria-hidden="true" required>
                  <option value="admin">Admin</option>
                  <option value="superadmin">Superadmin</option>
                  <option value="user">User</option>
                </select>
              </div>
              <div class="col-6 col-md-3">
                <label class="required fw-bold mb-2">Provinsi</label>
                <select class="form-select form-select-solid" id="epv" name="province_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($provinces as $province)
                    <option value='{{$province->id}}'>{{ucwords(strtolower($province->name))}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-3">
                <label class="required fw-bold mb-2">Username</label>
                <input type="text" class="form-control form-control-solid" id="eun" name="username" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="fw-bold mb-2">Email</label>
                <input type="email" class="form-control form-control-solid" id="eml" name="email" required>
              </div>
              <div class="col-12 col-md-5">
                <label class="fw-bold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid" id="eps" name="password">
                <small class="text-danger">Kosongkan jika tidak ingin mengganti password</small>
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

<div class="modal fade" tabindex="-1" id="foto">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="pt">Edit Foto</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="pi" name="id">
            <div class="row g-9 mb-8">
              <div class="">
                <label class="required fw-bold mb-2">Upload logo</label>
                <input type="file" class="form-control" name="photo" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="photo">Save</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="hapus">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Hapus User</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus user ini?</label>
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
    $('#tpv').select2({  dropdownParent: $("#tambah")  });
    $('#epv').select2({  dropdownParent: $("#edit")  });
  });
  function edit(id){
    $.ajax({
      url: "/api/user/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#eid").val(id);
        $("#enm").val(mydata.name);
        $("#erl").val(mydata.role);
        $("#epv").val(mydata.province_id);
        $("#eun").val(mydata.username);
        $("#eml").val(mydata.email);
        $("#eps").val("");
        $("#eti").text("Edit "+mydata.name);
        $('#epv').select2({  dropdownParent: $("#edit")  });
      }
    });
  }
  function foto(id){
    $.ajax({
      url: "/api/user/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#pi").val(id);
        $("#pt").text("Edit foto "+mydata.name);
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/user/"+id,
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