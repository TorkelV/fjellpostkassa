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



totalUniqueVisits().then(e=>console.log(e));
totalVisits().then(e=>console.log(e));
allVisitsForMountain("1").then(e=>console.log(e));
userRankMountains("1").then(e=>console.log(e));
userRankVisits("1").then(e=>console.log(e));
mountainVisitsForUser("1","1").then(e=>console.log(e));