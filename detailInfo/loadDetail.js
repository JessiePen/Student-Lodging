// Json file
// 这里是一个公寓的所有信息放一起
// var apartmentDetail={"data":[{"name":"Liberty Prospect Point","coordinates":[53.410888, -2.964813],
//     "location":["60 Moria Street","L61BA"],"property":["shop","restaurants","hospital","bus stop","3-5 en-suite",
//         "6-8 en-suite","studio"],"image":["../House_img/LPP/LPP.jpg","../House_img/LPP/room.jpg","../House_img/LPP/kitchen.jpg"],
//     "comment":["very good apartment, high quality, good security, close to school, nice reception, large kitchen and bright room",
//         "Not as good as I have been told","very good"],
//         "commentor":["Yuhe","Patrick","xie"],"rent":119,"link":"https://www.libertyliving.co.uk/student-accommodation/liverpool/liberty-prospect-point/"}]
// };
var apartmentDetail;
// 修改公寓名
function getAptTitle() {
document.getElementById("name").innerHTML=apartmentDetail.name;
document.getElementById("location").innerHTML=apartmentDetail.location
}

// 修改Json中image属性 改变滚动图片
function changeimg(){
    document.getElementById("image1").src=apartmentDetail.image[0];
    document.getElementById("image2").src=apartmentDetail.image[1];
    document.getElementById("image3").src=apartmentDetail.image[2];
}

// 动态添加comment
function addComment(){	
    var pcontent = document.getElementById("commentbox");
    for(i=0;i<apartmentDetail.comment.length;i++){
        var commentarea = document.createElement("div");
        commentarea.className="commentarea";
        commentarea.style.borderTop="1px solid darkgray";
        pcontent.appendChild(commentarea);

        var bubbleimg=document.createElement("div");
        bubbleimg.className="bubbleimg";
        commentarea.appendChild(bubbleimg);

        var chatimg = document.createElement("img");
        chatimg.src="123.jpg";
        chatimg.style ="height:20px;width: 17px"
        bubbleimg.appendChild(chatimg)

        var username = document.createElement("username");
        username.className="username";
        username.innerHTML=apartmentDetail.commentor[i];
        commentarea.appendChild(username);

        var comment = document.createElement("div");
        comment.className="commentcontent";
        comment.innerHTML=apartmentDetail.comment[i];
        commentarea.appendChild(comment)
    }
	
	var commentButton = document.getElementById("commentButton");
	commentButton.addEventListener("click",insertCom);
	commentButton.addEventListener("click",addNewComment);
	
}

function addPrice() {
var rent =document.getElementById("rent");
rent.innerHTML=apartmentDetail.rent
}

function addLink() {
var link = document.getElementById("link");
    link.setAttribute("href",apartmentDetail.link);
    link.style.color="#23272b"
    link.innerHTML=apartmentDetail.link;
}

// 动态添加属性
function addProperty(){
    var pcontent = document.getElementById("property");
    var styles =["badge badge-primary","badge badge-secondary","badge badge-success","badge badge-danger","badge badge-warning",
        "badge badge-info","badge badge-light"];
    for(var i=0;i<apartmentDetail.property.length;i++){
        var index = Math.floor((Math.random()*styles.length));
        var pptstyle = document.createElement("span");
        pptstyle.className=styles[index];
        pptstyle.style="font-size: 140%";
        pptstyle.innerHTML=apartmentDetail.property[i];
        pcontent.appendChild(pptstyle)
    }
}

window.onload=function() {
    getAptTitle();
    changeimg();
    addComment();
    addProperty();
    addPrice();
    addLink();
	var addFavourite = document.getElementById("addFavourite");
	addFavourite.addEventListener("click",addToFavour);
	
	console.log(addFavourite);
};

// 更改location坐标
    function initMap() {
        var location={lat:apartmentDetail.coordinates[0],lng:apartmentDetail.coordinates[1]};
        var map = new google.maps.Map(document.getElementById("map"),{
            zoom:14,
            center:location
        });
        var marker = new google.maps.Marker({position:location, map:map});
    }
    
    function initComment() {

    }


//insertComment
function insertCom(event){
	var apartmentName = document.getElementById("name");
	var comment = document.getElementById("exampleFormControlTextarea1");
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_insertComment.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			// console.log(xhr.responseText);
		}
	//key=value
	xhr.send("insertComment="+comment.value+"&apartmentName="+apartmentName.innerHTML);
}
//add new comment
function addNewComment(event){
	var user = document.getElementById("username");
	
	var newComment = document.getElementById("exampleFormControlTextarea1");
	
	var pcontent = document.getElementById("commentbox");
	var commentarea = document.createElement("div");
	commentarea.className="commentarea";
	commentarea.style.borderTop="1px solid darkgray";
	pcontent.appendChild(commentarea);
	
	var bubbleimg=document.createElement("div");
	bubbleimg.className="bubbleimg";
	commentarea.appendChild(bubbleimg);
	
	var chatimg = document.createElement("img");
	chatimg.src="123.jpg";
	chatimg.style ="height:20px;width: 17px"
	bubbleimg.appendChild(chatimg)
	
	var username = document.createElement("username");
	username.className="username";
	username.innerHTML= user.innerHTML;
	commentarea.appendChild(username);
	
	var comment = document.createElement("div");
	comment.className="commentcontent";
	comment.innerHTML= newComment.value;
	commentarea.appendChild(comment)
}

function addToFavour(event){
	var apartmentName = document.getElementById("name");
	// console.log(1);
	var comment = document.getElementById("exampleFormControlTextarea1");
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_insertFavourite.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
		alert(xhr.responseText);
		}
	//key=value
	xhr.send("&apartmentName="+apartmentName.innerHTML);
}