<div class="col-md-3">
     <div class="ibox float-e-margins">
                            <div class="ibox-title ultra-skin" style="color: #ffffff;">
                                <h5>{{$group->name}}</h5>
                                <span class="badge badge-info pull-right">
                                    @if($group->type == 1)
                                        Private
                                    @else
                                        Public
                                    @endif
                                </span>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <a href="{{ url($group->username) }}">
                                        <img alt="image" class="img-preview" src="{{asset($group->profileSource())}}">
                                    </a>
                                </div>
                                <div class="ibox-content profile-content">
                                    <p align="center">
                                    {{ $group->description }}
                                    </p>
                                    <div class="user-button">

                                        @if($group->isOwner(\Auth::user()))
                                        <div class="row">
                                            <div class="col-md-5 col-md-offset-3" data-toggle="tooltip" data-placement="bottom" title="Updated group profile information." >
                                                <a href="{{ url($group->username . '/update') }}" class="btn btn-primary btn-sm btn-rounded"><i class="fa fa-edit"></i> Edit Profile</a>
                                            </div>
                                        </div>
                                        @else

                                        <p>Administrator:  <b> {{ $group->user()->first()->firstName }}  {{ $group->user()->first()->lastName }}</b></p>

                                        @endif
                                            <!--<div class="col-md-6">
                                                <a href="{{url('/profile/')}}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-"></i> Delete Group</a>
                                            </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                       @if($group->isOwner(\Auth::user()))
                           @if(!($group->isPublic()))
                                @include('inspina.partials.requests', ['user' => \Auth::user()])
                           @endif
                       @endif



</div>