@extends('inspina.layouts.user')


@section('content')
	<div class="wrapper wrapper-content" style="padding-top: 2px;">
	@include('inspina.partials.to_home_set')
            <div class="row animated fadeInRight">
                <div class="col-md-3">

                   @include('inspina.partials.contact')

                </div>
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title"  data-toggle="tooltip" data-placement="bottom" title="Compiled activities of {{ $user->fullName() }}.">
                            <h5>{{ $user->fullName() }} Activities</h5>

                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
                                        @include('inspina.partials.userFeed', ['statuses' => $statuses])
                                </div>
                            <div class="text-center">
                              <?php echo $statuses->render() ?>
                            </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    @include('inspina.partials.userInfo')
                </div>

            </div>
        </div>
@stop