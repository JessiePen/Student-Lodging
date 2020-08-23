var apartmentInfo;

window.onload = function () {
	//新加的移除box
	// var originalBox = document.getElementsByClassName("box");
	// if (originalBox.length >0) {
	// 	for (var i = 0; i < originalBox.length; i++) {
	// 		originalBox[i].remove();
	// 	}
	// }
	// var cparent = document.getElementById("allboxes");
    // for(var i=0;i<apartmentInfo.src.length;i++){
    //     var ccontent = document.createElement("div");
    //     ccontent.className="box";
    //     cparent.appendChild(ccontent);
    //
    //     var boximg = document.createElement("div");
    //     boximg.className="box_img";
    //     ccontent.appendChild(boximg);
    //
    //     var img = document.createElement("img");
    //     img.style.backgroundImage = apartmentInfo.src[i];
    //
    //     boximg.appendChild(img);
    //
    //     var cardbody = document.createElement("div");
    //     cardbody.className="card-body";
    //     ccontent.appendChild(cardbody);
    //
    //     var cardtitle = document.createElement("h5");
    //     cardtitle.className="card-title";
    //     cardtitle.innerHTML=apartmentInfo.name[i];
    //     cardbody.appendChild(cardtitle);
    //
    //     var cardtext = document.createElement("p");
    //     cardtext.className="card-text";
    //     cardtext.innerHTML=apartmentInfo.description[i];
    //     cardbody.appendChild(cardtext);
    //
    //     var cardbutton = document.createElement("a");
    //     cardbutton.className="btn btn-primary detailButton";
    //     cardbutton.innerHTML="More Information";
	// 	cardbutton.setAttribute("id",apartmentInfo.name[i]);
    //     cardbutton.href="../detailInfo/apartmentDetails.php";
    //     cardbutton.style.color="white";
	// 	cardbutton.addEventListener("click",sendMoreInfor);
    //     cardbody.appendChild(cardbutton);
    // }
    loadBrirf();
    document.getElementById("briefContent").style.display="block";
};


function loadBrirf() {
    // var originalBox = document.getElementsByClassName("box");
    // if (originalBox.length > 0) {
    //     for (var i = 0; i < originalBox.length; i++) {
    //         originalBox[i].remove();
    //     }
	// 	console.log(allBoxApartment);
    //     apartmentInfo=[];
    // }
	//
    var cparent = document.getElementById("allboxes");
    for (var i = 0; i < apartmentInfo.src.length; i++) {
        var ccontent = document.createElement("div");
        ccontent.className = "box";
        cparent.appendChild(ccontent);

        var boximg = document.createElement("div");
        boximg.className = "box_img";
        ccontent.appendChild(boximg);

        var img = document.createElement("img");
        img.style.backgroundImage = apartmentInfo.src[i];
        img.className="imgstyle";
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

function sendMoreInfor(event){
    console.log(event);
    var xhr = new XMLHttpRequest();

    xhr.open('POST',"../php/p_getApartmentName.php");

    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        console.log(xhr.responseText);
    };
    //key=value
    xhr.send("apartmentName="+event.path[0].id);
}