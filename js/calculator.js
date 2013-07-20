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
		.when('/admin/game/:id/addUsers', {
		  templateUrl: 'routes/addUsers.html',
		  controller: 'GameDashboard'			
		})
		.when('/admin/game/:id/editUsers', {
		  templateUrl: 'routes/EditUsers.html',
		  controller: 'GameDashboard'			
		})
		.when('/admin/game/:id/gameSettings', {
		  templateUrl: 'routes/gameSettings.html',
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
			//	$scope.users = data;
			//	$scope.name = '';
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
	  .controller('AllGames', function AllGames($scope, $rootScope, $http) {
	  
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
				$scope.games = data;
				$rootScope.games = data;
				return;
				
			  })	  	  
		  }
		
	
	})
	.controller('GameDashboard' , function GameDashboard($scope, $http, $routeParams) {
	
	
		$scope.gameName = 'Loading...';
		$scope.gameID = $routeParams.id;
		
		getGameInfo();
		var getGamesInterval = setInterval(getGameInfo, 2000);	
		
		$scope.$on("$destroy", function(){
        clearInterval(getGameInfo);
		});
		
		function getGameInfo() {
			$http({
				method: 'GET', 
				url: 'database.php',
				params: {
					function:'getGameInfo',
					id:$routeParams.id
				}
			  }).
			  success(function(data, status, headers, config) {		
				
				//console.log(data, data.errorCode);
				$scope.gameName = data[0].name;
				$scope.game = data[0];
				$scope.users = data.users;
				console.log($scope.users);
				
			  })
		 }

		$scope.removed_user_name = 'Jimmy the kid';
		$scope.removed_user_id = 'Jimmy 420 kid';
		
		$scope.handleRemovedUserPrompt = function ($user_id, $user_name) {

			$scope.removed_user_id = $user_id;
			$scope.removed_user_name = $user_name;
		
		}
		
		$scope.removePlayerFromGame = function ( $game_id , $user_id) {
		
			console.log('remove player from game...' , $user_id, $game_id)
			$http({
			method: 'GET', 
			url: 'database.php',
			params: {
				function:'removeUserFromGame',
				user_id:$user_id,
				game_id:$game_id
			}
		  }).
		  success(function(data, status, headers, config) {		
			
			console.log(data, data.errorCode);
			
		  })
		
		
		
		}
	
	
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
				
				//console.log(data, data.errorCode);
				
			  })
		
		
		}
	
	})
	
	.controller('GameDashboardUserView', function GameDashboardUserView($scope, $http, $routeParams) {
	
	//	console.log('gduv');
	
		$scope.completePursuit= function ($id) {
		
			console.log('id?' , $id);
			console.log('complete pursuit...');
			$http({
				method: 'GET', 
				url: 'database.php',
				params: {
					function:'completePursuit',
					id:$id
				}
			  }).
			  success(function(data, status, headers, config) {		
				console.log('finished...');
				console.log(data, data.errorCode);
			//	$scope.gameName = data[0].name;
			//	$scope.game = data[0];
			//	$scope.users = data.users;
				
			  })
		 }
	
	
	});

	
