@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>FORM KELOLA PARTICIPANS</h2>
    </div>
    <div class="row clearfix">
        <div class="col-md-12">
          @if(Session::has('messagefail'))
          <div class="alert bg-pink alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4><i class="icon fa fa-ban"></i> Oops, terjadi kesalahan!</h4>
              <p>{{ Session::get('messagefail') }}</p>
            </div>
          @endif
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                  <h2>
                      Tambah Participans Jalinusantara
                  </h2>
                </div>
                <div class="body">
                  <form action="{{route('participans.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Events</label>
                                    @if ($errors->has('eventsId'))
                                      <small style="color:red">* {{$errors->first('eventsId')}}</small>
                                    @endif
                                    <select name="eventsId" class="form-control" style="width: 100%;">
                                      <option value="">-- Pilih --</option>
                                      @foreach($getDataEvents as $key)
                                        <option value="{{ $key->id }}" {{ old('eventsId') == $key->id ? 'selected=""' : ''}}>{{ $key->nama_kategori }} - {{ $key->judul_event }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Nomor Pintu</label>
                                    @if ($errors->has('fasilitator'))
                                      <small style="color:red">* {{$errors->first('nomorPintu')}}</small>
                                    @endif
                                    <input type="text" class="form-control" value="{{ old('nomorPintu') }}" placeholder="Ketikkan Nomor Pintu..." name="nomorPintu" id="nomorPintu"/>
                                </div>
                            </div>
                            <div class="form-group mandatory">
                                <div class="form-line">
                                    <label>Upload File Participans</label>
                                    @if ($errors->has('urlFile'))
                                      <small style="color:red">* {{$errors->first('urlFile')}}</small>
                                    @endif
                                    <input type="file" name="urlFile" class="form-control" value="{{ old('urlFile') }}" >
                                </div>
                                <div>
                                  <span class="text-muted"><i>* Form harus berbentuk Pdf, Excel atau Word.</i></span>
                                </div>
                            </div>
                            <table class="table" id="itemList">
                              <thead>
                                  <tr>
                                      <th width="3%">#</th>
                                      <th>Nama</th>
                                      <th>Posisi</th>
                                      <th>Pax</th>
                                      <th>Mobil</th>
                                      <th>Nomor Polisi</th>
                                      <th>Telephone</th>
                                      <th>Ukuran Baju</th>
                                      <th>Bahan Bakar</th>
                                      <th width="3%">
                                        <button type ="button" name="addItem" id="addItem" class="btn btn-success btn-sm">
                                          Tambah</button></th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                            <hr>

                            <button type="submit" class="btn pull-right btn-primary">Simpan Data</button>
                            <button type="reset" class="btn btn-danger">Reset Formulir</button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
    </div>
    <!-- #END# Input -->

</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/forms/basic-form-elements.js')}}"></script>

<!-- Ckeditor -->
<script src="{{asset('theme/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- TinyMCE -->
<script src="{{asset('theme/plugins/tinymce/tinymce.js')}}"></script>

<script src="{{asset('theme/js/pages/forms/editors.js')}}"></script>

<script>
  $(document).ready(function() {

  });

  $("#addItem").click(function () {
        var totalRow = $('#itemList tr').length - 1;
        var html = '';
        html += '<tr class="rowData">';
        html += '<td>'+totalRow+'</td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="nama'+totalRow+'" type="text" class="form-control nama" name="data_item['+totalRow+'][nama]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="posisi'+totalRow+'" type="text" class="form-control posisi" name="data_item['+totalRow+'][posisi]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="pax'+totalRow+'" type="text" class="form-control pax" name="data_item['+totalRow+'][pax]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="mobil'+totalRow+'" type="text" class="form-control mobil" name="data_item['+totalRow+'][mobil]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="nomorPolisi'+totalRow+'" type="text" class="form-control nomorPolisi" name="data_item['+totalRow+'][nomorPolisi]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="telephone'+totalRow+'" type="text" class="form-control telephone" name="data_item['+totalRow+'][telephone]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="ukuranBaju'+totalRow+'" type="text" class="form-control ukuranBaju" name="data_item['+totalRow+'][ukuranBaju]"></div></div></td>';
        html += '<td><div class="form-group mandatory"><div class="form-line"><input id="bahanBakar'+totalRow+'" type="text" class="form-control bahanBakar" name="data_item['+totalRow+'][bahanBakar]"></div></div></td>';
        html += '<td><button type="button" name="removeItem" class="btn btn-danger btn-sm removeItem">Hapus</button></td>';
        html += '</tr>';
        $('#itemList tbody').append(html);
        refreshTableNumber();

  });

  $(document).on('click', '.removeItem', function () {
      $(this).closest('tr').remove();
      refreshTableNumber();
  });

  function refreshTableNumber() {
      $('#itemList tbody tr').each(function (idx) {
          $(this).children("td:eq(0)").html(idx + 1);
      });
  };
</script>

@endsection
