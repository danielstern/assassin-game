angular
	.module('assassin', [])
	.config(function($routeProvider) {
      $routeProvider
	    .when('/dashboard/:id', {
	      templateUrl: 'routes/dashboard.html',
	      controller: 'Dashboard'
	    })
		.when('/', {
		  templateUrl: 'routes/dashboard.html',
		  controller: 'Dashboard'
		})  
		.when('/admin') {
		  templateUrl: 'routes/adminMain.html',
		  controller: 'AdminMain'			
		}
      })
	.controller('Dashboard', function Dashboard($scope, $http, $routeParams) {
	
		console.log('giddyup');
	
		$scope.name = $routeParams.id;
	
		$scope.register = function() {  	  	  var $name = $scope['username'];	  var $email = $scope['email'];
		  $http({
			method: 'GET', 
			url: 'register.php',
			params: {name:$name,email:$email}
		  }).
		  success(function(data, status, headers, config) {		
			console.log(data, data.errorCode);
			console.log(headers(),config);		
			console.log(data.errorCode);				
			if (status != 200 || data.errorCode || !data.message) {			
				console.log('danger will robinson!');			
				var msg = (data.message) ? data.message : 'No message at this time.';
				$('#warning-message').html(msg).addClass('alert');	
				} else {					
				$('#warning-message').html(data.message).addClass('alert alert-success');			
				$('#registerBtn').hide();				
			}
		  })	  	  
	  
		}	
	})
	.controller('AdminMain', function AdminMain($scope, $http) {
		
		console.log('controllertime...');
	
	});
  