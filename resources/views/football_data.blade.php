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
			  <div class="form-row">
			   <h3>Get fixtures for a competition</h3><br>
			   <div class="form-group col-sm-6 col-md-6">
			     <label for="league">Select league</label>
				 <select class="form-control" id="league" data-lef="{{url('gf')}}">
				    <option value="none">Select League</option>
				    @foreach($ret as $r)
					  <option value="{{$r->id}}">{{$r->caption}}</option>
					@endforeach
				 </select>
			   </div>
			   <div class="form-group col-sm-6 col-md-6">
			     <label for="league">Select fixtures</label>
				 <select class="form-control" id="fixtures">
				    <option value="none">Select fixture</option>
				 </select>
			   </div>
			  </div>
			</form>
			
			<div id="working"></div>
			<div id="result"></div>
			<div id="error"></div>
          </div>
        </div>
      </div>
    </section>
@stop