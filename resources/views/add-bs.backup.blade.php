@extends('layout')

@section('title',"Add Tip")

@section('content')
    <section id="add-bs">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
			
			<form id="fixture-form">
			  <h3>Add Tip</h3><br>
			  <div class="row">
			     <div class="col-sm-2 col-md-2">			
			        <div class="form-group">
			           <label for="league">Select league</label>
				      <select class="form-control" id="league" data-lef="{{url('gf')}}">
				        <option value="none">Select League</option>
				        @foreach($ret as $r)
						  <?php $id = $r->id; ?>
					       <option value="{{$id}}">{{$r->caption}}</option>
					    @endforeach
						   <option value="other">Other</option>
				      </select>
			        </div>
				 </div>
			     <div class="col-sm-5 col-md-5">
			        <div class="form-group" id="for-fxt">
			           <label for="fixtures">Select fixtures</label>
				       <select class="form-control" id="fixtures">
				         <option value="none">Select fixture</option>
				       </select>
			        </div>			        
					<div id="for-mt">
					  <div class="row">
					     <div class="col-md-12">
							<div class="form-group">
								<label for="other-date">Fixture Date</label>
								<input class="form-control" type="text" placeholder="YYYY/MM/DD HH:MM AM/PM" id="other-date"/>
							</div>							     
						 </div><br>						     
						 <div class="col-md-12">
							<div class="form-group">
								<label for="other-country">Country</label>
								<select class="form-control" data-lef="{{url('gc')}}" id="other-country">
									<option value="none">Select country</option>
									 @foreach($countries as $c)
						              <?php $id = $c['id']; $name = $c['name']; ?>
					                   <option value="{{$id}}">{{$name}}</option>
					                 @endforeach
								</select>
							</div>							     
						 </div><br>					     
						 <div class="col-md-12">
							<div class="form-group">
								<label for="other-competition">Competition</label>
								<select class="form-control" data-lef="{{url('gt')}}" id="other-competition">
									<option value="none">Select competition</option>
								</select>
							</div>							     
						 </div><br>					     
						 <div class="col-md-12">
							<div class="form-group">
								<label for="other-home">Home</label>
								<select class="form-control" id="other-home">
									<option value="none">Home team</option>
								</select>
							</div>							     
						 </div><br>					     
						 <div class="col-md-12">
							<div class="form-group">
								<label for="other-away">Away</label>
								<select class="form-control" id="other-away">
									<option value="none">Away team</option>
								</select>
							</div>							     
						 </div><br>
					  </div>
			        </div>
			    </div>
				<div class="col-sm-3 col-md-3">
			        <div class="form-group">
			           <label for="league">Prediction</label>
				       <select class="form-control" id="prediction">
				         <option value="none">Select prediction</option>
				         <option value="none" disabled>1X2</option>
				         <option value="1">1</option>
				         <option value="X">X</option>
				         <option value="2">2</option>				         
						 <option value="none" disabled>Double Chance</option>
				         <option value="1X">1X</option>
				         <option value="12">12</option>
				         <option value="X2">X2</option>				         
						 <option value="none" disabled>Over</option>
				         <option value="Over 0.5">Over 0.5</option>
				         <option value="Over 1.5">Over 1.5</option>
				         <option value="Over 2.5">Over 2.5</option>
				         <option value="Over 3.5">Over 3.5</option>				         
				         <option value="Over 4.5">Over 4.5</option>				         
				         <option value="Over 5.5">Over 5.5</option>				         
						 <option value="none" disabled>Under</option>
				         <option value="Under 1.5">Under 1.5</option>			         
				         <option value="Under 2.5">Under 2.5</option>			         
				         <option value="Under 3.5">Under 3.5</option>			         
				         <option value="Under 4.5">Under 4.5</option>			         
				         <option value="Under 5.5">Under 5.5</option>			         
						 <option value="none" disabled>Over HT</option>
				         <option value="Over 0.5 HT">Over 0.5 HT</option>
				         <option value="Over 1.5 HT">Over 1.5 HT</option>
				         <option value="Over 2.5 HT">Over 2.5 HT</option>
				         <option value="Over 3.5 HT">Over 3.5 HT</option>				         				         
						 <option value="none" disabled>Over 2HT</option>
				         <option value="Over 0.5 2HT">Over 0.5 2HT</option>
				         <option value="Over 1.5 2HT">Over 1.5 2HT</option>
				         <option value="Over 2.5 2HT">Over 2.5 2HT</option>
				         <option value="Over 3.5 2HT">Over 3.5 2HT</option>				         				         
						 <option value="none" disabled>Double Chance HT</option>
				         <option value="1X HT">1X HT</option>
				         <option value="12 HT">12 HT</option>
				         <option value="X2 HT">X2 HT</option>					         
						 <option value="none" disabled>Both Teams To Score</option>
				         <option value="GG">GG</option>
				         <option value="NG">NG</option>						 
						 <option value="none" disabled>Both Teams To Score HT</option>
				         <option value="GG HT">GG HT</option>
				         <option value="NG HT">NG HT</option>						 
						 <option value="none" disabled>Team Win Either Half</option>
				         <option value="Home Win Either Half">Home Win Either Half</option>
				         <option value="Away Win Either Half">Away Win Either Half</option>						 
						 <option value="none" disabled>Team Win Both Halves</option>
				         <option value="Home Win Both Halves">Home Win Both Halves</option>
				         <option value="Away Win Both Halves">Away Win Both Halves</option>
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
			    <th>Date - Fixture</th>
			    <th>Prediction</th>
			    <th>Action</th>
			  </thead>
			  
			  <tbody id="predictions-tbody">
			  </tbody>
			</table><br>
			<form id="save-form" method="post" action="{{url('add-tip')}}">
				{{csrf_field()}}
				<input type="hidden" id="ssp" name="ssp" value=""/>
				<input type="hidden" id="todd" name="total_odds" value=""/>
				<input type="hidden" id="bcc" name="booking_code" value=""/>
				<input type="hidden" id="bscs" name="bsite" value=""/>
			</form>
			<a class="btn btn-success" href="#" id="save-btn">Save Tip</a>
		   </div>
		</div>
      </div>
    </section>
@stop