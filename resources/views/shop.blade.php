@extends('layouts.index')

@section('content')
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    
  </section><!-- End Breadcrumbs -->

  <!-- ======= Team Section ======= -->
  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-title">
        <p class="text-center">Katalog Produk</p>
      </div>

      <div class="row">

        @foreach ($products as $pr)
        @php
          $price = "Rp. ".number_format($pr->price, 0, '.', '.');
          $image = $pr->image;
          if (empty($image)) {$image="not-available.jpg";}
        @endphp
        <div class="col-lg-4 mt-4" >
          <div class="member d-flex align-items-start">
            <div class="pic">
              <img src="/assets/img/product/{{ $image }}" class="img-fluid" alt="" style="height: 140px; object-fit: cover">
            </div>
            <div class="member-info produk-info">
              <h5>{{$pr->name}}</h5>
              <h4>{{$price}}</h4>
              <hr>
              <button class="btn btn-danger" onclick="detail({{$pr->id}})" data-bs-toggle="modal" data-bs-target="#detail">Detail</button>
            </div>
          </div>
        </div>
        @endforeach

      </div>

    </div>
  </section><!-- End Team Section -->

  <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="detail" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dt">Detail produk</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-body">
            <div class="row">
              <div class="col-12 col-md-4 mb-3">
                <div class="img-hover" id="modal-imgbg">
                  <img class="col-12" id="pr-img" src="/assets/img/product/not-available.jpg">
                </div>
              </div>
              <div class="col">
                <h4 id="pr-name">Nama Produk</h4>
                <div class="alert alert-info">
                  <h2 id="pr-total" style="font-family: 'Poppins'">Rp 100.000</h2>
                  <div class="text-dark" id="pr-price">1 x Rp 100.000</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mt-3">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td class="align-top">Jumlah order</td>
                      <td class="ps-2 align-top">:</td>
                      <td class="ps-3 align-top">
                        <input type="number" class="form-control" id="pr-qty" min="1" max="5" style="height: 30px; width: 100px" value="1">
                      </td>
                    </tr>
                    <tr>
                      <td class="align-top">Saldo stock</td>
                      <td class="ps-2 align-top">:</td>
                      <td class="ps-3 align-top">
                        <span class="text-white bg-success p-1 rounded" id="pr-stock">40 PCS</span> Max Order
                      </td>
                    </tr>
                    <tr>
                      <td class="align-top" style="min-width: 150px">Diskripsi produk</td>
                      <td class="ps-2 align-top">:</td>
                      <td class="ps-3 align-top" id="pr-desc">-</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark" id="modal-tocart" onclick="buy()">
              <i class="fa fa-shopping-cart"></i> ke keranjang 
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    let stock =1;
    let price =0;
    let total =0;
    function detail(id){
    $.ajax({
      url: "/api/product/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(mydata) {
        total = mydata.price.toLocaleString('id-ID', {
          style: 'currency',
          currency: 'IDR',
        }).replace(',00','');
        stock = mydata.stock;
        price = mydata.price;
        if(mydata.image==''){mydata.image='not-available.jpg'}
        $("#pr-img").attr('src','/assets/img/product/'+mydata.image);
        $("#pr-name").text(mydata.name);
        $("#pr-total").text(total);
        $("#pr-price").text('1 x '+total);
        $("#pr-qty").val(1);
        $("#pr-qty").attr("max",mydata.stock);
        $("#pr-stock").text(mydata.stock+' PCS');
        $("#pr-desc").text(mydata.description);
      }
    });
  }
  $("#pr-qty").on('change', function () {
    if($(this).val()>stock){
      $(this).val(stock);
    }
    let qty = $("#pr-qty").val();
    total = (qty*price).toLocaleString('id-ID', {
      style: 'currency',
      currency: 'IDR',
    }).replace(',00','');
    price2 = price.toLocaleString('id-ID', {
      style: 'currency',
      currency: 'IDR',
    }).replace(',00','');
    $("#pr-price").text(qty+' x '+price2);
    $("#pr-total").text(total);
  });
  function buy(){
    let name = $("#pr-name").text();
    let phone = '6285234006051';
    let text = "Halo%20Admin%20PLPI%20Saya%20ingin%20membeli%20"+name+"%20sebanyak%20"+stock;
    let url = 'https://web.whatsapp.com/send?phone='+phone+'&text='+text;
    window.open(url, '_blank').focus();
  }
  </script>
  
@endsection