                                     @if($statuses->count() != 0)
                                        @foreach($statuses as $status)

                                                <div class="feed-element">
                                                    <a href="{{$status->group()->first()->username}}" class="pull-left" data-toggle="tooltip" data-placement="left" title="{{ $status->group()->first()->name }}">
                                                        <img alt="image" class="img-circle" src="{{ asset($status->group()->first()->profileSource()) }}">
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">{{ $status->updated_at->diffForHumans() }}</small>
                                                        <a href="{{ url($status->url) }}">
                                                        <strong>{{ $status->group()->first()->name }}</strong><br>
                                                        </a>
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