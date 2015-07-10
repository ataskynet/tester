@extends('inspina.layouts.user')

@section('content')
                <!-- Content starts here -->
                <div class="wrapper wrapper-content" style="padding-right: 0px; padding-top: 0px;">
                    <div class="row">
                   @include('inspina.partials.back_pack_nav')
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div class="file-manager">
                                    @include('inspina.pack.partials.upload')
                                        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#subModal">Create Sub Folder</button>
                                        <div class="hr-line-dashed"></div>
                                        <h5>Sub-Folders <small class="pull-right">Files</small></h5>
                                        <ul class="folder-list" style="padding: 0">
                                        @if($subFolders->count() != 0)
                                        @foreach($subFolders as $subFolder)
                                            <li><a href="{{url('pack/'. $subFolder->id) }}"><i class="fa fa-folder"></i> {{ $subFolder->name}} <span class="badge badge-info pull-right">{{ $subFolder->files()->count() }}</span></a></li>
                                        @endforeach
                                        @else
                                            <li><b> <span align="center">No Sub Folders for this folder.</span></b></li>
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
                                @include('inspina.pack.partials.createSubFolder')
                                    <div class="file-box">
                                        <div class="file">
                                            <a href="" data-toggle="modal" data-target="#uploadModal">
                                                <span class="corner"></span>

                                                <div class="icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div  class="text-center file-name">
                                                    <h3>Upload File</h3>
                                                </div>
                                            </a>
                                        </div>

                                    </div>

                                        @include('inspina.pack.partials.updateFolder')
                                        <div class="file-box">
                                            <div class="file">
                                                <a href="" data-toggle="modal" data-target="#updateModal">
                                                    <span class="corner"></span>

                                                    <div class="icon">
                                                        <i class="fa fa-edit"></i>
                                                    </div>
                                                    <div  class="text-center file-name">
                                                        <h3>Rename Folder</h3>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                @foreach($subFolders as $subFolder)
                                    <div class="file-box">
                                        <div class="file">
                                            <a href="{{ url('/pack/'. $subFolder->id) }}">
                                                <span class="corner"></span>

                                                <div class="icon">
                                                    <img src="{{  asset('inspina/icons/folder5.png') }}" alt="{{ $subFolder->name }}"/>
                                                </div>
                                                <div class="file-name">
                                                    Folder: {{ $subFolder->name }}
                                                    <br/>
                                                    <small>Added: {{ $subFolder->created_at->diffForHumans() }}</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

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
                                                <a href="{{ url('/share/'.$document->id.'/groups/') }}" style="padding-top: 30px;">
                                                 <i class="fa fa-share-square-o  "></i> Share
                                                </a>
                                                <a href="{{ url('/pack/delete/'.$folder->id.'/'.$document->id) }}" class="pull-right" onclick="return confirm_deletion(this);">
                                                 <i class="glyphicon glyphicon-remove-sign"></i>
                                                </a>

                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endforeach
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

