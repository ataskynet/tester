
                                <div class="modal inmodal" id="subModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-folder-o modal-icon"></i>
                                                <h4 class="modal-title">Create a Folder</h4>
                                                <small class="font-bold">Folders help in arranging and retrieving your files.</small>
                                            </div>
                                            <form action="{{ url('pack/'.$folder->id.'/sub') }}" method="POST" id="createfolderform" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="modal-body">
                                                   <div class=" form-group">
                                                   <label>Sub-Folder Name:</label>
                                                        <input class="form-control" id="name" name="name" type="text"/>
                                                   </div>
                                                    <div class="row form-group">
                                                    <label class="col-sm-4 control-label">You want the folder:</label>
                                                        <div class="col-sm-8    ">
                                                            <label class="checkbox-inline">
                                                                <input type="radio" value="1" id="inlineCheckbox2" name="permission" checked> Public
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="radio" value="0" id="inlineCheckbox1" name="permission" > Private
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="button" id="createfolderbtn" class="btn btn-primary">Create Folder</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>