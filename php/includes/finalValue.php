<div>
	<form class='form-horizontal'>
	<div class='control-group'>
		<label class='control-label'>
	    <i class='icon-screenshot' ng-click="calculatorKind = 'netValueMode'"></i>
		Net Value at End
		</label>
		<label class='control-label {{calculatorKind}}-net-value-only net-value-only'> {{finalValue | currency}} </label> 
		<input  type="number" class='{{calculatorKind}}-net-value-hide' ng-model='finalValue' type='text'>
	</div>
	</form>
	</div>