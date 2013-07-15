
  function $assassin($scope,$http) {
  
  console.log('Assassin: Beta.')
  
  $scope.name = "RenlysGhost";
  
  var $name = $scope['name'];
  var $email = $scope['email'];
  
  $scope.register = function() {
	  
	  $http({
		method: 'GET', 
		url: 'http://www.danielstern.ca/assassin/register.php',
		params: {name:$name,email:$email}
		}).
	  success(function(data, status, headers, config) {
		// this callback will be called asynchronously
		// when the response is available
		console.log(data,status)
	  })
	console.log('hello...')
  
  }
	
}