<body ng-controller="$assassin">

	<container ng-model='main' >

	<?php include('includes/navbar.php') ; ?>
	<div class='container ng-cloak mainBody'>
	<div class='row'>
	<div class='span6'>
			

		<div class='row'>
		<div class='span4'>
			<h3 class='tk-ff-cocon-web-pro'>Welcome, {{name}}</h3>
			<h4 class='text-error'>There are 4 people hunting you.</h4>
			<h4>Your rank: <span class='bold'>32<span> / 203</h4>
			<h4>KILLS: <span class='bold'>6 DEATHS: 3<span></h4>
			Recently...<br>
			<span class='text-info'>Lighto</span> killed <span class='text-info'>Tiny Tom</span> 12 minutes ago.<br>
			<span class='text-info'>MightyDeathOtter</span> killed <span class='text-info'>RenlysGhost</span> 18 minutes ago. <i class="icon-hand-up"></i><br>
			
		</div>
		<div class='span2'>
			<img class="img-polaroid" src='images/kerrigan.png'>
		</div>
		</div>
		
		<div class='row'>
		<div class='span6'>
		<div class='alert alert-info'>
		<h3>Pre-Register Now for Assassin Game at Atomic Lollipop 2013</h3>
		<form action="#" id="search_form" method="get"> 
			<label>Your Assassin Name </label><input type="text" id="keyword" ng-model='username' name="name" placeholder='RenlysGhost'/> 
			<label>Your Email</label> <input type="text" id="keyword" name="email" ng-model='email'  placeholder='you@atomiclollipop.com'/><br>
		</form>
			<button class='btn btn-primary btn-large' ng-click="register()" id='registerBtn' value="Register Now!" /> Register Now! </button>
			<div id='warning-message'></div>
		</div>
		</div>
		</div>

	

	</div>
	<div class='span5 offset1'>
		<h1 class='text-error'>TARGET</h1>
		<div class='row'>
			<div class='span3'>
				<img class="img-polaroid" src='images/pikachu_cosplay.png'>
				<h3 class='text-error'>Pikachu Guy</h3>
					

					<button type="submit" class="btn btn-danger btn-large btn-block" ng-click='alert("KILL!")'>KILL</button>
					<button type="submit" class="btn  btn-disabled" ng-click='alert("KILL!")'>NEW TARGET (Available in 12:32)</button>

			</div>
			<div class='span2'>
					<h4 class='text-info'>Rank: 12</h2>
					<h4 class='text-info'>Last Known Location: Posing as a Robot in Ruckus Brigade, 16 minutes ago</h2>
				</div>
			</div>
				
	</div>
	</div>
	<h2>11 people are following this.</h2>
	<a href="https://twitter.com/intent/tweet?button_hashtag=ultimatechampionment" class="twitter-hashtag-button" data-related="robotEggplant">Tweet #ultimatechampionment</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<h2>
	
	
	
	
	
	</div>

	</container>
	<spacey/>