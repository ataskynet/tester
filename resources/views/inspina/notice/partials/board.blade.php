<ul class="notes">
    @foreach($notices as $notice)
        <li>
            <div style="overflow: auto">
                <small>{{$notice->updated_at->diffForHumans()}}</small>
                <h4 >{{$notice->title}}</h4>
                <p>{{$notice->message}}</p>
                <p> - @include('inspina.partials.name_tag', ['user' => $notice->user()->first()])</p>
                @if($group->user()->first()->id == \Auth::user()->id)
                    <a href="{{url('/notices/destroy/'. $notice->id)}}" onclick="return confirm_deletion(this);"><i class="fa fa-trash-o"></i></a>
                @endif
             </div>
        </li>
    @endforeach           
</ul>