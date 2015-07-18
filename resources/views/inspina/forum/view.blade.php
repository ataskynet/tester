@extends('inspina.layouts.main')

@section('content')
    @include('inspina.partials.to_group_forums')
    <div class="ibox-content forum-post-container">
        <div class="forum-post-info">
            <h4><span class="text-navy"><i class="fa fa-comments"></i>  {{ $group->name }} Forums</span> - <span class="text-muted">{{ $forum->title }}</span></h4>
        </div>
    @if($messages->count() != 0)
        @foreach($messages as $message)
        <div class="media">
            <a class="forum-avatar" href="{{ url('profile/'.$message->user()->first()->id) }}">
                <img src="{{ asset($message->user()->first()->profileSource()) }}" class="img-circle" alt="image">
                <div class="author-info">
                    <strong>Posts: </strong>{{ $message->user()->first()->forumPostsof($forum)->count() }}<br/>
                    {{ $message->created_at->diffForHumans() }}
                </div>
            </a>
            <div class="media-body">

                {!! nl2br($message->message) !!}
                <br>
                <br>

                - {{ $message->user()->first()->fullName() }}
                <br/>
                <br/>
            </div>
        </div>
        @endforeach
    @else
        <div class="media">
            <h2 align="center"> No contributions made to this forum yet, feel free to contribute. </h2>
        </div>
    @endif
        <form action="{{ url($group->username . '/forums/'. $forum->id) }}" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="chat-message-form">

                        <div class="form-group">
                            <textarea class="form-control message-input" name="message" placeholder="Enter message text"></textarea>
                        </div>

                    </div>
                </div>
            </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="chat-message-form">
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-md btn-primary" value="Post to Forum" />
                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>
@endsection