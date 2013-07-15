<div>
	<form class='form-horizontal'>
	<div class='control-group'>
		<label class='control-label' title='Average Annual Compound Rate of Return'>
		<i class='icon-screenshot' ng-click="calculatorKind = 'interestMode'"></i>
		<i class='icon-question-sign'></i> 
			Interest Rate 
		</label>
		<label class='control-label {{calculatorKind}}-interest-mode-only interest-mode-only'>{{interestRate}}%</label> 
		<input type="number" ng-model='interestRate' class='{{calculatorKind}}-interest-mode-hide' type='text'>
		<label class='control-label {{calculatorKind}}-interest-mode-only interest-mode-only' id='interestError'></label> 
	</div>
	</form>
	</div>