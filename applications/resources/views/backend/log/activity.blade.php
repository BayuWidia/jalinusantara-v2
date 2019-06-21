@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>APP LOG <small>Log Activity</small></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                  <h2>
                      Daftar Log Activity Users
                  </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabelinfo">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Subject</th>
                                    <th style="text-align:center">Url</th>
                                    <th style="text-align:center">Method</th>
                                    <th style="text-align:center">IP</th>
                                    <th style="text-align:center">Agent</th>
                                    <th style="text-align:center">By</th>
                                    <th style="text-align:center">Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
          </div>
    </div>
    <!-- #END# Input -->

</div>
@endsection

@section('footscript')
<script src="{{asset('theme/js/pages/forms/basic-form-elements.js')}}"></script>

<script>
  $(document).ready(function() {
    $('#tabelinfo').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.log.activity') !!}',
        column: [
          {data: '0', name: 'subject'},
          {data: '1', name: 'url'},
          {data: '2', name: 'method'},
          {data: '3', name: 'ip'},
          {data: '4', name: 'agent'},
          {data: '5', name: 'created_by'},
          {data: '6', name: 'created_date'}
        ]
    });

  } );
</script>
@endsection
