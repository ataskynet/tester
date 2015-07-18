@include('inspina.partials.back_to_home')

@if($folder->isSubFolder())
     <div class="col-md-3 col-md-offset-2 col-xs-6">
          <a class="btn btn-sm btn-white" href="{{ url('pack', $folder->personal_folder_id) }}"><i class="fa fa-levelma-up"></i> &nbsp; Up One Directory</a>
     </div>
 @endif