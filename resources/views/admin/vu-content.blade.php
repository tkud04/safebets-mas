    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Users</h4>
                                <h6 class="card-subtitle">List of all users registered on SafeBets</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date Joined</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Phone #</th>
                                                <th>Balance (tokens)</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										 @if(isset($users) && count($users) > 0)
										 @foreach($users as $u)
									      <?php
										    $status = $u['status'];
											$btnClass = "btn-danger";
											$badgeClass = "badge-primary";
											$href = url("nimda/disable");
											$txt = "Disable";
											
											if($status == "disabled")
											{
												$btnClass = "btn-danger";
												$badgeClass = "badge-danger";
												$href = url("nimda/enable");
												$txt = "Enable";
											}
											
											$href .= "/".$u['id'];
											$addUrl = url('nimda/ut/ad')."/".$u['id'];
											$removeUrl = url('nimda/ut/rm')."/".$u['id'];
										  ?>
										    <tr>
											  <td>{{$u['date']}}</td>
											  <td>{{$u['name']}}</td>
											  <td>{{$u['username']}}</td>
											  <td>{{$u['email']}}</td>
											  <td>{{$u['phone']}}</td>
											  <td>{{$u['balance']}}</td>
											  <td><span class="badge badge-info">{{$u['role']}}</span></td>
											  <td><span class="badge {{$badgeClass}}">{{$status}}</span></td>
                                              <td>
											     <div class="btn-group" role="group">
											        <a class="btn {{$btnClass}}" href="{{$href}}">{{$txt}}</a>
												 
												    <div class="btn-group" role="group">
												        <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tokens</button>
												        <div class="dropdown-menu" aria-labelledby="mark-btn">
												            <a class="dropdown-item" href="{{$addUrl}}">Add</a>
												            <a class="dropdown-item" href="{{$removeUrl}}">Remove</a>
												        </div>													
												    </div>												 
												 </div>
											  </td>
											</tr>
										@endforeach
										@endif
                                        </tbody>
										
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>