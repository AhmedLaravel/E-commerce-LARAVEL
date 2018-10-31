@extends('admin.index')
@section('content')
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{Form::open(['id'=>'form_data', 'url' =>aurl('users/destory/all'), 'method' => 'DELETE'])}}
                {!! $dataTable->table(['class'=>' dataTable table table-striped table-bordered table-hover'], true) !!}
                {{Form::close()}}
              
            </div> 
          </div>
        </div>
      </div>
    </section>

<!-- Modal -->
<div id="myModal" class="modal fade multipleDelete" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('admin.delete_all.')}}</h4>
      </div>
      <div class="modal-body">
        <div class="empty_records hidden">
          <h1 class="alert alert-danger CheckRecords">{{trans('admin.please_check_all_records')}}</h1>
        </div>
        <div class="no_empty_records hidden">
          <h1 class="alert alert-danger">{{trans('admin.delete_all_massege')}}<span class="countRecord"></span>{{" "}}?</h1>
      </div>
        
      </div>
      <div class="modal-footer">
        <div class="empty_records hidden">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans("admin.close")}}</button>
          <br><br>         
        </div>
        <div class="no_empty_records hidden" >
          <input type="submit" name="delete_all" onsubmit="" class="btn btn-danger delete_all" value="{{trans('admin.delete_message')}}">
         <button type="button" class="btn btn-default" data-dismiss="modal">{{trans("admin.no")}}</button>
        </div>
      </div>
    </div>

  </div>
</div>
    @push('js')
    <script type="text/javascript">
      delete_all()
    </script>
       {!! $dataTable->scripts() !!}
    @endpush
@endsection