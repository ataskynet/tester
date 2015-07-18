@extends('inspina.layouts.main')

@section('content')
    @include('inspina.partials.to_group_forums')
    <div class="ibox-content forum-post-container">
        <div class="forum-post-info">
            <h4><span class="text-navy"><i class="fa fa-comments"></i>  {{ $group->name }} Forums</span> - <span class="text-muted">{{ $forum->title }}</span></h4>
        </div>
        <br/>

    @if($messages->count() != 0)
     <div class="feed-activity-list">
        @foreach($messages as $message)
            <div class="feed-element">
                <a href="{{ url('profile/'.$message->user()->first()->id) }}" class="pull-left">
                   <img alt="image" class="img-circle" src="{{ asset($message->user()->first()->profileSource()) }}">
                </a>
                 <div class="media-body ">
                      <small class="pull-right"><i>{{ $message->created_at->diffForHumans() }}</i></small>
                      <strong>{{ $message->user()->first()->fullName() }}</strong><br>
                      <small class="text-muted">Posts: {{ $message->user()->first()->forumPostsof($forum)->count() }}</small>
                      <div class="well">
                           {!! nl2br($message->message) !!}
                      </div>
                 </div>
            </div>
        @endforeach
       </div>
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
                            <textarea class="form-control message-input" name="message" placeholder="Contribute to the conversation"></textarea>
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
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>
@endsection