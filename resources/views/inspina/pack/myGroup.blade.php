@extends('inspina.layouts.main')

@section('content')
            <div class="wrapper wrapper-content animated fadeInRight">
                @include('inspina.partials.to_pack_set')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                    <h2>
                                       All Groups:
                                    </h2>

                                <div class="search-form">
                                    <form action="{{ url('/share/'.$file->id.'/search/') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search by group name" name="value" class="form-control input-lg">
                                            <div class="input-group-btn">
                                                <button class="btn btn-lg btn-primary" type="submit">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @if($groups->count() != 0)
                              @foreach($groups as $group)
                                <div class="hr-line-dashed"></div>
                                <div class="search-result">
                                <h3>{{ $group->name }}</h3>
                                    <span class="search-link"><i class="fa fa-university"></i> {{ $group->school_affiliation }}</span>
                                    <p>
                                        {{ $group->description }}
                                         <br>

                                       <span> <b>Followers</b>: {{ $group->followers()->get()->count() }}</span>&nbsp;&nbsp;&nbsp;
                                       <span> <b>Notices</b>: {{ $group->notices()->get()->count() }}</span>

                                    <br>
                                    <p align="center">

                                        <a href="{{ url('/share/'.$file->id.'/'. $group->username) }}" class="btn btn-rounded btn-primary btn-outline">Share Here</a>
                                        </p>
                                </div>
                              @endforeach

                            @else
                                <div class="hr-line-dashed"></div>
                                <h2 align="center"> No groups available to share the file with.</h2>
                            @endif

                                <div class="hr-line-dashed"></div>
                                <div class="text-center">
                                    <?php echo $groups->render() ?>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
@endsection