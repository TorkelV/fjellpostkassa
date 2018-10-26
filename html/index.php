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
  font-family: "Helvetica";
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
  top: 15px;
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
  margin-bottom: 8px;
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
  transform: rotate(45deg) translate(-2px, -1px);
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
    margin: 69px 0 0 -53px;
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
.image {
    width: 30%;
    padding-right: 15px;
    display: inline-block;
}
.content {
    height: 100%;
    width: 65%;
    display: inline-block;
}
.image .itemimage {
    height: 100%;
    width: 100%;
}
.image .visits {
    height: 20px;
    width: 100%;
    text-align: right;
    font-size: 30px;
}
.title {
    width: 100%;
    height: 40%;
}
.subcontent {
    width: 100%;
    height: 55%;
}
.content {
    font-size: 40px;
    padding-left: 20px;
}
.contentname {
    height: 100%;
    width: 70%;
    display: inline-block;
}
.contentheight {
    height: 100%;
    width: 25%;
    display: inline-block;
    padding-right: 15px;
}
.totalvisits, .lastvisit{
    width: 100%;
    height: 48%;
    margin: 0;
}


</style>