@extends('inspina.layouts.main')

@section('content')
        <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
         @include('inspina.partials.to_group_feed_nav')

        @foreach($members as $member)
            <div class="col-lg-4">
                <div class="contact-box">

                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ asset($member->profileSource()) }}">
                            <br/>
                            <a href="{{ url($group->username . '/' .$member->id .'/main'. '/visit/pack/ ') }}" class="btn btn-sm btn-rounded btn-primary" style="color: #ffffff" data-toggle="tooltip" data-placement="bottom" title="View {{ $member->fullName() }}'s Back-Pack.">Back Pack</a>
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
        @if($members->count() == 0)
            <div class="middle-box text-center animated fadeInRightBig">
                 <h3 class="font-bold">You have no supervisors yet!</h3>
                     <div class="error-desc col-xs-10 col-xs-offset-1">
                         But Your group administrator can add supervisors to your group for easier communication and sharing of information.
                         Enjoy skoolspace!
                         <br><a href="{{ url($group->username) }}" class="btn btn-primary m-t">Back To Group Feed</a>
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