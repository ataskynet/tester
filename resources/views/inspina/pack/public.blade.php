@extends('inspina.layouts.user')

@section('content')
                <!-- Content starts here -->
                <div class="wrapper wrapper-content" style="padding-right: 0px; padding-top: 0px;">
                @include('inspina.partials.to_profile_nav')
                    <div class="row">
                    </div>
                    <br>
                    @include('inspina.partials.error')
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="file-manager">
                                        <h5>Folders <small class="pull-right">Files</small></h5>
                                        <ul class="folder-list" style="padding: 0">
                                        @if($folders->count() != 0)
                                        @foreach($folders as $folder)
                                            <li><a href="{{ url($user->id . '/visit/' .$folder->id. '/pack/ ') }}"><i class="fa fa-folder"></i> {{ $folder->name}} <span class="badge badge-info pull-right">{{ $folder->files()->count() }}</span></a></li>
                                        @endforeach
                                        @else
                                            <li><b> <span align="center">No folders created here yet.</span></b></li>
                                        @endif
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">

                                @foreach($folders as $folder)
                                    <div class="file-box">
                                        <div class="file">
                                            <a href="{{url($user->id . '/visit/' .$folder->id. '/pack/ ') }}">
                                                <span class="corner"></span>

                                                <div class="icon">
                                                    <img src="{{ asset('inspina/icons/folder5.png') }}" alt="{{ $folder->name }}"/>
                                                </div>
                                                <div class="file-name">
                                                    Folder: {{ $folder->name }}
                                                    <br/>
                                                    <small>Added: {{ $folder->created_at->diffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                    @if(isset($documents))
                        @if($documents->count() != 0)
                            @foreach($documents as $document)
                                <div class="file-box">
                                    <div class="file">
                                        <a href="{{ url($document->source) }}">
                                            <span class="corner"></span>

                                        @if($document->isImage())
                                            <div class="image">
                                                <img src="{{ asset($document->source)}}" alt="{{ $document->name }}" class="img-responsive"/>
                                            </div>
                                        @elseif($document->isPpt())
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/powerpoint1.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @elseif($document->isPdf())
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/pdf.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @elseif($document->isDoc())
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/word1.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @elseif($document->isCompressedFile())
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/compressed.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @elseif($document->isExcel())
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/excel1.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @else
                                            <div class="icon">
                                                <img src="{{ asset('inspina/icons/text3.png') }}" alt="{{ $document->name }}"/>
                                            </div>
                                        @endif
                                            <div class="file-name">
                                                {{ $document->name }}

                                                <br/>
                                                <small>Added: {{ $document->created_at->diffForHumans() }}</small>
                                                <br>
                                                <a href="{{ url($document->source) }}" style="padding-top: 30px;">
                                                 <i class="fa fa-download "></i> Download
                                                </a>


                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        @endif
                    @endif

                        @if($folders->count() == 0 && !isset($documents))
                                <div class="middle-box text-center animated fadeInRightBig" style="margin-top: 90px">
                                    <h2 class="font-bold">This Back-Pack is empty</h2>

                                    <div class="error-desc col-xs-10 col-xs-offset-1">
                                         <b>But </b>You can fill out your own back pack so that your fellow members may be able to access your files and benefit from them.

                                         <br><a href="{{ url('/') }}" class="btn btn-primary m-t">Back Home</a>
                                    </div>
                                </div>
                        @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                <!-- Content ends Here! -->
@endsection

@section('validation')
                $("#createfolderbtn").click(function()
                    {
                        if(!validateText("name"))
                            return false;
                        $('form#createfolderform').submit();

                    })
                $("#uploadfilebtn").click(function()
                    {
                        if(!validateText("file"))
                            return false;
                        $('form#uploadfileform').submit();

                    })
@endsection

