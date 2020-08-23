<?php 
session_start();
include_once "../php/p_getApartment.php";
?>
<!DOCTYPE html><meta charset="UTF-8">
<html lang="en">
<head>
    
    <title>Details</title>
    <link rel="stylesheet" href="../bootstrapFile/bootstrap.min.css">
    <link href="detailframe.css" type="text/css" rel="stylesheet">

    <script src="../jquery-3.4.1.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="../bootstrapFile/bootstrap.min.js"></script>

    <script src="loadDetail.js"></script>
    <script>
        // var apartmentDetail={"name":"Liberty Prospect Point","coordinates":[53.410888, -2.964813],
        //         "location":["60 Moria Street","L61BA"],"property":["shop","restaurants","hospital","bus stop","3-5 en-suite",
        //             "6-8 en-suite","studio"],"image":["../House_img/LPP/LPP.jpg","../House_img/LPP/room.jpg","../House_img/LPP/kitchen.jpg"],
        //         "comment":["very good apartment, high quality, good security, close to school, nice reception, large kitchen and bright room",
        //             "Not as good as I have been told","very good"],
        //         "commentor":["Yuhe","Patrick","xie"],"rent":119,"link":"https://www.libertyliving.co.uk/student-accommodation/liverpool/liberty-prospect-point/"
        // };
			var apartmentDetail = eval(<?php echo $detailJson;?>);
			window.apartmentDetail = apartmentDetail;
    </script>

</head>
<body>

<!--header-->
<div class="header">
        <p style="color: lightgray">Welcome to PerferctHouz</p>
		<?php 
		if(isset($_SESSION['username'])){
			
			echo '	
			<p id="username" style="color: lightgray">'.$_SESSION['username'].'</p>
			<p id="signup" style="color: lightgray"><a href="../php/p_logout.php"> logout</a></p>
			 <p id="homepage" style="color: lightgray"><a href="../Homepage/Homepage.php">Homepage</a></p>
			';
			
		}else{
			echo '<p id="login" style="color: lightgray"><a href="../Login/Login.php">Log in</a></p>
        <p id="separation1" style="color: lightgray">|</p>
        <p id="signup" style="color: lightgray"><a href="../Login/Signin.php">Sign up</a></p>
        <p id="separation2" style="color: lightgray">|</p>
        <p id="homepage" style="color: lightgray"><a href="../Homepage/Homepage.php">Homepage</a></p>';
		}
		
		?>
</div>

<div class="allelement">

    <div id="brief">
        <div id="info"><h2 id="name" style="line-height: 50px">...</h2>
        <p id="location" style="font-size: 80%">
            <svg class="bi bi-geo-alt" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 002 6c0 4.314 6 10 6 10zm0-7a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
            </svg>
            ...</p>
        </div>

        <div id="images">

<!--            滚动图片-->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>

<!--                        此处传入图片-->
                        <div id="imgbox" class="carousel-inner" style="width: 100%;height: 100%">
                            <div class="carousel-item active">
                                <img id="image1" src="../House_img/AC/AC.jpg" class="imagesize" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img id="image2" src="../House_img/AC/Albert%20Court.png" class="imagesize" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img id="image3" src="123.jpg" class="imagesize" alt="...">
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
        </div>
    </div>

<!--    float information-->
    <div id="floatArea">
    <div id="floatInfo" class="float-right">

        <div id="price" style="color: #ff4f5a"><a>From ￡<span id="rent" style="font-size:150%;font-weight: bold;color: #ff4f5a">...</span>/week</a></div>

        <div id="property">
<!--            <span class="badge badge-primary" style="font-size: 140%">Shops</span>-->
<!--            <span class="badge badge-secondary" style="font-size: 140%">Restaurants</span>-->
<!--            <span class="badge badge-success" style="font-size: 140%">Gym</span>-->
<!--            <span class="badge badge-danger" style="font-size: 140%">close to university</span>-->
<!--            <span class="badge badge-warning" style="font-size: 140%">studio</span>-->
<!--            <span class="badge badge-info" style="font-size: 140%">1-4 en-suite</span>-->
<!--            <span class="badge badge-light" style="font-size: 140%">4-8 en-suite</span>-->
        </div>

		<?php 
			if(isset($_SESSION['username'])){
				echo ' <div class="buttonArea" style="vertical-align: middle">
						<button type="button"  class="btn btn-primary" id = "addFavourite">Add to favourite</button>
						</div>';
			}
		?>
     <!--   <div class="buttonArea" style="vertical-align: middle">
            <button type="button"  class="btn btn-primary" id = "addFavourite">Add to favourite</button>
        </div>
 -->
    </div>
</div>

<!--    navigation button-->
    <div id="navigation">
        <br>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color: #23272b"><h6>Comments</h6></a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: #23272b"><h6>Location</h6></a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false" style="color: #23272b"><h6>Booking</h6></a>
            </div>
        </nav>


        <div class="tab-content" id="nav-tabContent">

<!--            Comment area-->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
<!--                Comment input text+button-->
                <div class="inputCommentArea">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Commenting publicly below:</label>
<!--                   readonly 文本框禁用-->
				<?php 
					if(isset($_SESSION['username'])){
						echo ' <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>';
					}else{
						echo '<textarea readonly="readonly" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>';
					}
				?>
                </div>
                    <button type="button" id="commentButton" class="btn btn-primary">COMMENT</button>
                </div>


                <br>

<!--                comment show username +img +specific content-->
            <div id="commentbox">
<!--                <div class="commentarea" style="border-bottom: darkgray solid 1px">-->
<!--                    <div class="bubbleimg">-->
<!--                        <img src="123.jpg" style="height:20px;width: 17px">-->
<!--                    </div>-->
<!--                    <div class="username">Yuhe</div>-->
<!--                    <div class="commentcontent">quite good, nice environment,surrounding, convenient surrounding.quite good, nice environment, convenient surrounding.</div>-->
<!--                </div>-->
            </div>
            </div>

<!--            location area-->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div id="map"></div>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcKUmBwQbg4ia6BPFVPKbYkUyMwLTL2CM&callback=initMap"></script>
            </div>

            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <a id="link" href="...">...</a>
            </div>

        </div>

    </div>
</div>

</body>
</html>