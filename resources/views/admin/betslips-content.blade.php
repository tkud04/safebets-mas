
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bet Slips</h4>
                                <h6 class="card-subtitle">List of all bet slips posted on SafeBets</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Category</th>
                                                <th>Sold by</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
                                            <tr>
                                                <td><?php echo date("jS F, Y h:i A"); ?></td>
                                                <td>Single-game bet slip</td>
                                                <td><span class="badge badge-success">REGULAR</span></td>
                                                <td><a href='#'>arsenalfan69</a></td>
                                                <td><i class="text-primary fa fa-times"></i></td>
                                                <td>
												 <a class="btn btn-warning text-white" href="vbs.php">View</a>
												 
												 <div class="btn-group" role="group">
												    <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mark</button>
												 <div class="dropdown-menu" aria-labelledby="mark-btn">
												    <a class="dropdown-item" href="#">Win</a>
												    <a class="dropdown-item" href="#">Loss</a>
												 </div>													
												 </div>
												</td>
                                            </tr>                                            
											<tr>
                                                <td><?php echo date("jS F, Y h:i A"); ?></td>
                                                <td>Multi-game bet slip</td>
                                                <td><span class="badge badge-danger">PREMIUM</span></td>
                                                <td><a href='#'>Oshozondi</a></td>
                                                <td><i class="text-primary fa fa-times"></i></td>
                                                <td>
												 <a class="btn btn-warning text-white" href="vbs.php">View</a>
												 
												 <div class="btn-group" role="group">
												    <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mark</button>
												 <div class="dropdown-menu" aria-labelledby="mark-btn">
												    <a class="dropdown-item" href="#">Win</a>
												    <a class="dropdown-item" href="#">Loss</a>
												 </div>													
												 </div>
												</td>
                                            </tr>											
											<tr>
                                                <td><?php echo date("jS F, Y h:i A"); ?></td>
                                                <td>Multi-game bet slip</td>
                                                <td><span class="badge badge-danger">PREMIUM</span></td>
                                                <td><a href='#'>Oshozondi</a></td>
                                                <td><i class="text-primary fa fa-times"></i></td>
                                                <td>
												 <a class="btn btn-warning text-white" href="vbs.php">View</a>

												 <div class="btn-group" role="group">
												    <button id="mark-btn" type="button" class="btn btn-info text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mark</button>
												 <div class="dropdown-menu" aria-labelledby="mark-btn">
												    <a class="dropdown-item" href="#">Win</a>
												    <a class="dropdown-item" href="#">Loss</a>
												 </div>													
												 </div>												 
												 
												</td>
                                            </tr>
                                        </tbody>
										
                                    </table>
                                </div>
                            </div>
                        </div>
          </div>
        </div>
      </div>