
                                <div class="modal inmodal" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-folder-open modal-icon"></i>
                                                <h4 class="modal-title">Update Folder</h4>
                                                <small class="font-bold">Folders help in arranging and retrieving the files.</small>
                                            </div>
                                            <form action="{{ url('/pack/'.$folder->id.'/update') }}" method="POST" id="updatefolderform" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class=" form-group">
                                                   <label for="name">Folder Name:</label>
                                                   <input class="form-control" id="name" name="name"  VALUE="{{$folder->name}}" type="text" />
                                                   </div>
                                                    <div class="row form-group">
                                                    <label class="col-sm-4 control-label">You want the folder:</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline">
                                                                <input type="radio" value="1" id="inlineCheckbox2" name="permission" @if($folder->permission)checked @endif > Public
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="radio" value="0" id="inlineCheckbox1" name="permission" @if(!($folder->permission))checked @endif > Private
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class=" row form-group">
                                                         <a href="{{ url('/pack/'.$folder->id.'/delete') }}" class="btn btn-danger btn-block btn-rounded" onclick="return confirm_deletion(this);">Delete Folder</a>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="updatefolderbtn" class="btn btn-primary">Update Folder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>