@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Produk</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
        <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
        <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
        <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
        <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
        <button class="btn btn-primary px-2" onClick="dataexport('print')">Print</button>
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
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Stok</th>
          @if(in_array("6", explode(",",$profil->previlege)))  <th>Action</th> @endif
        </tr>
      </thead>
      <tbody>
        @foreach($products as $pr)
        @php
          $price = "Rp. ".number_format($pr->price, 0, '.', '.');
          $image = $pr->image;
          if (empty($image)) {$image="not-available.jpg";}
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          {{-- <td style="min-width: 320px;">{{ $pr->name }}</td> --}}
          <td style="min-width: 320px;">
            <div class="symbol symbol-30px me-5">
              <img src="/assets/img/product/{{ $image }}" class="h-30 align-self-center of-cover" alt="">
            </div>
            {{ $pr->name }}  
          </td>
          <td style="min-width: 100px;">{{ $pr->category->name }}</td>
          <td><span class="badge badge-primary">{{ $price }}</span></td>
          <td><span class="badge badge-success">{{ $pr->stock }}</span></td>
          @if(in_array("6", explode(",",$profil->previlege))) 
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $pr->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#foto" onclick="foto({{ $pr->id }})"><i class="bi bi-image-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $pr->id }})"><i class="bi bi-x-lg"></i></a>
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
          <h3 class="modal-title">Tambah Produk</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-8">
                <label class="required fw-bold mb-2">Nama Produk</label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="required fw-bold mb-2">Kategori</label>
                <select class="form-select form-select-solid" id="tci" name="category_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($categories as $ct)
                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Harga</label>
                <input type="number" class="form-control form-control-solid" id="price" name="price" required>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Jumlah Stok</label>
                <input type="number" class="form-control form-control-solid" id="stock" name="stock" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="required fw-bold mb-2">Deskripsi</label>
                <textarea class="form-control form-control-solid" name="description" rows="7" required></textarea>
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
          <h3 class="modal-title" id="eti">Edit Produk</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-8">
                <label class="required fw-bold mb-2">Nama Produk</label>
                <input type="text" class="form-control form-control-solid" id="enm" name="name" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="required fw-bold mb-2">Kategori</label>
                <select class="form-select form-select-solid" id="eci" name="category_id" tabindex="-1" aria-hidden="true" required>
                  @foreach ($categories as $ct)
                    <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Harga</label>
                <input type="number" class="form-control form-control-solid" id="epr" name="price" required>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Jumlah Stok</label>
                <input type="number" class="form-control form-control-solid" id="est" name="stock" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="required fw-bold mb-2">Deskripsi</label>
                <textarea class="form-control form-control-solid" id="ede" name="description" rows="7" required></textarea>
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
          <h3 class="modal-title" id="pt">Edit Foto Produk</h3>
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
                <label class="required fw-bold mb-2">Upload foto</label>
                <input type="file" class="form-control" name="image" required>
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
          <h3 class="modal-title">Hapus Produk</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus sertifikasi ini?</label>
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
    $('#tci').select2({  dropdownParent: $("#tambah")  });
    $('#eci').select2({  dropdownParent: $("#edit")  });
  });
  function edit(id){
    $.ajax({
      url: "/api/product/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        $("#eid").val(id);
        $("#enm").val(mydata.name);
        $("#eci").val(mydata.category_id);
        $("#epr").val(mydata.price);
        $("#est").val(mydata.stock);
        $("#ede").val(mydata.description);
        $("#eti").text("Edit "+mydata.name);
        $('#eci').select2({  dropdownParent: $("#edit")  });
      }
    });
  }
  function foto(id){
    $.ajax({
      url: "/api/product/"+id,
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
      url: "/api/product/"+id,
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