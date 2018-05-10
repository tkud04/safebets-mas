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
			</table>
          </div>
        </div>
      </div>
    </section>
@stop