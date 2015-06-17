@extends('inspina.layouts.main')

@section('content')
                @include('inspina.partials.to_group_feed_nav')

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>All {{ $group->name  }} Events:</h5>
                            @if($group->isOwner(\Auth::user()))
                                <div class="ibox-tools">
                                    <a href="{{ url($group->username.'/events/create') }}" class="btn btn-primary btn-xs">Create new Event</a>
                                </div>
                            @endif
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <a href="{{ url($group->username . '/events') }}" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</a>
                                </div>
                                <form action="{{ url($group->username.'/events/search') }}" method="POST">
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="col-md-11">
                                        <div class="input-group"><input type="text" name="value" placeholder="Search By Event Title" class="input-sm form-control"> <span class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                    <div class="widget-head-color-box navy-bg p-lg text-center">
                                        <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            Alex Smith
                                        </h2>
                                            <small>Founder of Groupeq</small>
                                        </div>
                                        <img src="{{asset('inspina/img/a4.jpg')}}" class="img-circle circle-border m-b-md" alt="profile">
                                        <div>
                                            <span>100 Tweets</span> |
                                            <span>350 Following</span> |
                                            <span>610 Followers</span>
                                        </div>
                                    </div>
                                    <div class="widget-text-box">
                                        <h4 class="media-heading">Alex Smith</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <div class="text-right">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="widget-head-color-box navy-bg p-lg text-center">
                                        <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            Alex Smith
                                        </h2>
                                            <small>Founder of Groupeq</small>
                                        </div>
                                        <img src="{{asset('inspina/img/a4.jpg')}}" class="img-circle circle-border m-b-md" alt="profile">
                                        <div>
                                            <span>100 Tweets</span> |
                                            <span>350 Following</span> |
                                            <span>610 Followers</span>
                                        </div>
                                    </div>
                                    <div class="widget-text-box">
                                        <h4 class="media-heading">Alex Smith</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <div class="text-right">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="widget-head-color-box navy-bg p-lg text-center">
                                        <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            Alex Smith
                                        </h2>
                                            <small>Founder of Groupeq</small>
                                        </div>
                                        <img src="{{asset('inspina/img/a4.jpg')}}" class="img-circle circle-border m-b-md" alt="profile">
                                        <div>
                                            <span>100 Tweets</span> |
                                            <span>350 Following</span> |
                                            <span>610 Followers</span>
                                        </div>
                                    </div>
                                    <div class="widget-text-box">
                                        <h4 class="media-heading">Alex Smith</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <div class="text-right">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                    <div class="widget-head-color-box navy-bg p-lg text-center">
                                        <div class="m-b-md">
                                        <h2 class="font-bold no-margins">
                                            Alex Smith
                                        </h2>
                                            <small>Founder of Groupeq</small>
                                        </div>
                                        <img src="{{asset('inspina/img/a4.jpg')}}" class="img-circle circle-border m-b-md" alt="profile">
                                        <div>
                                            <span>100 Tweets</span> |
                                            <span>350 Following</span> |
                                            <span>610 Followers</span>
                                        </div>
                                    </div>
                                    <div class="widget-text-box">
                                        <h4 class="media-heading">Alex Smith</h4>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <div class="text-right">
                                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php echo $events->render() ?>
                        </div>


@endsection