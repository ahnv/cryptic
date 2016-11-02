<?php $loggedin = $log->isLoggedIn();?><nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.html">nCrypt</a></div>
<div class="navbar-default sidebar" role="navigation"><div class="sidebar-nav navbar-collapse">
<ul class="nav" id="side-menu">
<?php if (!$loggedin): ?>
<li>
<a href="index"><i class="fa fa-sign-in fa-fw"></i> Log In</a>
</li>
<?php endif;?>
<?php if ($loggedin): ?>
<li>
<a href="play"><i class="fa fa-play fa-fw"></i> Play</a>
</li>
<?php endif;?>
<li>
<a href="leaderboard"><i class="fa fa-list-ol fa-fw"></i> Leaderboard</a>
</li>
<li>
<a href="rules"><i class="fa fa-pencil fa-fw"></i> Rules</a>
</li>
<?php if ($loggedin): ?>
<li>
<a href="logout"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
</li>
<?php endif;?>
</ul>
</div>
</div>
</nav>
