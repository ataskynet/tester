@extends('inspina.layouts.user')

@section('content')
        <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
         @include('inspina.partials.to_group_feed_nav')
      @if($members->count() != 0 )
        @foreach($members as $member)
            <div class="col-lg-4">
                <a href="{{ url('share/'.$group->username.'/files/'.$member->id) }}" style="text-decoration: none; text-decoration-color: #000000">
                <div class="contact-box">

                    <div class="col-sm-4">
                        <div class="text-center" >

                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ asset($member->profileSource()) }}">

                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3 ><strong style="text-decoration: none;">{{ $member->fullName() }}</strong></h3>
                        <p> <i class="fa fa-share-square"></i> Shared Files: {{ $group->sharedFilesOf($member)->count() }}</p>
                        <address>
                            <strong>Contact Info.</strong><br>
                           {{ $member->email }}<br>
                            <abbr title="Phone">P:</abbr> {{ $member->telNumber }}
                        </address>
                    </div>
                    <div class="clearfix"></div>

                </div>
                </a>
            </div>
        @endforeach
      @else
        <div class="middle-box text-center animated fadeInRightBig" style="margin-top: 90px">
            <h2 class="font-bold">No Sharers Yet!</h2>

            <div class="error-desc">
                 <b>But </b>You can share a file to this group from your back-pack files with ease.
                 Try it out and share your files with the rest of the group I am sure they would appreciate it. :)
                 <br><a href="{{ url('/') }}" class="btn btn-primary m-t">Back Home</a>
            </div>
        </div>
      @endif
        <br>
        <div class=" row col-md-12 text-center">
            <?php echo $members->render() ?>
        </div>

        </div>
        </div>
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