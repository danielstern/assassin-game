<div>
	<form class='form-horizontal'>
	<div class='control-group'>
	<label class='control-label'>Timeframe</label>
	<div class="input-append input=prepend">
		<label class='control-label {{calculatorKind}}-timeFrame-mode-only timeFrame-mode-only'>{{timeFrame}}</label> 
		<input type="number" class='{{calculatorKind}}-timeFrame-mode-hide' ng-model='timeFrame' type='text'></input>
	</div>
		<div class='btn-group' data-toggle='buttons-radio'>
			<button class='btn active' ng-click="timeKind = 'yearly'">Years</button>
			<button class='btn' ng-click="timeKind = 'monthly'">Months</button>
		</div>
	</div>
	</form>
	</div>