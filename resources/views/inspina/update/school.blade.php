@extends('inspina.layouts.main')

@section('content')
 <div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        @include('inspina.partials.groupProfile')
                    <div class="col-md-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Group Profile</h5>
                                <div class="ibox-tools">

                                </div>
                            </div>

                            <div class="ibox-content">
                               <form action="{{ url( $group->username . '/update/') }}" method="POST" enctype="multipart/form-data" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <div>
                                              <div class=" row form-group ">
                                                   <div class="col-md-12">
                                                       <label class="">Change Group Profile Picture:</label>
                                                       <input type="file" name="profile" class="form-control" />
                                                   </div>
                                               </div>

                                              <div class="row form-group">
                                                  <div class="col-md-6">
                                                      <input name="email" type="email" class="form-control" placeholder="Group's Email" value="{{$group->email}}" required = "required">
                                                  </div>
                                                  <div class="col-md-6">
                                                      <input name="username" type="text" class="form-control" disabled="true" placeholder="Unique Username" value="{{$group->username}}" required = "required">
                                                  </div>
                                              </div>
                                              <div class="row form-group">
                                                  <div class="col-md-6">
                                                      <input name="name" type="text" class="form-control" placeholder="Group Name" value="{{$group->name}}" required = "required">
                                                  </div>
                                                <div class="col-md-6">
                                                    <input name="school_affiliation" id="school" type="text" class="form-control" placeholder="From Which school?" value="{{ $group->school_affiliation }}" required = "required">
                                                </div>
                                              </div>
                                              <div class="row form-group">
                                                  <div class="col-md-12">
                                                      <div class="chat-message-form">
                                                          <div class="form-group">
                                                              <textarea class="form-control message-input" name="description" placeholder="Brief Description" value="{{ $group->description }}" required = "required">{{$group->description}}</textarea>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="modal-footer">
                                              <a href="{{url($group->username)}}" class="btn btn-default">Close</a>
                                              <button type="submit" class="btn btn-info">Update</button>
                                          </div>
                                      </form>
                            </div>


                        </div>
                        @include('inspina.update.partials.administrator')
                        <div class="col-md-12">
                            <a href="{{url($group->username, 'delete')}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm_deletion(this);"><i class="fa fa-"></i> Delete Group</a>
                        </div>
                    </div>
                </div>
            </div>
@endsection