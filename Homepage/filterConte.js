$(document).ready(function () {
$("#showFilter").click(function () {
    $("#filterConteid").slideToggle(500);
});
});

var arr = [];
var priceRange;
var apartmentID=[];

function addToArray(array, obj){
    array.push(obj.value)
}
function removeToArray(array, obj){
    var index = array.indexOf(obj.value);
    if (index > -1) {
        array.splice(index, 1);
    }
}

isContained =(a, b)=>{
    if(!(a instanceof Array) || !(b instanceof Array)) return false;
    if(a.length < b.length) return false;
    var aStr = a.toString();
    for(var i = 0, len = b.length; i < len; i++){
        if(aStr.indexOf(b[i]) == -1) return false;
    }
    return true;
};

function filterNumber(arr){
    var price=arr.filter(function (item) {
        return typeof item === "number";
    });
    return price[0];
}

function addPrior(e) {
    apartmentID=[];
    // if check
    if(e.target.checked){
        addToArray(arr,e.target);
    }else{
        removeToArray(arr,e.target);
    }
    returnFilter();
    console.log(apartmentID);
	addToApartmentInfo();
    console.log(apartmentInfo);
    // loadBrirf();
    // window.location.reload();
    window.onload=loadNewBrief();
}

function addPrice(e) {
    apartmentID=[];
    if(e.target.checked){
        priceRange = e.target.value;
    }else{
        priceRange = undefined;
    }
    returnFilter();
	console.log(apartmentID);
	addToApartmentInfo();
    console.log(apartmentInfo);
    // loadBrirf();
    // window.location.reload();
    window.onload=loadNewBrief();
}


function returnFilter() {
    var truePrice = true;
    for(var i=0;i<filterConditon.length;i++){

        for(var value in filterConditon[i]){
            allarr = filterConditon[i][value];
            price = filterNumber(allarr);

            if(priceRange != undefined){
                truePrice=false;
                switch (priceRange) {
                    case "level1":
                        if (price < 100) {
                            truePrice = true;
                        }
                        break;

                    case "level2":
                        if (price >= 100 && price < 120) {
                            truePrice = true;
                        }
                        break;

                    case "level3":
                        if (price >= 120 && price < 140) {
                            truePrice = true;
                        }
                        break;

                    case "level4":
                        if (price >= 140 && price < 160) {
                            truePrice = true;
                        }
                        break;

                    case "level5":
                        if (price >= 160 && price < 180) {
                            truePrice = true;
                        }
                        break;

                    case "level6":
                        if (price >= 180 && price <= 200) {
                            truePrice = true;
                        }
                        break;

                    case "level7":
                        if (price > 200) {
                            truePrice = true;
                        }
                        break;
                    default:break;
                }
            }

            if(isContained(allarr,arr)&&truePrice){
                if(apartmentID.indexOf(value)==-1){
                    apartmentID.push(value);}
            }
        }
    }
}

$(document).ready(function(){
    var check1 = $('input[name="onecheck"]');
    check1.each(function(i){
        $(this).click(function(){
				for (var i = 0; i < check1.length; i++) {
					if (check1[i].checked) {
						check1[i].checked = false;
					}
				}
				this.checked = true;
        })
    })
});

function loadBrirf() {

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

//filter
function addToApartmentInfo(){
apartmentInfo = {
    	"src" : [],
    	"description" : [],
    	"name" : [],
        "apartmentNo":[]
    };
    for (var i = 0; i < allBoxApartment.src.length; i++) {
		for (var j = 0; j < apartmentID.length; j++) {
            // console.log(allBoxApartment.apartmentNo[i]);
            if (allBoxApartment.apartmentNo[i] == apartmentID[j]) {
				apartmentInfo.src.push(allBoxApartment.src[i]);
				apartmentInfo.name.push(allBoxApartment.name[i]);
				apartmentInfo.description.push(allBoxApartment.description[i]);
				apartmentInfo.apartmentNo.push(allBoxApartment.apartmentNo[i]);
				break;
			}
		}
	}
}

function loadNewBrief() {
       var pcontent = document.getElementById("allboxes");
        while(pcontent.hasChildNodes()){
            pcontent.removeChild(pcontent.firstChild);
        }
        loadBrirf();
}
		