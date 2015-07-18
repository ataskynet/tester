@extends('inspina.layouts.main')

@section('content')
    @include('inspina.partials.to_group_feed_nav')
    <div class="ibox-content m-b-sm border-bottom">
        <div class="p-xs">
            <div class="pull-left m-r-md">
                <i class="glyphicon glyphicon-comment text-navy mid-icon"></i>
            </div>
            <h2>Welcome to {{ $title }}</h2>
            <span>Feel free to share or enquire on anything and everything.</span>
        </div>
    </div>

    <div class="ibox-content forum-container">
        <div class="forum-title">
        @include('inspina.forum.partials.createForum')
            <div class="pull-right forum-desc">
                <samll><a href="" data-toggle="modal" data-target="#createForum" class="btn btn-white">+ New Forum</a></samll>
            </div>
            <h3>All {{ $title }}</h3>
        </div>
    @if($forums->count() != 0)
        @foreach($forums as $forum)
            <div class="forum-item active">
                <div class="row">
                    <div class="col-md-9">
                        <div class="forum-icon">
                            <i class="fa fa-comments-o"></i>
                        </div>
                        <a href="{{ url('/'. $group->username.'/forums/'.$forum->id) }}" class="forum-item-title">{{ $forum->title }}</a>
                        <div class="forum-sub-title"><b>Created By: </b>{{$forum->user()->first()->fullName() }}.</div>
                    </div>
                    <div class="col-md-2 pull-right forum-info">
                        <span class="views-number"> {{ $forum->posts()->get()->count() }} </span>
                        <div>
                            <small>Posts</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else

        <div class="forum-item">
            <h2 align="center"> No Forums have been created yet, but feel free to create one</h2>
        </div>
    @endif

        <div align="center">
            <?php echo $forums->render() ?>
        </div>
    </div>
@endsection