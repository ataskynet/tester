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
                                        <li><a href="{{$group->username.'/contacts'}}"><i class="fa fa-group"></i> Members <i class="badge badge-default pull-right">{{ $group->followersCount() }}</i></a></li>

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
                                        <li><a href="{{'/manager/'.$group->username.'/'.$folder->id}}"><i class="fa fa-folder"></i> {{$folder->name}} <span class="badge badge-info pull-right">{{ $folder->files()->count() }}</span></a></li>
                                    @endforeach
                                    @else
                                        <li><b> <span align="center">No Folders for this group.</span></b></li>
                                    @endif
                                        <li><a href="{{ url('/share/'.$group->username) }}"><b><span align="center"> <i class="glyphicon glyphicon-share"></i> Shared <span class="badge badge-default pull-right">{{ $group->sharedFiles()->count() }}</span></span></b></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

