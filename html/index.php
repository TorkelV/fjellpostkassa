<!DOCTYPE html>
<html>
<head>
    <title></title>
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
    <div class="destinations"><p>Mountains</p></div>
    <div class="leaderboard"><p>Leaderboard</p></div>
    <div class="map"><p>Map</p></div>
</div>
<div class="list">
    <div class="item">
        <p>First item</p>
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

<style type="text/css">
    .header {
        width: 100%;
        text-align: center;
        height: 10vh;
        position: fixed;
        background: #ccc;
    }
    .header .menu, .header .destinations, .header .leaderboard, .header .map {
        display: inline-block;
        margin: 0;
    }
    .header .destinations, .header .leaderboard, .header .map {
        font-size: 3em;
    }
    .header .menu {
        width: 13%;
    }
    .header .destinations {
        width: 35%;
    }
    .header .leaderboard {
        width: 35%;
    }
    .header .map {
        width: 15%;
    }
    .list {
        height: 90vh;
        width: 100%;
        padding-top: 10vh;
    }
    .list .item {
        width: 100%;
        height: 20vh;
    }
body {
  margin: 0;
  padding: 0;
}
a {
  text-decoration: none;
  color: #232323;
  
  transition: color 0.3s ease;
}
a:hover {
  color: tomato;
}
#menuToggle {
  display: block;
  position: relative;
  top: 50px;
  left: 50px;
  z-index: 1;
  -webkit-user-select: none;
  user-select: none;
}
#menuToggle input {
  display: block;
  width: 40px;
  height: 32px;
  position: absolute;
  top: -7px;
  left: -5px;
  cursor: pointer;
  opacity: 0; /* hide this */
  z-index: 2; /* and place it over the hamburger */
  -webkit-touch-callout: none;
}
#menuToggle span {
  display: block;
  width: 50px;
  height: 6px;
  margin-bottom: 5px;
  position: relative;
  background: #000;
  border-radius: 3px;
  z-index: 1;
  transform-origin: 4px 0px;
  transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
              opacity 0.55s ease;
}
#menuToggle span:first-child {
  transform-origin: 0% 0%;
}

#menuToggle span:nth-last-child(2) {
  transform-origin: 0% 100%;
}
#menuToggle input:checked ~ span {
  opacity: 1;
  transform: rotate(45deg);
  background: #232323;
}
#menuToggle input:checked ~ span:nth-last-child(3) {
  opacity: 0;
  transform: rotate(0deg) scale(0.2, 0.2);
}
#menuToggle input:checked ~ span:nth-last-child(2) {
  transform: rotate(-45deg) translate(0, -1px);
}
#menu {
    position: absolute;
    width: 300px;
    margin: 32px 0 0 -53px;
    padding: 50px;
    background: #ededed;
    list-style-type: none;
    -webkit-font-smoothing: antialiased;
    transform-origin: 0% 0%;
    transform: translate(-100%, 0);
    transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0);
}
#menu li {
  padding: 10px 0;
  font-size: 22px;
}
#menuToggle input:checked ~ ul {
  transform: none;
}

</style>