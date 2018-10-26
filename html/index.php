<!DOCTYPE html>
<html>
<head>
    <title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="app.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="header">
    <div class="menu">
        <nav role="navigation">
          <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
              <a href="#"><li>Hjem</li></a>
              <a href="#"><li>Profil</li></a>
              <a href="#"><li>Om appen</li></a>
              <a href="#"><li>Kontakt oss</li></a>
              <a href="#"><li>Logg ut</li></a>
            </ul>
          </div>
        </nav>
    </div>
    <div class="destinations"><p class="fjell">Fjell</p></div>
    <div class="leaderboard"><p class="rangering">Rangering</p></div>
    <div class="map"><p class="kart">Kart</p></div>
</div>
<div class="list">
    <div class="item">
        <div class="image">
            <p class="visits">2</p>
            <img class="itemimage" src="1.jpg">
        </div>
        <div class="content">
            <div class="title">
                <div class="contentname"><p>Lyshorn</p></div>
                <div class="contentheight"><p>300 moh</p></div>
            </div>
            <div class="subcontent">
                <p class="totalvisits">Antall besøk: 5</p>
                <p class="lastvisit">Siste besøkende: Torkel V.</p>
            </div>
        </div>
    </div>
    <div class="item">
        <p>Second item</p>
    </div>
    <div class="item">
        <p>Third item</p>
    </div>
    <div class="item">
        <p>Fourth item</p>
    </div>
    <div class="item">
        <p>Fifth item</p>
    </div>
</div>
</body>
</html>
