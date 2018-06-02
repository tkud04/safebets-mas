      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">User Management</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{url('nimda/ut')}}" method="post">
                                    <div class="form-body">
									{{csrf_field()}}
                                        <h3 class="card-title m-t-15">Add/Remove Tokens</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="control-label">What do you want to do?</label>
                                                    <select class="form-control custom-select" value="{{$action}}" name="action">
                                                        <option value="none">Select desired action</option>
                                                        <option value="add">Add tokens</option>
                                                        <option value="remove">Remove tokens</option>
                                                    </select>
                                                    <small class="form-control-feedback"> Select desired action </small> </div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" value="{{old('username')}}">
                                                    <input type="hidden" class="form-control" name="gggg" value="{{$ret['id']}}">
													<script>
													  document.querySelector('#username').value = "{{$ret['username']}}";
													</script>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tokens</label>
                                                    <input type="text" class="form-control" name="tokens" value="{{old('tokens')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>