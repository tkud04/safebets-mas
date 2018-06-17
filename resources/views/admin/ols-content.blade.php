      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Manage Other Leagues</h4>
                            </div>
                            <div class="card-body">
							   <div class="col-md-12">
                                <form action="{{url('nimda/add-country')}}" method="get">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Add country</h3>
                                        <hr>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Country name</label>
                                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </form><br><br>                              
								
								<form action="{{url('nimda/add-competition')}}" method="get">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Add competition</h3>
                                        <hr>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control" name="country_id">
													    <option value="none">Select country</option>
													    @foreach($countries as $country)
														   <option value="{{$country['id']}}">{{$country['name']}}</option>
														@endforeach
													</select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Competition name</label>
                                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </form><br><br>                             
								
								<form action="{{url('nimda/add-team')}}" method="get">
                                    <div class="form-body">
                                        <h3 class="card-title m-t-15">Add team</h3>
										<div id="working"></div>
										<div id="error"></div>
										<div id="result"></div>
                                        <hr>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control" id="countries" data-lef="{{url('nimda/get-competitions')}}" name="country_id">
													    <option value="none">Select country</option>
													    @foreach($countries as $country)
														   <option value="{{$country['id']}}">{{$country['name']}}</option>
														@endforeach
													</select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Competition</label>
                                                    <select class="form-control" id="competitions" name="competition_id">
													</select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>UID</label>
                                                    <input type="text" class="form-control" name="uid" value="{{old('uid')}}"><br>                                                    
													
													<label>Team name</label>
                                                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </form>
                            </div>
                          </div>
                        </div>
                    </div>
          </div>
        </div>
      </div>