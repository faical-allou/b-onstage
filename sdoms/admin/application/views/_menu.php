<script type="text/javascript">
var menu_id = '<?=$menu_id?>';
</script>

<div id="menu">
	<div class="sidebar-nav">
		<ul class="nav nav-list">
		  <li id="dashboard-menu"><a href="<?=site_url('admin')?>">Dashboard</a></li>
		  <li id="stage-menu"><a href="<?=site_url('stage')?>">Stages</a></li>
		  <li id="artist-menu"><a href="<?=site_url('artist')?>">Artists</a></li>
		  <li id="tool-menu"><a href="<?=site_url('tools')?>">Tools</a></li>

          <li class="divider"></li>
		  <li><a href="<?=site_url('logout')?>">Logout</a></li>
		</ul>
	</div>
</div>