<?php session_start();?>
<div layout = "column" layout-align="center ">
	<md-card ng-repeat = "event in events" >
	  <md-card-header>
	    <md-card-avatar>
	      <img src="/team12/images/uteplg.png"/>
	    </md-card-avatar>
	    <md-card-header-text>
	      <span class="md-title">Event</span>
	      <span class="md-subhead">cs Volunteering</span>
	    </md-card-header-text>
	  </md-card-header>
	  <img ng-src="" class="md-card-image" alt="">
	  <md-card-title>
	    <md-card-title-text>
	      <span class="md-headline">{{event.eventName}}</span>
	    </md-card-title-text>
	  </md-card-title>
	  <md-card-content >
			<section layout="row">
				<table class="table table-bordered" flex = "">
			    <tbody>
			      <tr>
			        <th>Location</th>
			        <td>{{event.eventLocation}}</td>
			      </tr>
			      <tr>
			        <th>Date</th>
			        <td>{{event.eventDate}}</td>
			      </tr>
			      <tr>
			        <th>Number of Volunteers</th>
			        <td>{{event.eventVolunteerCount}}</td>
			      </tr>
			    </tbody>
			  </table>
			</section>
			<section layout = "row">
				<table class="table table-bordered" flex = "">
					<thead>
						<th>Description</th>
					</thead>
					<tbody>
			      <tr>
			        <td>{{event.eventDescription}}</td>
			      </tr>
					</tbody>
				</table>
			</section>
			<section layout = 'row'>
				<button class = 'btn btn-default' ng-if= "state == 'user'" ng-click = 'signUp(event.eventId)'>
					Sign Up For Event</md-button>
			</section>
	  </md-card-content>
	</md-card>
</div>
