@extends('layout')

@section('title',"Exploring Football Data API")

@section('content')
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading">List of Available Leagues!</h2>
            <hr>
            <p class="mb-5">Do you have what it takes to predict winning games? That's great! Make money today by predicting winning games in the following leagues below:</p>
			<table class="table table-responsive">
			  <thead>
			    <th>ID</th>
			    <th>Name</th>
			    <th>Abbr.</th>
			  </thead>
			  
			  <tbody>
			    @foreach($ret as $r)
				 <tr>
				    <td>{{$r->id}}</td>
				    <td>{{$r->caption}}</td>
				    <td>{{$r->league}}</td>
				 </tr>
			    @endforeach
			  </tbody>
			</table><br><br>
			
			<form id="fixture-form">
			  <h3>Get fixtures for a competition</h3><br>
			  <div class="row">
			     <div class="col-sm-3 col-md-3">			
			        <div class="form-group">
			           <label for="league">Select league</label>
				      <select class="form-control" id="league" data-lef="{{url('gf')}}">
				        <option value="none">Select League</option>
				        @foreach($ret as $r)
					       <option value="{{$r->id}}">{{$r->caption}}</option>
					    @endforeach
				      </select>
			        </div>
				 </div>
			     <div class="col-sm-4 col-md-4">
			        <div class="form-group">
			           <label for="fixtures">Select fixtures</label>
				       <select class="form-control" id="fixtures">
				         <option value="none">Select fixture</option>
				       </select>
			        </div>
			    </div>
				<div class="col-sm-3 col-md-3">
			        <div class="form-group">
			           <label for="league">Prediction</label>
				       <select class="form-control" id="prediction">
				         <option value="none">Select prediction</option>
				         <option value="none" disabled>1X2</option>
				         <option value="none">1</option>
				         <option value="none">X</option>
				         <option value="none">2</option>
				       </select>
			        </div>
			    </div>
			     <div class="col-sm-2 col-md-2">
			        <div class="form-group">
			           <button type="submit" class="btn btn-success">Add</button>
			        </div>
			    </div>
			  </div>
			</form>
			
			<div id="working"></div>
			<div id="result"></div>
			<div id="error"></div>
          </div>
        </div>
		<div class="row" id="predictions">
		   <div class="col-sm-12">
		    <table class="table table-responsive">
			  <thead>
			    <th>League</th>
			    <th>Fixture - Date</th>
			    <th>Prediction</th>
			    <th>Action</th>
			  </thead>
			  
			  <tbody>
			  </tbody>
			</table>
		   </div>
		</div>
      </div>
    </section>
@stop