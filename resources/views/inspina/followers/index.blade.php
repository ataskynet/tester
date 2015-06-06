@extends('inspina.layouts.user')

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

                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>{{ $member->fullName() }}</strong></h3>
                        <p><i class="glyphicon glyphicon-pushpin"></i> {{ $member->notices()->get()->count() }} &nbsp; &nbsp;  <i class="fa fa-folder-open"></i> {{ $member->files()->get()->count() }}</p>
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