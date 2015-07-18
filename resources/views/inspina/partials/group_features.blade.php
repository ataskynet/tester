<div class="ibox float-e-margins">
    <div class="ibox-title ultra-skin" style="color: #ffffff;">
    <b>
        {{ $group->name }} Features:
    </b>
    </div>
                            <div class="ibox-content">
                                <div class="file-manager">

                                    <ul class="folder-list" style="padding: 0">
                                        <!--<li><a href="{{$group->username .'/events'}}"><i class="fa fa-calendar-o"></i> Events <i class="badge badge-default pull-right"> //$group->events()->get()->count() }}</i></a></li>-->
                                        <li><a href="{{$group->username.'/notice'}}"><i class="glyphicon glyphicon-pushpin"></i> Notices <i class="badge badge-default pull-right">{{ $group->notices()->get()->count() }}</i></a></li>
                                        <li><a href="{{$group->username.'/forums'}}"><i class="fa fa-comments-o"></i> Forums <i class="badge badge-default pull-right">{{ $group->forums()->get()->count() }}</i></a></li>
                                        <li data-toggle="tooltip" data-placement="bottom" title="View group members and their information."><a href="{{$group->username.'/contacts'}}"><i class="fa fa-group"></i> Members <i class="badge badge-default pull-right">{{ $group->followersCount() }}</i></a></li>
                                       <!--
                                        @if($group->isOwner(\Auth::user()))
                                            <li data-toggle="tooltip" data-placement="bottom" title="View and manage group supervisors."><a href="{{$group->username.'/administrators'}}"><i class="fa fa-gavel"></i> Supervisors <i class="badge badge-primary pull-right" style="color: #ffffff">{{ $group->administrators()->get()->count() }}</i></a></li>
                                        @else
                                            <li data-toggle="tooltip" data-placement="bottom" title="View group supervisors and their information."><a href="{{$group->username.'/administrators/all'}}"><i class="fa fa-gavel"></i> Supervisors <i class="badge badge-info pull-right" style="color: #ffffff">{{ $group->administrators()->get()->count() }}</i></a></li>
                                        @endif
                                        -->

                                    </ul>
                                </div>
                            </div>
                        </div>

<div class="ibox float-e-margins">
    <div class="ibox-title ultra-skin" style="color: #ffffff;">
        <b>
            File Manager
        </b>
    </div>
                            <div class="ibox-content">
                                <div class="file-manager">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">New Folder</button>
                                    <div class="hr-line-dashed"></div>
                                    @include('inspina.file.partials.createFolder')
                                    <h5>Group Folder <small class="pull-right">Files</small></h5>
                                    <ul class="folder-list" style="padding: 0">
                                    @if($group->folders()->get()->count() != 0)
                                    @foreach($group->mainFolders() as $folder)
                                        <li><a href="{{'/manager/'.$group->username.'/'.$folder->id.'/main/'}}"><i class="fa fa-folder"></i> {{$folder->name}} <span class="badge badge-info pull-right">{{ $folder->files()->count() }}</span></a></li>
                                    @endforeach
                                    @else
                                        <li><b> <span align="center">No Folders for this group.</span></b></li>
                                    @endif
                                        <li><a href="{{ url('/share/'.$group->username) }}"><b><span align="center"> <i class="glyphicon glyphicon-share"></i> Shared <span class="badge badge-default pull-right">{{ $group->sharedFiles()->count() }}</span></span></b></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

