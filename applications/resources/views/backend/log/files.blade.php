@extends('backend.master.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>APP LOG <small>Log Files</small></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-orange">
                  <h2>
                      Daftar Log Files
                  </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabelinfo">
                            <thead>
                                <tr>
                                  <th style="text-align:center">#</th>
                                  <th style="text-align:center">File Name</th>
                                  <th style="text-align:center">Size</th>
                                  <th style="text-align:center">Time</th>
                                  <th style="text-align:center;width:12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @forelse($logFiles as $key => $logFile)
                               <tr>
                                   <td>{{ $key + 1 }}</td>
                                   <td>{{ $logFile->getFilename() }}</td>
                                   <td>{{ UtilHelper::bytesToHuman($logFile->getSize()) }}</td>
                                   <td>{{ date('Y-m-d H:i:s', $logFile->getMTime()) }}</td>
                                   <td class="tooltip-demo">
                                      <a target="_blank" href="{{ route('log.files.show', $logFile->getFilename()) }}" title="Show file {{ $logFile->getFilename() }}" class="btn btn-primary btn-circle waves-effect waves-circle waves-float"><i class="material-icons">location_searching</i></a>
                                      <a href="{{ route('log.files.download', $logFile->getFilename()) }}" title="Download file {{ $logFile->getFilename() }}" class="btn btn-success btn-circle waves-effect waves-circle waves-float"><i class="material-icons">file_download</i></a>
                                  </td>
                               </tr>
                               @empty
                               <tr>
                                   <td colspan="3">No Log File Exists</td>
                               </tr>
                               @endforelse
                           </tbody>
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

@endsection
