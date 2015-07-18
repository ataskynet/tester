<div class="ibox float-e-margins">
    <div class="ibox-title blue-skin" style="color: #ffffff;">
    <b>
        {{ $user->fullName() }}'s Summary
    </b>
    </div>
                            <div class="ibox-content">
                                <div class="file-manager">

                                    <ul class="folder-list" style="padding: 0">
                                        <li><a href=""><i class="glyphicon glyphicon-pushpin"></i> Notices <i class="badge badge-default pull-right">{{ $user->notices()->get()->count() }}</i></a></li>
                                        <li><a href=""><i class="fa fa-bullhorn"></i> Forums Posts <i class="badge badge-default pull-right">{{ $user->forumPosts()->get()->count() }}</i></a></li>
                                        <li><a href=""><i class="fa fa-file"></i> Files <i class="badge badge-default pull-right">{{ $user->personalFiles()->get()->count() }}</i></a></li>
                                        <li data-toggle="tooltip" data-placement="bottom" title="{{ $user->fullName() }} groups"><a href=""><i class="fa fa-group"></i> Groups <i class="badge badge-default pull-right">{{ $user->followedGroups()->count() }}</i></a></li>


                                    </ul>
                                </div>
                            </div>
                        </div>