var checkUser;
$(document).ready(function () {

    $("#showPublish").click(function () {
        if(checkUser==0){
            document.getElementById("permission").style.display="block";
            document.getElementById("allboxes").style.display="none";
            document.getElementById("userInfo").style.display="none";
            document.getElementById("recommandContain").style.display="none";
            document.getElementById("publish").style.display="none";
        }else{
            document.getElementById("allboxes").style.display="none";
            document.getElementById("userInfo").style.display="none";
            document.getElementById("recommandContain").style.display="none";
            document.getElementById("permission").style.display="none";
            document.getElementById("publish").style.display="block";

            upload1();
            upload2();
            upload3();
        }
        console.log(checkUser);
    });
});


$(document).ready(function () {
    $("#addButton").click(function () {
		var img1 = document.getElementById("img1");
		console.log(img1.value);
        var pcontent = document.getElementById("roomtype")
		
        var formrow = document.createElement("div");
        formrow.className="form-row";
        pcontent.appendChild(formrow)

        var formgroup = document.createElement("div");
        formgroup.className="form-group col-md-4";
        formrow.appendChild(formgroup);

        var formcontrol = document.createElement("select");
        formcontrol.className="form-control";
		//Set new attribute
		formcontrol.setAttribute("name","roomType[]");
        formgroup.appendChild(formcontrol);

        var optionselect = document.createElement("option");
        optionselect.innerHTML="Choose...";
        optionselect.selected=true;
        formcontrol.appendChild(optionselect);

        var option1 = document.createElement("option");
        option1.innerHTML="3-5En-suite";
        formcontrol.appendChild(option1);

        var option2 = document.createElement("option");
        option2.innerHTML="6-8En-suite";
        formcontrol.appendChild(option2);

        var option3 = document.createElement("option");
        option3.innerHTML="classicStudio";
        formcontrol.appendChild(option3);

        var option4 = document.createElement("option");
        option4.innerHTML="premiumStudio";
        formcontrol.appendChild(option4);

        var price = document.createElement("div");
        price.className="form-group col-md-2";
        formrow.appendChild(price);

        var input = document.createElement("input");
        input.type="text";
        input.className="form-control";
		input.setAttribute("name","price[]");
        price.appendChild(input)
    });
});

function upload1() {
    var img1= document.querySelector('#dropBox');
    var uploadimg = document.querySelector('#img1');

    uploadimg.addEventListener('change',function () {
        var file = this.files[0];

        if(file.type.indexOf("image"==0)){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function (e) {
                var newUrl = this.result;
				sendImg(1,newUrl);
				console.log(111);
                img1.style.backgroundImage='url(' + newUrl + ')';
            };
        }
    })
}

function upload2() {
    var img1= document.querySelector('#dropBox2');
    var uploadimg = document.querySelector('#img2');

    uploadimg.addEventListener('change',function () {
        var file = this.files[0];

        if(file.type.indexOf("image"==0)){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function (e) {
                var newUrl = this.result;
				sendImg(2,newUrl);
				console.log(222);
                img1.style.backgroundImage='url(' + newUrl + ')';
            };
        }
    })
}

function upload3() {
    var img1= document.querySelector('#dropBox3');
    var uploadimg = document.querySelector('#img3');

    uploadimg.addEventListener('change',function () {
        var file = this.files[0];

        if(file.type.indexOf("image"==0)){
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function (e) {
                var newUrl = this.result;
				sendImg(3,newUrl);
				console.log(333);
                img1.style.backgroundImage='url(' + newUrl + ')';
            };
        }
    })
}


var mylatitude=0;
var mylongitude=0;
function getLatLngByZipcode(event)
{
	zipcode = event.path[0].value;
    var geocoder = new google.maps.Geocoder();
    var address = zipcode;
    geocoder.geocode({ 'address': 'zipcode '+address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            mylatitude = results[0].geometry.location.lat();
            mylongitude = results[0].geometry.location.lng();
			sendPostcode(mylatitude,mylongitude);
            return[mylatitude,mylongitude]
        }
        else {
            alert("Request failed.")
        }
    });
	
	
}

function sendPostcode(latitude, longitude){
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_addCoordinate.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			console.log(xhr.responseText);
		}
	//key=value
	xhr.send("latitude="+latitude+"&longitude="+longitude);
}

function sendImg(id,url){
	var xhr = new XMLHttpRequest();
	
	xhr.open('POST',"../php/p_addUrl.php");
	
	xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
	
	xhr.onload = function(){
			console.log(xhr.responseText);
		}
	//key=value
	if (id == 1) {
		xhr.send("url1="+url);
	} else if(id == 2){
		xhr.send("url2="+url);
	}else if(id ==3){
		xhr.send("url3="+url);
	}
}