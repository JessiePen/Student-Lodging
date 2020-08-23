// var userInfo={
//     "data":[{"name":"Yuhe","commentApt":["Liberty Prospect Point"],"comments":["very good,very good,very good,very good"+
//             "very good,very good,very good,very good"],"favouriteApt":["Liberty Prospect Point","Albert Court","Albert Court"],"favouriteAptImg":["LPP/LPP.jpg","AC/AC.jpg","AC/AC.jpg"]}]
// };
var userInfo;
var checkUser;
$(document).ready(function () {
    $("#showUser").click(function () {
        if(checkUser==0){
            document.getElementById("permission").style.display="block";
            document.getElementById("allboxes").style.display="none";
            document.getElementById("userInfo").style.display="none";
            document.getElementById("recommandContain").style.display="none";
            document.getElementById("publish").style.display="none";
        }else{
            document.getElementById("permission").style.display="none";
            document.getElementById("allboxes").style.display="none";
            document.getElementById("publish").style.display="none";
            document.getElementById("recommandContain").style.display="none";
            document.getElementById("userInfo").style.display="block";
            changeUsserName();
            addComment();
            addFavouriteList();
        }
    });
});

function changeUsserName() {
var username = document.getElementById("username");
    username.innerHTML="Welcome! "+userInfo.name;
}

function addComment() {
var ccontent = document.getElementById("commentbox");
    while(ccontent.hasChildNodes()){
        ccontent.removeChild(ccontent.firstChild);
    }

    for (var i=0;i<userInfo.comments.length;i++){
        var yourComment = document.createElement("div");
        yourComment.className = "yourComment";
        yourComment.style.borderBottom = "lightgray 1px solid";
        ccontent.appendChild(yourComment);

        var wordzone = document.createElement("div");
        wordzone.className = "wordzone";
        yourComment.appendChild(wordzone);

        var aptTitle = document.createElement("div");
        aptTitle.className="aptTitle";
        wordzone.appendChild(aptTitle);

        var aptName = document.createElement("h5")
        aptName.innerHTML = userInfo.commentApt[i];
        aptTitle.appendChild(aptName);

        var content = document.createElement("div");
        content.className="content";
        content.innerHTML=userInfo.comments[i];
        wordzone.appendChild(content);

        var deleteClass= document.createElement("div");
        deleteClass.className="deleteClass";
        yourComment.appendChild(deleteClass);

        var deleteButton = document.createElement("button");
        deleteButton.className = "btn btn-primary deleteButton";
        deleteButton.innerHTML = "Delete";
		deleteButton.setAttribute("id",userInfo.commentId[i]);
        deleteClass.appendChild(deleteButton);
		deleteButton.addEventListener("click",sendComData);
        deleteButton.addEventListener("click",remove);
    }
}

function addFavouriteList() {

    var parent = document.getElementById("nav-profile")
    var ccontent = document.getElementById("listbox");
    while(ccontent.hasChildNodes()){
        ccontent.removeChild(ccontent.firstChild);
    }

    for(var i=0;i<userInfo.favouriteApt.length;i++){

        var card=document.createElement("div");
        card.className="card";
        // card.setAttribute("id","cardId");
        card.style.width="18rem";
        ccontent.appendChild(card);

        var img =document.createElement("img");
        img.className="card-img-top";
        img.style.width=18+"rem";
        img.style.height=170+"px";

        img.src=userInfo.favouriteAptImg[i];
        card.appendChild(img);

        var cardBody = document.createElement("div");
        cardBody.className="card-body";
        card.appendChild(cardBody);

        var aptName = document.createElement("h5");
        aptName.className="card-title";
        aptName.innerHTML = userInfo.favouriteApt[i];
        cardBody.appendChild(aptName);

        var deleteButton = document.createElement("button");
        deleteButton.className="btn btn-primary";
        deleteButton.innerHTML="Delete";
		    deleteButton.setAttribute("id",userInfo.favouriteId[i]);
        cardBody.appendChild(deleteButton);
	    	deleteButton.addEventListener("click",sendFavoData);
	    	deleteButton.addEventListener("click",remove);
                                                      
        var cardbutton = document.createElement("a");
        cardbutton.className = "btn btn-primary detailButton";
        cardbutton.innerHTML = "More Information";
        cardbutton.setAttribute("id", apartmentInfo.name[i]);
        cardbutton.href = "../detailInfo/apartmentDetails.php";
        cardbutton.style.color = "white";
        //cardbutton.addEventListener("click", sendMoreInfor);
        cardBody.appendChild(cardbutton);
    }
}


//sendDataToEnd

function sendComData(event){
	var sendId = event.path[0].id;
	
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_delete.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			console.log(xhr.responseText);
		}
	//key=value
	xhr.send("commentNo="+sendId);
}

function remove(event) {
    var deleteBtn = document.getElementById(event.path[0].id);
    deleteBtn.parentElement.parentElement.remove();
}


function sendFavoData(event){
	var sendId = event.path[0].id;
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_delete.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			// console.log(xhr.responseText);
		}
	//key=value
	xhr.send("favouriteNo="+sendId);
}

function sendFavoAptData(event){
var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_getApartmentName.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			console.log(xhr.responseText);
		}
	xhr.send("apartmentName="+event.path[0].id);
}

