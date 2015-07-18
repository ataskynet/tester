 <div class="ibox float-e-margins">
                        <div class="ibox-title blue-skin" style="color: #ffffff;">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-preview" src="{{asset($user->profileSource())}}">
                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong>{{ $user->fullName() }}</strong></h4>
                                <strong>Contact Info.</strong><br>
                                {{ $user->email }}<br>
                                <abbr title="Phone">P:</abbr> {{ $user->telNumber }}<br/>
                                <br/>
                                <div class="user-button">
                                        <div class="row">

                                            <div class="col-md-5 col-md-offset-3 col-xs-4 col-xs-offset-4" >
                                                <a href="{{ url($user->id.'/visit/main/pack' ) }}" class="btn btn-primary btn-sm btn-rounded" data-toggle="tooltip" data-placement="bottom" title="View {{ $user->fullName() }} Back Pack">View Back Pack</a>
                                            </div>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
