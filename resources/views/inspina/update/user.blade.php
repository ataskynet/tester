@extends('inspina.layouts.user')

@section('content')
    <div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
                    <div class="col-md-4">
                       @include('inspina.partials.userProfile')
                    </div>
                    <div class="col-md-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>User Profile</h5>

                            </div>
                            <div class="ibox-content">

                               <form action="{{ url( '/profile/update/') }}" method="post" enctype="multipart/form-data" >
                                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                           <div>

                                               <div class=" row form-group ">
                                                   <div class="col-md-12">
                                                       <label class="">Change Profile Picture:</label>
                                                       <input type="file" name="profile" class="form-control" />
                                                   </div>
                                               </div>

                                               <div class="row form-group">
                                                   <div class="col-md-12">
                                                       <input name="email" type="email" class="form-control" placeholder="Group Name" disabled="true" value="{{$user->email}}" required = "required">
                                                   </div>
                                               </div>
                                               <div class="row form-group">
                                                   <div class="col-md-6">
                                                       <input name="firstName" type="text" class="form-control" placeholder="Group's Email" value="{{$user->firstName}}" required = "required">
                                                   </div>
                                                   <div class="col-md-6">
                                                       <input name="lastName" type="text" class="form-control"  placeholder="Unique Username" value="{{$user->lastName}}" required = "required">
                                                   </div>
                                               </div>
                                               <div class="row form-group">
                                                   <div class="col-md-12">
                                                       <input name="telNumber" type="text" class="form-control" placeholder="Group Name" value="{{$user->telNumber}}" required = "required">
                                                   </div>
                                               </div>

                                               <div class="row form-group">
                                                   <div class="col-md-12">
                                                       <input name="password" type="password" class="form-control" placeholder="New Password" >
                                                   </div>
                                               </div>
                                            <div class="row form-group">
                                            <label class="col-sm-4 control-label">Mail Notification:</label>
                                                <div class="col-sm-8">
                                                    <label class="checkbox-inline">
                                                        <input type="radio" value="1" id="inlineCheckbox1" name="pin_notification" @if($user->pin_notification == 1)checked @endif > Allow all notifications
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="radio" value="0" id="inlineCheckbox2" name="pin_notification" @if($user->pin_notification == 0) checked @endif > Allow only new file notifications
                                                    </label>
                                                </div>
                                            </div>
                                          </div>
                                           <div class="modal-footer">
                                               <a href="{{url('/')}}" class="btn btn-default">Close</a>
                                               <button type="submit" class="btn btn-info">Update</button>
                                           </div>
                                       </form>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{url( '/profile/destroy')}}" class="btn btn-danger btn-sm btn-block"><i class="fa fa-"></i> Deactivate skoolspace profile</a>
                        </div>
                    </div>
                </div>
            </div>
@endsection