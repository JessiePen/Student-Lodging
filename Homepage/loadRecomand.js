// var recommandation = {
//     "data":[{"popularname":["Liberty Prospect Point","Albert Court","Capital Gate"],"popularimg":["../House_img/LPP/LPP.jpg","../House_img/AC/AC.jpg","../House_img/AC/AC.jpg"],
//         "newestname":["Liberty Prospect Point","Albert Court","Capital Gate"],"newestimg":["../House_img/LPP/LPP.jpg","../House_img/AC/AC.jpg","../House_img/AC/AC.jpg"]}]
// };
var recommandation;

$(document).ready(function () {
    $("#showRec").click(function () {
        document.getElementById("allboxes").style.display="none";
        document.getElementById("publish").style.display="none";
        document.getElementById("userInfo").style.display="none";
        document.getElementById("permission").style.display="none";
        document.getElementById("recommandContain").style.display="block";
        getPopular();
        getNew();
        addId();
    });
});

function getPopular() {
    document.getElementById("popularimg1").src = recommandation.popularimg[0];
    document.getElementById("popularimg2").src = recommandation.popularimg[1];
    document.getElementById("popularimg3").src = recommandation.popularimg[2];

    document.getElementById("popularname1").innerHTML=recommandation.popularname[0];
    document.getElementById("popularname2").innerHTML=recommandation.popularname[1];
    document.getElementById("popularname3").innerHTML=recommandation.popularname[2];
}

function getNew() {
    document.getElementById("newimg1").src = recommandation.newestimg[0];
    document.getElementById("newimg2").src = recommandation.newestimg[1];
    document.getElementById("newimg3").src = recommandation.newestimg[2];

    document.getElementById("newname1").innerHTML=recommandation.newestname[0];
    document.getElementById("newname2").innerHTML=recommandation.newestname[1];
    document.getElementById("newname3").innerHTML=recommandation.newestname[2];
}
function addId(){
    var p1 = document.getElementById("p1");
    var p2 = document.getElementById("p2");
    var p3 = document.getElementById("p3");
    var n1 = document.getElementById("n1");
    var n2 = document.getElementById("n2");
    var n3 = document.getElementById("n3");
    
    p1.addEventListener("click",sendMoreRecommandInfor);
    p2.addEventListener("click",sendMoreRecommandInfor);
    p3.addEventListener("click",sendMoreRecommandInfor);
    n1.addEventListener("click",sendMoreRecommandInfor);
    n2.addEventListener("click",sendMoreRecommandInfor);
    n3.addEventListener("click",sendMoreRecommandInfor);
    
    p1.setAttribute("name",recommandation.popularname[0]);
  	p2.setAttribute("name",recommandation.popularname[1]);
    p3.setAttribute("name",recommandation.popularname[2]);
	  n1.setAttribute("name",recommandation.newestname[0]);
  	n2.setAttribute("name",recommandation.newestname[1]);
	  n3.setAttribute("name",recommandation.newestname[2]);
	  
    p1.setAttribute("href","../detailInfo/apartmentDetails.php");
  	p2.setAttribute("href","../detailInfo/apartmentDetails.php");
    p3.setAttribute("href","../detailInfo/apartmentDetails.php");
	  n1.setAttribute("href","../detailInfo/apartmentDetails.php");
  	n2.setAttribute("href","../detailInfo/apartmentDetails.php");
	  n3.setAttribute("href","../detailInfo/apartmentDetails.php");
    console.log(n1);
}

function sendMoreRecommandInfor(event){
    
	console.log(event.path[0].name);
	var xhr = new XMLHttpRequest();

    xhr.open('POST',"../php/p_getApartmentName.php");

    xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        console.log(xhr.responseText);
    };
    //key=value
    xhr.send("apartmentName="+event.path[0].name);
}

