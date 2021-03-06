@extends('inspina.layouts.main')


@section('content')
	<div class="wrapper wrapper-content" style="padding-top: 0px;  padding-left: 0px; padding-right: 0px;">

            <div class="row animated fadeInRight">
            @include('inspina.partials.groupProfile')
                <div class="col-md-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>
                                Group Activities

                            </h5>
                            @if($group->isSupervisedBy(\Auth::user()))
                            <!--   <i class="label label-info pull-right" style="color: #ffffff" data-toggle="tooltip" data-placement="bottom" title="You are a supervisor in this group."> As Supervisor </i> -->
                            @endif
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">
                                    @include('inspina.partials.status', ['statuses' => $group->paginatedPosts()])
                                </div>

                                <div class="text-center">
                                    <?php echo $group->paginatedPosts()->render() ?>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-3 col-xs-12 pull-right">
                    @include('inspina.partials.group_features')
                </div>
            </div>
        </div>
@stop