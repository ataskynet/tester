                     @if(!($group->isPublic()))
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="fa fa-inbox"></span> Member Requests
                            </div>
                            <div class="ibox-content">
                                <div class="">

                                    <ul class="folder-list" style="padding: 0">
                                    @if($group->sentRequests()->count() != 0)
                                    @foreach($group->sentRequests() as $request)
                                        <h4>{{$request->user()->fullName()}} &nbsp; &nbsp;<a href="{{ ($request->id.'/confirm/request/') }}"><i class="fa fa-check-circle"></i></a> &nbsp; &nbsp;<a href="{{ ($request->id.'/trash/request/') }}"><i class="fa fa-trash-o"></i></a></h4>
                                        <li></li>
                                    @endforeach
                                    @else
                                        <h3 align="center">No Requests have been sent.</h3>
                                        <li><a href=""> </a></li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                     @endif