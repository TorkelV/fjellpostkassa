async function totalUniqueVisits(){
	return await $.get( "http://localhost:8080/total-unique-visits/");
}

async function totalVisits(){
	return await $.get( "http://localhost:8080/total-visits/");
}

async function allVisitsForMountain(mountainid){
	return await $.get( "http://localhost:8080/all-visits-mountain/"+mountainid);
}

async function userRankMountains(userid){
	return await $.get( "http://localhost:8080/user-rank-mountains/"+userid);
}

async function userRankVisits(userid){
	return await $.get( "http://localhost:8080/user-rank-visits/"+userid);
}

async function mountainVisitsForUser(userid, mountainid){
	return await $.get(`http://localhost:8080/visits-mountain-for-user/${userid}/${mountainid}`);
}

async function getGuestbook(mountainid){
	return await $.get(`http://localhost:8080/get-guestbook/${mountainid}`);
}

async function getMountains(userid){
	return await $.get(`http://localhost:8080/get-mountains/${userid}`);
}



totalUniqueVisits().then(e=>console.log(e));
totalVisits().then(e=>console.log(e));
allVisitsForMountain("1").then(e=>console.log(e));
userRankMountains("1").then(e=>console.log(e));
userRankVisits("1").then(e=>console.log(e));
mountainVisitsForUser("1","1").then(e=>console.log(e));
getMountains().then(e=>console.log(e));
getGuestbook("1",).then(e=>console.log(e));



var app = new Vue({
            el: '#app',
            data: {
                
            },
            computed: {
				mountainid () {
					return jQuery.url().param("mountainid");
				},
				userid () {
					return jQuery.url().param("user");
				}
            },
			asyncComputed: {
				mountains () {
				  return getMountains(this.userid).then(e=>e.map(o=>(o.img=o.mountainid+".jpg",o)));
				},
				guestbook (){
					return getGuestbook(this.mountainid).then(e=>e.map(a=>(a.visittime=new Date(a.visittime).toLocaleString('en-GB').slice(0,-3),a)));
				},
				mountainLeaderboard(){
					return allVisitsForMountain(this.mountainid).then(e=>e);
				},
				leaderboardTotal(){
					return totalVisits().then(e=>e);
				},
				leaderboardUnique(){
					return totalUniqueVisits().then(e=>e);
				}
			},
            watch: {
              uploaded: function(uploaded){
              } 
            },
            methods: {
                location (mountainid) {
					location.href="guestbook.html?mountainid="+mountainid
				},
				locationLeaders (mountainid){
					location.href="leaders.html?mountainid="+mountainid
				}
            }
        })