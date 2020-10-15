<!doctype html>
<html>
  <head>
<?php include_once ("header.php"); ?>
  </head>
  <body>
  <?php include_once ("menu.php"); ?>
    <div class="hero">
      <h1 class="hero__title">PeepoRun2D and RA1G Launcher</h1>
      <p class="hero__description">Official Developer Website</p>
    </div>

    <div class="wrapper">
      <div class="installation">
        <h3 class="section__title">Download links</h3>
        <div class="tab__container">
          <ul class="tab__menu">
		  <li class="tab active" data-tab="win">Windows</li>
            <li class="tab" data-tab="mac">MacOs</li>
            <li class="tab" data-tab="linux">Linux</li>
			<li class="tab" data-tab="android">Android</li>
            <li class="tab" data-tab="centos">CentOS</li>
            
          </ul>
          <pre class="nohighlight code">
            <code class="tab__pane mac">Coming Soon!</code>
            <code class="tab__pane linux">Coming Soon!</code>
			<code class="tab__pane android">Coming Soon!</code>
            <code class="tab__pane centos">Coming Soon!</code>
            <code class="tab__pane active win"><a href="http://www.peeporun2d.ra1g.eu/Game.zip" class="button--primary">Game.zip (28MB)</a>
			<a href="http://www.peeporun2d.ra1g.eu/ra1glauncher_installer.exe" class="button--primary">RA1G Launcher (20MB)</a></code>
          </pre>
        </div>
      </div>
      <div class="feature">
        <div class="feature__item">
          <h3 class="section__title">Fast & Light</h3>
          <p>Start writing your notes immediately in any terminal! No more time wasted on navigating and opening your text editor.</p>
        </div>
        <div class="feature__item">
          <h3 class="section__title">File Syncing</h3>
          <p>Save your file in Dropbox then you can access to it from anywhere.</p>
        </div>
        <div class="feature__item">
          <h3 class="section__title">Secure</h3>
          <p>Encrypt your notes optionally. No one can get to your secrets! </p>
        </div>
        <div class="feature__item">
          <h3 class="section__title">Configuration</h3>
          <p>Maintain all your settings in a single <span class="code code--inline">config.json</span> file. Never need to redo the setting every single time jotting down a note.</p>
        </div>
        <div class="feature__item">
          <h3 class="section__title">Highlightings</h3>
          <p>For better readability, scribbler has a clean, beautiful color scheme allow you to scan files fast.</p>
        </div>
        <div class="feature__item">
          <h3 class="section__title">Keybindings</h3>
          <p>You can expect common keybindings for scribbler. Customize <span class="code code--inline">bindings.json</span> for your own liking! </p>
        </div>
      </div>
      <div class="keybinding">
        <ul class="keybinding__detail">
          <h3 class="keybinding__title">Default keys</h3>
          <li>Pause game <span class="keybinding__label">P</span></li>
          <li>Restart game <span class="keybinding__label">Space</span></li>
          <li>Jump <span class="keybinding__label">Arrow Up / Space</span></li>
          <li>Move <span class="keybinding__label">Arrow Left / Arrow Right</span></li>
        </ul>
       </div>
	        <div class="callout">
        <p>See the people that helped create PeepoRun2D & RA1G Launcher</p>
        <a href="supporters.php" class="button--primary">Supporters</a>
      </div>
    </div>
    <div class="changelog">
      <div class="wrapper">

          <div class="changelog__callout">
          <a href="changelogpr.php" class="button--secondary">See the full changelog</a>
        </div>
      </div>
    </div>
    <footer class="footer">Scribbler is a free HTML template created exclusively for <a href="https://tympanus.net/codrops/" target="_blank" class="link link--light">Codrops</a>.</footer>
    <?php include_once ("footer.php"); ?>
  </body>
</html>