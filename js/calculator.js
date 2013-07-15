
  function $assassin($scope,$http) {
  
  console.log('Assassin: Beta.')
  
  
  
  $scope.register = function() {  	  	  var $name = $scope['username'];	  var $email = $scope['email'];
	  $http({
		method: 'GET', 
		url: 'register.php',
		params: {name:$name,email:$email}
	  }).
	  success(function(data, status, headers, config) {		
		console.log(data, data.errorCode);		console.log(headers(),config);		console.log(data.errorCode);				if (status != 200 || data.errorCode) {			console.log('danger will robinson!');			$('#warning-message').html(data.message).addClass('alert');		} else {					$('#warning-message').html(data.message).addClass('alert alert-success');			$('#registerBtn').hide();				}
	  })	  	  
  
  }
	
}