                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Change Administrator (This change is permanent)</h5>
                                </div>

                                <div class="ibox-content">
                                   <form action="{{ url( $group->username . '/update/administrator') }}" method="POST" >
                                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                              <div>
                                                  <div class="row form-group">
                                                      <div class="col-md-12">
                                                          <input name="email" type="email" class="form-control" placeholder="New Administrator skoolspace Email"  required = "required">
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <a href="{{url($group->username)}}" class="btn btn-default">Close</a>
                                                  <button type="submit" class="btn btn-info">Register New Administrator</button>
                                              </div>
                                          </form>
                                </div>
                            </div>