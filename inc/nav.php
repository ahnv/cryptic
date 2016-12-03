<?php $loggedin = $log->isLoggedIn();?><nav class="main-nav-outer" id="test">
<div class="container">
<ul class="main-nav">
<li class="small-logo"><a href="index"><img src="<?php echo SSTATIC; ?>img/small-logo.png" alt=""></a></li>
<?php if ($loggedin): ?>
<li><a href="play">Play</a></li>
<?php endif;?>
<li><a href="leaderboard">Leaderboard</a></li>
<li><a href="rules">Rules</a></li>
<?php if (!$loggedin): ?>
<li><a href="index">Login</a></li>
<?php endif;?>
<?php if ($loggedin): ?>
<li><a href="logout">Logout</a></li>
<?php endif;?>
</ul>
<a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
</div>
</nav>