      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Email List Management</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{url('nimda/leads')}}" method="post">
                                    <div class="form-body">
									{{csrf_field()}}
                                        <h3 class="card-title m-t-15">Add Leads</h3>
                                        <hr>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Leads (one email address per line)</label>
                                                    <textarea class="form-control" name="leads" rows="10" value="{{old('leads')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                        <a href="{{url('nimda')}}" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>