// var searchApartmentID=[1,2];
var searchApartmentID;
$(document).ready(function () {
	var searchText = document.getElementById("searchText");
	searchText.addEventListener("keyup",sendSearchContent);
	var searchBtn = document.getElementById("button-addon2");
	searchBtn.addEventListener("click",sendSearchContent);
	var publishBtn = document.getElementById("showPubish");
	publishBtn.addEventListener("click",addPublish);
});

function addPublish(){
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_search.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
		searchApartmentID = JSON.parse(xhr.responseText);
		// setTimeout(function(){
		// 	search();
		// },1000);
		search();
	}
	//key=value
	xhr.send("searchApt="+searchText.value);
}

function search() {
    addToApartmentInfo2();
    window.onload=loadNewBrief2();
}

function sendSearchContent(){
	var searchText = document.getElementById("searchText");
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_search.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
		searchApartmentID = JSON.parse(xhr.responseText);
		// setTimeout(function(){
		// 	search();
		// },1000);
		search();
	}
	//key=value
	xhr.send("searchApt="+searchText.value);
}
function loadBrirf2() {

    var cparent = document.getElementById("allboxes");
    for (var i = 0; i < apartmentInfo.src.length; i++) {
        var ccontent = document.createElement("div");
        ccontent.className = "box";
        cparent.appendChild(ccontent);

        var boximg = document.createElement("div");
        boximg.className = "box_img";
        ccontent.appendChild(boximg);

        var img = document.createElement("img");
        img.setAttribute("class","imgstyle");
        img.style.backgroundImage = apartmentInfo.src[i];

        boximg.appendChild(img);

        var cardbody = document.createElement("div");
        cardbody.className = "card-body";
        ccontent.appendChild(cardbody);

        var cardtitle = document.createElement("h5");
        cardtitle.className = "card-title";
        cardtitle.innerHTML = apartmentInfo.name[i];
        cardbody.appendChild(cardtitle);

        var cardtext = document.createElement("p");
        cardtext.className = "card-text";
        cardtext.innerHTML = apartmentInfo.description[i];
        cardbody.appendChild(cardtext);

        var cardbutton = document.createElement("a");
        cardbutton.className = "btn btn-primary detailButton";
        cardbutton.innerHTML = "More Information";
        cardbutton.setAttribute("id", apartmentInfo.name[i]);
        cardbutton.href = "../detailInfo/apartmentDetails.php";
        cardbutton.style.color = "white";
        cardbutton.addEventListener("click", sendMoreInfor);
        cardbody.appendChild(cardbutton);
    }
}

function addToApartmentInfo2(){
    apartmentInfo = {
        "src" : [],
        "description" : [],
        "name" : [],
        "apartmentNo":[]
    };
    for (var i = 0; i < allBoxApartment.apartmentNo.length; i++) {
        for (var j = 0; j < searchApartmentID.length; j++) {
            if (allBoxApartment.apartmentNo[i] == searchApartmentID[j]) {
                apartmentInfo.src.push(allBoxApartment.src[i]);
                apartmentInfo.name.push(allBoxApartment.name[i]);
                apartmentInfo.description.push(allBoxApartment.description[i]);
                apartmentInfo.apartmentNo.push(allBoxApartment.apartmentNo[i]);
            }
        }
    }
}

function loadNewBrief2() {
    var pcontent = document.getElementById("allboxes");
    while(pcontent.hasChildNodes()){
        pcontent.removeChild(pcontent.firstChild);
    }
    loadBrirf2();
}