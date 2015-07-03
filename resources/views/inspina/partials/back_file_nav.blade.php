<a class="btn btn-sm btn-info pull-left" href="{{ url($group->username, 'contacts') }}"><i class="glyphicon glyphicon-arrow-left"></i> Back To Members</a>

@if(isset($folder))

@endif

@if(isset($documents))
    @if($folder->isSubFolder())
        <div class="col-md-3 col-md-offset-2 col-xs-6">
             <a class="btn btn-sm btn-white" href="{{ url($group->username . '/' .$user->id . '/' .$folder->personal_folder_id. '/visit/pack/ ') }}"><i class="glyphicon glyphicon-arrow-up"></i> &nbsp; Up One Directory</a>
        </div>
    @else
        <div class="col-md-3 col-md-offset-2 col-xs-6">
             <a class="btn btn-sm btn-white" href="{{ url($group->username . '/' .$user->id . '/main' . '/visit/pack/ ') }}"><i class="glyphicon glyphicon-arrow-up"></i> &nbsp; Up One Directory</a>
        </div>
    @endif
@endif
