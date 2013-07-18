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
		.when('/admin', {
		  templateUrl: 'routes/adminMain.html',
		  controller: 'AdminMain'			
		})
		.when('/admin/game/:id', {
		  templateUrl: 'routes/gameDashboard.html',
		  controller: 'GameDashboard'			
		})
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
	.controller('AllUsers', function AllUsers($scope, $http) {
		
		getUsers();
		var getUsersInterval = setInterval(getUsers, 2000);	
		
		$scope.$on("$destroy", function(){
        clearInterval(getUsersInterval);
		});
		
		function getUsers() {
			 $http({
				method: 'GET', 
				url: 'database.php',
				params: {function:'getAllUsers'}
			  }).
			  success(function(data, status, headers, config) {		
				
			//	console.log(data, data.errorCode);
				$scope.users = data;
				return;
				
			  })	  	  
		  }
		  
		
	
	})
	.controller('AllGameUsers', function AllGameUsers($scope, $http, $routeParams) {
		
		getGameUsers();
		var getGameUsersInterval = setInterval(getGameUsers, 2000);	
		
		$scope.$on("$destroy", function(){
        clearInterval(getGameUsersInterval);
		});
		
		function getGameUsers() {
			 $http({
				method: 'GET', 
				url: 'database.php',
				params: {function:'getAllGameUsers',game_id:$routeParams.id}
			  }).
			  success(function(data, status, headers, config) {		
				
				$scope.gameUsers = data;
				console.log(data);
				return;
				
			  })	  	  
		  }
		  
		
	
	})
	.controller('AdminMain', function AdminMain($scope) {

	
	})
	.controller('AddUser', function AddUser($scope, $http) {
	
		$scope.addUser = function() {
		
			console.log('adding user...');	
		
			$http({
				method: 'GET', 
				url: 'database.php',
				params: {
					function:'addUser',
					name:$scope.name,
					email:$scope.email
				}
			  }).
			  success(function(data, status, headers, config) {		
				
			//	console.log(data, data.errorCode);
				$scope.users = data;
				$scope.name = '';
				$scope.email = '';
				
			  })

		};	  	  
	  })
	  .controller('CreateGame', function CreateGame($scope, $http) {
	  
		$scope.createGame = function() {
		
			console.log('creating game...');	
			console.log($scope.name)
		
			$http({
				method: 'GET', 
				url: 'database.php',
				params: {
					function:'createGame',
					name:$scope.name
				}
			  }).
			  success(function(data, status, headers, config) {		
				
				console.log(data, data.errorCode);
				
			  })

		};	  	  
	  
	  
	  })
	  .controller('AllGames', function AllGames($scope, $http) {
	  
		getGames();
		var getGamesInterval = setInterval(getGames, 2000);	
		
		$scope.$on("$destroy", function(){
        clearInterval(getGamesInterval);
		});
		
		function getGames() {
		
			 $http({
				method: 'GET', 
				url: 'database.php',
				params: {function:'getAllGames'}
			  }).
			  success(function(data, status, headers, config) {		
				console.log(data);
				$scope.games = data;
				return;
				
			  })	  	  
		  }
		
	
	})
	.controller('GameDashboard' , function GameDashboard($scope, $http, $routeParams) {
	
		console.log('game dashboard');
		console.log($routeParams);
		$scope.gameName = 'Loading...';
		
		$http({
			method: 'GET', 
			url: 'database.php',
			params: {
				function:'getGameInfo',
				id:$routeParams.id
			}
		  }).
		  success(function(data, status, headers, config) {		
			
			console.log(data, data.errorCode);
			$scope.gameName = data[0].name;
			$scope.game_id = data[0].id;
			
		  })

	
	
	
	})
	.controller('GameUserView' , function GameUserView($scope, $http, $routeParams) {
	
		console.log('game user view');
		
		$scope.addUserToGame = function (user_id, game_id) {
		
			console.log('add user to game' , user_id , game_id);
			
			$http({
				method: 'GET', 
				url: 'database.php',
				params: {
					function:'enrolUser',
					user_id:user_id,
					game_id:game_id
				}
			  }).
			  success(function(data, status, headers, config) {		
				
				console.log(data, data.errorCode);
				
			  })
		
		
		}
	
	})

	
