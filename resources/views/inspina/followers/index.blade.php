@extends('inspina.layouts.user')

@section('content')
        <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

         @include('inspina.partials.to_group_feed_nav')
         <div class="col-md-12">
                <div class="row m-b-sm m-t-sm">
                     <div class="col-md-1">
                          <a href="{{ url($group->username . '/contacts') }}" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</a>
                     </div>
                     <form action="{{ url($group->username.'/contacts') }}" method="get">
                           <div class="col-md-11">
                                <div class="input-group"><input type="search" name="value" placeholder="Search By User First Name" class="input-sm form-control"> <span class="input-group-btn">
                                     <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> Search Members</button> </span></div>
                                </div>
                     </form>
                </div>
         </div>
        @foreach($members as $member)
            <div class="col-lg-4">
                <div class="contact-box" style="overflow: auto">

                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ asset($member->profileSource()) }}">
                            <br/>
                            <a href="{{ url($group->username . '/' .$member->id .'/main'. '/visit/pack/ ') }}" class="btn btn-sm btn-rounded btn-primary" style="color: #ffffff" data-toggle="tooltip" data-placement="bottom" title="This user's back-pack."><i class="fa fa-briefcase"></i> Back-Pack</a>
                        </div>
                    </div>
                    <div class="col-sm-8" >
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
            <div class="middle-box text-center animated fadeInRightBig" style="margin-top: 90px">
                 <h2 class="font-bold">No Members Found</h2>

                 <div class="error-desc col-xs-10 col-xs-offset-1">
                      Check the name you used to search for the member in this group, please try another name please.
                      Enjoy skoolspace.
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