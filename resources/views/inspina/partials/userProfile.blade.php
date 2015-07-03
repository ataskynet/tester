 <div class="ibox float-e-margins">
                        <div class="ibox-title blue-skin" style="color: #ffffff;">
                            <h5>Welcome, {{$user->firstName}} {{ $user->lastName }}</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <a href="{{ url('/profile/update') }}">
                                    <img alt="image" class="img-preview" src="{{asset($user->profileSource())}}">
                                </a>
                            </div>
                            <div class="ibox-content profile-content">

                                <div class="user-button">
                                        <div class="row">

                                            <div class="col-md-5 col-md-offset-3 col-xs-4 col-xs-offset-4" >
                                                <a href="{{ url('/groups/all') }}" class="btn btn-primary btn-sm btn-rounded" data-toggle="tooltip" data-placement="bottom" title="Join a new skoolspace group">Join New Group</a>
                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
@if($title != "Profile Update")
<div class="ibox float-e-margins">
    <div class="ibox-title blue-skin" style="color: #ffffff;" data-toggle="tooltip" data-placement="bottom" title="Your back-pack to share and store files.">
        <b>
            <i class="fa fa-briefcase" ></i> Back-Pack
        </b>
    </div>
                            <div class="ibox-content">
                                <div class="file-manager">
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" >New Folder</button>
                                    <div class="hr-line-dashed"></div>
                                    @include('inspina.pack.partials.createFolder')
                                    <h5>Pack Folders <small class="pull-right">Files</small></h5>
                                    <ul class="folder-list" style="padding: 0">
                                    @if(\Auth::user()->rootFolders()->count() != 0)
                                    @foreach(\Auth::user()->rootFolders() as $folder)
                                        <li><a href="{{url('/pack/'.$folder->id)}}"><i class="fa fa-folder"></i> {{$folder->name}} <span class="badge badge-info pull-right">{{ $folder->files()->count() }}</span></a></li>
                                    @endforeach
                                    @else
                                        <li><b> <h3 align="center">Your back pack is empty.</h3></b></li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
@endif