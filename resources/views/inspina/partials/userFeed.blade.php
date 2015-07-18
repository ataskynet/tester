                                     @if($statuses->count() != 0)
                                        @foreach($statuses as $status)

                                                <div class="feed-element">
                                                @if($status->group()->first()->isFollowedBy(\Auth::user()))
                                                    <a href="{{ url($status->url) }}" class="pull-left" data-toggle="tooltip" data-placement="left" title="Linked to the related activity.">
                                                        <img alt="image" class="img-circle" src="{{ asset($status->user()->first()->profileSource()) }}">
                                                    </a>
                                                @else
                                                        <img alt="image" class="img-circle" src="{{ asset($status->user()->first()->profileSource()) }}">
                                                @endif
                                                    <div class="media-body ">
                                                        <small class="pull-right">{{ $status->updated_at->diffForHumans() }}</small>
                                                        <strong>

                                                        <a href="{{ url('/profile/'.$user->id) }}">
                                                            {{ $status->user()->first()->fullName() }}
                                                        </a>


                                                        @
                                                    @if($status->group()->first()->isFollowedBy(\Auth::user()))
                                                        <a href="{{ url($status->group()->first()->username) }}">
                                                              {{ $status->group()->first()->name }}
                                                        </a>
                                                    @else
                                                            {{ $status->group()->first()->name }}
                                                    @endif
                                                        </strong><br/>


                                                    @if($status->group()->first()->isFollowedBy(\Auth::user()))
                                                        <a href="{{ url($status->url) }}">
                                                            <span class="text-muted">{{ $status->message }}</span>
                                                        </a>
                                                    @else
                                                            <span class="text-muted">{{ $status->message }}</span>
                                                    @endif


                                                    </div>
                                                </div>

                                        @endforeach
                                     @else
                                        <div class="feed-element">
                                            <h2 align="center"> {{ $user->fullName() }} has no activities yet.</h2>
                                        </div>
                                     @endif