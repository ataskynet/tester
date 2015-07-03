@extends('inspina.layouts.main')

@section('content')
                    <!-- Content starts here -->
                    <div class="wrapper wrapper-content" style="padding-right: 0px; padding-top: 0px;">
                        <div class="row">
                       @include('inspina.partials.back_to_group_feed')
                        </div>
                        <br>
                        @include('inspina.partials.error')
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <div class="file-manager">

                                            <h5><i class="fa fa-users"></i> Supervisors </h5>
                                            <div class="hr-line-dashed"></div>
                                            <ul class="folder-list" style="padding: 0">
                                            @if($supervisors->count() != 0)
                                            @foreach($supervisors as $supervisor)
                                                <h5>{{$supervisor->fullName()}} &nbsp; &nbsp;
                                                <a href="{{ url($group->username . '/' .$supervisor->id .'/main'. '/visit/pack/ ') }}"><i class="fa fa-briefcase pull-right"></i></a>
                                                </h5>
                                                <li></li>
                                            @endforeach
                                            @else
                                                <li><b> <span align="center">No administrators registered for this group.</span></b></li>
                                            @endif
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 animated fadeInRight">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row m-b-sm m-t-sm">
                                            <div class="col-md-1">
                                                <a href="{{ url($group->username . '/administrators') }}" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</a>
                                            </div>
                                            <form action="{{ url($group->username.'/administrators/search') }}" method="POST">
                                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="col-md-11">
                                                    <div class="input-group"><input type="text" name="value" placeholder="Search By User Name" class="input-sm form-control"> <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                                </div>
                                            </form>
                                        </div>
                            @if($members->count() != 0)
                                @foreach($members as $member)
                                        <div class="col-lg-6">
                                            <div class="contact-box" style="overflow: auto">

                                                <div class="col-sm-4">
                                                    <div class="text-center">
                                                        <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ asset($member->profileSource()) }}">
                                                         <br/>
                                                         @if(!$group->isSupervisedBy($member))
                                                            <a href="{{ url($group->username . "/administrators/add/". $member->id) }}" class="btn btn-sm btn-rounded btn-primary" style="color: #ffffff">+ Add</a>
                                                         @else
                                                            <a href="{{ url($group->username . "/administrators/delete/". $member->id) }}" class="btn btn-sm btn-rounded btn-danger" style="color: #ffffff">Remove</a>
                                                         @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h3><strong>{{ $member->fullName() }}</strong></h3>
                                                    <p><i class="glyphicon glyphicon-pushpin"></i> {{ $member->notices()->get()->count() }} &nbsp; &nbsp;  <i class="fa fa-folder-open"></i> {{ $member->personalFiles()->get()->count() }}</p>
                                                    <address>
                                                        <strong>Contact Info.</strong><br>
                                                       {{ $member->email }}<br>
                                                        <abbr title="Phone">P:</abbr> {{ $member->telNumber }}
                                                    </address>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <br>


                                @else
                                    <div class="middle-box text-center animated fadeInRightBig">
                                        <h3 class="font-bold">No user found</h3>
                                            <div class="error-desc">
                                                Check if you have the correct name for the user your are searching for, Enjoy skoolspace.
                                                <br><a href="{{ $group->username }}" class="btn btn-primary m-t">Group Feed</a>
                                            </div>
                                    </div>
                                @endif
                                    </div>
                                </div>
                                </div>
                              <div class=" row col-md-12 text-center">
                                   <?php echo $members->render() ?>
                              </div>
                            </div>
                            </div>
                    <!-- Content ends Here! -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.contact-box').each(function() {
                animationHover(this, 'pulse');
            });
        });
    </script>
@endsection