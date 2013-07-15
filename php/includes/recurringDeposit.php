	<div>
<form class='form-horizontal'>
	<div class='control-group'>
		<label class='control-label'>Recurring Deposit</label>
		<div class="input-prepend input-append">
		<input type="number" ng-model='recurringPayment' type='text'>
		</div>
		<div class='btn-group' data-toggle='buttons-radio'>
			<button class='btn' ng-click="depositFreq = 'yearly'">Yearly</button>
			<button class='btn btn-active active' ng-click="depositFreq = 'monthly'">Monthly</button>
		</div>
	</div>
</form>
	
	</div>