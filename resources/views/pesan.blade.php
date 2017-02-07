@extends('app_user')
@section('content')

<script type="text/javascript">
  $(document).ready(function(){
    // $('#nomor_telepon').on('keyup',function(){
    //   var phone = $(this).val();
    //   alert(phone.replace("-",""));
    //   // $('#hidden_phone').val(phone);
    //   // alert($('#hidden_phone').val());
    // });
    $('#modal_form').submit(function(e){
      // formData = new FormData($('#modal_form')[0]);
      e.preventDefault();
      $.ajax({
        url: '{{url('pesan/store')}}',
        type: 'POST',
        data: $('#modal_form').serializeArray(),
        success:function(data){
          // if (data.success==true) {
            if (data.success==false) {
              alert(data.error_msg);
            }
            else{
              $('#p_id').html(' </p> <h3><b>SILAHKAN CEK EMAIL ANDA UNTUK MENGETAHUI NOMOR PESANAN</b></3> </p>');
              $('#no_pesanan').modal();
            }
          // }

          // else{
          //   console.log('fail');
          // }
        },
        error:function(){
          console.log('error');
        }
      });
    });
  });
</script>

<div class="example-modal">
<div>
        <div class="modal" id="no_pesanan">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Terimakasih sudah memesan :)</h4>
              </div>
              <div class="modal-body">
                <p id="p_id"></p>
              </div>
              <div class="modal-footer">
                <a href="{{ url('/') }}"><button type="button" class="btn btn-default pull-right">Close</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      </div>
      <!-- /.example-modal -->

            <div class="box-header with-border">
              <h3 class="box-title">Masukan Data Pemesanan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
            @endif<!-- 
            <form role="form" action="/pesan/store" method="POST" enctype="multipart/form-data"> -->
            <form id="modal_form" role="form" autocomplete="off">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pemesan</label>
                  <input name="nama" required="" class="form-control" id="exampleInputEmail1" placeholder="Nama" type="text" value="{{old('nama')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat</label>
                  <input name ="alamat" required="" class="form-control" id="exampleInputPassword1" placeholder="Alamat" type="text" value="{{old('alamat')}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nomor Telepon</label>
                  <input name="telp" class="form-control" id="nomor_telepon" required="" placeholder="Nomor Telepon" type="text" value="{{old('telp')}}" data-inputmask='"mask": "9999-9999-9999"' data-mask>
                  <input type="hidden" name="hidden_phone">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input name="email" required="" class="form-control" id="exampleInputEmail1" placeholder="email" type="email" value="{{old('email')}}">
                </div>
               <div class="form-group">
                <label>Tanggal</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="hari" required="" readonly="" id="datepicker" value="{{old('hari')}}">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
                <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Jam:</label>

                  <div class="input-group">
                    <input name="pukul" required="" readonly="" type="text" class="form-control timepicker" value="{{old('pukul')}}">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                </div>
                <!-- <div class="form-group">
                  <label for="exampleInputPassword1">Pukul</label>
                  <input name="pukul" class="form-control" id="exampleInputPassword1" placeholder="Pukul" type="text">
                </div>
                 -->
                <div class="form-group">
                  <label for="exampleInputFile">Masukan Gambar Tatto</label>
                  <input id="exampleInputFile" type="file" name="gambar_pesanan" required="">
                  <input type="hidden" name="image" id="image">
                  <input type="hidden" name="mime" id="mime">
                  <p class="help-block">Masukan gambar tatto yang anda inginkan</p>
                </div>
                

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <!-- <a href="#" class="btn btn-primary" data-target="#no_pesanan" data-toggle="modal">Submit</a> -->
              </div>
 
            </form>

            
@endsection