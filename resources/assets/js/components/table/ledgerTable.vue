<style type="text/css">
	.w-15{
		width : 15%!important;
	}
	.w-10{
		width : 10%!important;
	}
	.w-5{
		width : 5%!important;
	}

</style>
<template>
	<div>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th class="w-5">ID</th>
	            	<th class="w-10">When</th>
	 				<th class="w-25">Trip</th>
					<th class="w-10">From</th>
		            <th class="w-10">To</th>
		            <th class="w-5">Amount</th>
		            <th class="w-15">Reason</th>
		            <th class="w-5">Approval</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(ledger,index) in ledgers">
					<td>{{ ledger.id }}</td>
					<td>{{ getDate(ledger.when) }}</td>
					<td v-html="getTripDetail(ledger.trip)"></td>
					<td>{{ getFromTo(ledger.fromable, ledger.fromable_type) }}</td>
					<td>{{ getFromTo(ledger.toable, ledger.toable_type) }}</td>
					<td>
						<i class="la la-inr"></i>
						{{ ledger.amount }}
					</td>
					<td>{{ ledger.reason }}</td>
					<td>
						<div style="display:flex;justify-content:space-around;" v-if="!ledger.updating">
							<button class="btn-success ks-control" @click="approveLedger(index,ledger.id)">
	                            <span class="ks-icon la la-check"></span>
	                        </button>
	                        <button class="btn-danger ks-control" @click="deleteLedger(index,ledger.id)">
	                            <span class="ks-icon la la-times"></span>
	                        </button>
						</div>
                        <span v-else class="ks-icon la la-refresh la-spin"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	var moment = require('moment');
	export default{
		props : ["approvals"],
		data(){
			return {
				ledgers : this.approvals,
				moment : moment,
			}
		},
		mounted(){

		},
		methods : {
			approveLedger(index, ledgerID){
				var self = this;
				self.$set(self.ledgers[index], 'updating', true);
				axios.post("/trips/"+self.ledgers[index].trip.id+"/ledgers/"+ledgerID+"?_method=PATCH",{ type : 'approval' })
				.then(()=>{
						new Noty({
							'type' :'success' ,
						 	'text' : 'L#'+ledgerID+ ' Approved Successfully',
						 	'timeout' : 4000,
						 	'progressBar' : true,
						}).show();
						self.ledgers = self.ledgers.filter(
							(ledger)=>{
								return (ledger.id !== ledgerID);
							}
						)
					}
				).catch((error)=>{
					console.log(error);
					self.$set(self.ledgers[index], 'updating', false);
						new Noty({
							'type' :'error' ,
						 	'text' : 'Unable to approve',
						 	'timeout' : 4000,
						 	'progressBar' : true,
						}).show()
				});
			},
			deleteLedger(index, ledgerID){
				var self = this;
				self.$set(self.ledgers[index], 'updating', true);
				axios.post("/trips/"+self.ledgers[index].trip.id+"/ledgers/"+ledgerID+"?_method=DELETE").then(
					()=>{
						new Noty({
							'type' :'success' ,
						 	'text' : 'L#'+ledgerID+ ' deleted successfully',
						 	'timeout' : 4000,
						 	'progressBar' : true,
						}).show();
						self.ledgers = self.ledgers.filter(
							(ledger)=>{
								return (ledger.id !== ledgerID);
							}
						)
					}
				).catch((error)=>{
					console.log(error);
					self.$set(self.ledgers[index], 'updating', false);
						new Noty({
							'type' :'error' ,
						 	'text' : 'Unable to approve',
						 	'timeout' : 4000,
						 	'progressBar' : true,
						}).show()
				});
			},
			getTripDetail(trip){
				var html = ""+trip.truck.number+"<br>";
				html += "<a href='/trips/"+trip.id+"'>T#"+trip.id+"</a>";
				html += "<ul>";
				for(var i=0;i<trip.orders.length;i++)
				{
					html += "<li>"
						+"<b>O#"+trip.orders[i].id+"</b>\&nbsp;"
						+trip.orders[i].loading_point.locality
						+ " - "
						+trip.orders[i].unloading_point.locality
						+"</li>";
				}
				html += "</ul>";
				return html;
			},
			getFromTo(object,type){
				switch(type){
					case 'App\\Models\\Trips\\Order' :
						return "O#"+object.id;
					case 'App\\Models\\Trips\\Account' :
						return object.name;
				}
			},
			getDate(date){
				return moment(date).format('lll');
			}
		},
	}
</script>
