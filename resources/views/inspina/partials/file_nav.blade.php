 @include('inspina.partials.back_to_group_feed')

@if(isset($folder))
    @if($folder->isSubFolder())
         <div class="col-md-3 col-md-offset-2 col-xs-6">
               <a class="btn btn-sm btn-white" href="{{ url('manager/'.$group->username.'/'. $folder->folder_id.'/main/') }}"><i class="fa fa-level-up"></i> &nbsp; Up One Directory</a>
         </div>
    @endif
@endif
