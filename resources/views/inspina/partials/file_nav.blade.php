@include('inspina.partials.back_to_group_feed')
@if($folder->isSubFolder())
     <div class="col-md-3 pull-left">
          <a class="btn btn-sm btn-white" href="{{ url('manager/'.$group->username.'/'. $folder->folder_id) }}"><i class="glyphicon glyphicon-arrow-up"></i> &nbsp; Up One Directory</a>
     </div>
 @endif