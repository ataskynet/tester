                                     @if($statuses->count() != 0)
                                        @foreach($statuses as $status)

                                                <div class="feed-element">

                                                    <a href="{{ $status->url }}" class="pull-left" data-toggle="tooltip" data-placement="left" title="Linked to the related activity">
                                                    @if($status->user_id == 0)
                                                        <img alt="image" class="img-circle" src="{{ asset($status->group()->first()->profileSource()) }}">
                                                    @else
                                                        <img alt="image" class="img-circle" src="{{ asset($status->user()->first()->profileSource()) }}">
                                                    @endif
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">{{ $status->updated_at->diffForHumans() }}</small>

                                                        @if($status->user_id == 0)
                                                            <a href="{{ url($status->group()->first()->username) }}">
                                                                <strong>{{ $status->group()->first()->name }}</strong><br>
                                                            </a>
                                                        @else
                                                            <strong>
                                                            <a href="{{ url('profile/'.$status->user()->first()->id) }}">
                                                                {{ $status->user()->first()->fullName() }}
                                                            </a>
                                                            @
                                                            <a href="{{ url($status->group()->first()->username) }}">
                                                                  {{ $status->group()->first()->name }}
                                                            </a>
                                                            </strong><br/>
                                                        @endif


                                                        <a href="{{ url($status->url) }}">
                                                            <span class="text-muted">{{ $status->message }}</span>
                                                        </a>


                                                    </div>
                                                </div>

                                        @endforeach
                                     @else
                                        <div class="feed-element">
                                            <h2 align="center"> No Activities Recorded</h2>
                                            <br>
                                            <h4 align="center"class="muted text-center">
                                            Perhaps you should try out the skoolspace features :)
                                            </h4>
                                        </div>
                                     @endif