
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leads</h4>
                                <h6 class="card-subtitle">SafeBets mailing lists</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date added</th>
                                                <th>Email</th>
                                                <th>Subscribed?</th>
                                            </tr>
                                        </thead>                                        
										<tbody>
										    @if(isset($leads))
											@foreach($leads as $l)
										    <?php
											    $em= $l["email"];
												$sub = $l["sub"];
											?>
                                            <tr>
                                                <td>{{$l["date"]}}</td>
                                                <td>{{$em}}</td>
                                                <td>{{$sub}}</td>
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