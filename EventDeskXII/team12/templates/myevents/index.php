<?php session_start();?>
<style>
.diabled-class{
	background-color:green;
	color:white;
}
</style>
<div>
	<uib-accordion close-others="oneAtATime">
	 	<div uib-accordion-group class="panel-default" heading="Approved Events">
			<uib-accordion close-others="oneAtATime">
			    <div uib-accordion-group ng-repeat = "event in events" class="panel-default" heading="{{event.eventId}} 						{{event.eventName}}">
						<section layout="row">
							<table class="table table-bordered" flex = "">
						    <tbody>
						      <tr>
						        <th>Location</th>
						        <td>
											<input ng-model = "event.eventLocation" 
														 ng-disabled = "isModified"
														 ng-class="{'diabled-class':selected == event}"/>
										</td>
						      </tr>
						      <tr>
						        <th>Date</th>
						        <td><input ng-model = "event.eventDate"
												 			 ng-disabled = "isModified"
															 ng-class="{'diabled-class':selected == event}"></td>
						      </tr>
						      <tr>
						        <th>Number Of Volunteers</th>
						        <td><input ng-model = "event.eventVolunteerCount" 
															 ng-disabled = "isModified"
															 ng-class="{'diabled-class':selected == event}"></td>
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
						        <td>
											<textarea style = "width:100%" ng-model="event.eventDescription" 
												ng-disabled = "isModified"
												ng-class="{'diabled-class':selected == event}"
				  							[name="string"]
				  							[required="string"]
				  							[ng-required="string"]
				  							[ng-minlength="number"]
				  							[ng-maxlength="150"]
				  							[ng-pattern="string"]
				  							[ng-change="string"]
				  							[ng-trim="boolean"]>
											</textarea>
										</td>
						      </tr>
								</tbody>
							</table>
						</section>
						<section layout = "row">
							<table class="table table-bordered" flex = "">
						    <tbody>
						      <tr>
						        <th>Approved By</th>
						        <td>{{event.approved_by}}</td>
						      </tr>
						      <tr>
						        <th>Created By</th>
						        <td>{{event.created_by}}</td>
						      </tr>
						      <tr>
						        <th>Updated By</th>
						        <td>{{event.updated_by}}</td>
						      </tr>
						    </tbody>
						  </table>
						</section>
						<section layout = "row">
							<table class="table table-bordered" flex = "">
								<thread>
									<th>Options</th>
								</thread>
								<tbody>
									<tr>
										<td>
											<span style = "display:inline-block">
												<button class = 'btn btn-default' ng-click = 'delete(event.eventId)'>
													delete
												</button>
											</span>
											<span style = "display:inline-block">
												<button class = 'btn btn-default' ng-if = "isModified" ng-click = 'modify(event)'>
													modify
												</button>
												<button class = 'btn btn-default' ng-if = "!isModified" ng-click = 'save(event)'>
													save
												</button>
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						</section>
			    </div>
			</uib-accordion>
		</div>
		<div uib-accordion-group class='panel-default' heading='Requested Events'>
			<uib-accordion close-others="oneAtATime">
				<div uib-accordion-group ng-repeat = "request in requests" class="panel-default" heading="{{request.eventId}} 						{{request.eventName}}">
					<section layout="row">
						<table class="table table-bordered" flex = "">
					    <tbody>
					      <tr>
					        <th>Location</th>
					        <td>
										<input ng-model = "request.eventLocation" 
													 ng-disabled = "isModified"
													 ng-class="{'diabled-class':selected == event}"/>
									</td>
					      </tr>
					      <tr>
					        <th>Date</th>
					        <td><input ng-model = "request.eventDate"
											 			 ng-disabled = "isModified"
														 ng-class="{'diabled-class':selected == event}"></td>
					      </tr>
					      <tr>
					        <th>Number Of Volunteers</th>
					        <td><input ng-model = "request.eventVolunteerCount" 
														 ng-disabled = "isModified"
														 ng-class="{'diabled-class':selected == event}"></td>
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
					        <td>
										<textarea style = "width:100%" ng-model="event.eventDescription" 
											ng-disabled = "isModified"
											ng-class="{'diabled-class':selected == event}"
			  							[name="string"]
			  							[required="string"]
			  							[ng-required="string"]
			  							[ng-minlength="number"]
			  							[ng-maxlength="150"]
			  							[ng-pattern="string"]
			  							[ng-change="string"]
			  							[ng-trim="boolean"]>
										</textarea>
									</td>
					      </tr>
							</tbody>
						</table>
					</section>
					<section layout = "row">
						<table class="table table-bordered" flex = "">
					    <tbody>
					      <tr>
					        <th>Requested by</th>
					        <td></td>
					      </tr>
					    </tbody>
					  </table>
					</section>
					<section layout = "row">
						<table class="table table-bordered" flex = "">
							<thread>
								<th>Options</th>
							</thread>
							<tbody>
								<tr>
									<td>
										<span style = "display:inline-block">
											<button class = 'btn btn-default' ng-click = 'delete(request.eventId)'>
												delete
											</button>
										</span>
										<span style = "display:inline-block">
											<button class = 'btn btn-default' ng-click = 'approve(request)'>
												approve
											</button>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</section>
				</div>
			</uib-accordion>
		</div>
	</uib-accordion>
</div>
