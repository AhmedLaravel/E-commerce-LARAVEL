
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_admin{{$id}}"><i class="fa fa-trash"></i></a></button>

<!-- Modal -->
<div id="delete_admin{{$id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('admin.delete_on_header')}}</h4>
      </div>
      	{{Form::open(['route'=>['users.destroy', $id], 'method' => 'DELETE'])}}
      <div class="modal-body">
        <p class="btn btn-danger">{{trans('admin.ask_delte', ['name'=>$name])}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{trans("admin.close")}}</button>
        {{Form::submit(trans('admin.delete_message'),['class'=>'btn btn-danger'])}}
        {{Form::close()}}
      </div>
    </div>

  </div>
</div>