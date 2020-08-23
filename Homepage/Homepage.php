<?php 
session_start();
include_once "../php/p_Config.php";
include_once "../php/p_loadBrief.php";
if(isset($_SESSION['username'])){
	include_once "../php/p_loadUser.php";
}
include_once "../php/p_loadRecommand.php";
include_once "../php/p_all.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=0.8" />
    <title>Homepage</title>
    <script src="../jquery-3.4.1.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="../bootstrapFile/bootstrap.min.js"></script>
    <script src="filterConte.js"></script>
    <script>
        var filterConditon = eval(<?php echo $filter;?>);
        window.filterConditon = filterConditon;
    </script>
    <script src="loadSearch.js"></script>
    <script></script>
    <script src="../Homepage/loadBrief.js"></script>
    <script>
		var allBoxApartment =eval(<?php echo $apartmentJson;?>);
		var apartmentInfo = allBoxApartment;
        window.apartmentInfo = apartmentInfo;
    </script>
    <script src="loadUser.js"></script>
    <script>
		var userInfo = eval(<?php if(isset($_SESSION['username'])){echo $userJson;}?>);
		window.userInfo = userInfo;
    </script>
    <script src="loadPublish.js"></script>
    <script src="loadRecomand.js"></script>
    <script>
	var recommandation = eval(<?php echo $recommandJson;?>);
    window.recommandation = recommandation;
	var checkUser = <?php
	if(isset($_SESSION['username'])){
		echo 1;
	}else{
		echo 0;
	}
	?>;
	window.checkUser=checkUser;
	// console.log(checkUser);
    </script>
    <link type="text/css" rel="stylesheet" href="../bootstrapFile/bootstrap.min.css">
    <link href="HpStyle.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="list">
        <div class="Login">
           <?php
           	if(isset($_SESSION['username'])){
           		try{
           				$pdo = new PDO($dsn,$db_username,$db_password,$opt);
           				$searchUserStmt = $pdo -> prepare("select * from member where username = :username and password = :password");
           				$searchUserStmt->execute(array(
           					':username' => $_SESSION['username'],
           					':password' => $_SESSION['password']
           				));
           				$row = $searchUserStmt ->rowCount();
           				if($row == 1){
           							echo '<div style = "color:grey;">Welcome  '.$_SESSION['username'].'</div>';
           					echo '<a href="../php/p_logout.php">logout</a>';
           				}else{
           					echo '<a href="../Login/Login.php">
           							<button type="button" id="LogButton" class="btn btn-outline-secondary">
           							<img id="logpic" src="Homepage_img/unknown.png">Log in/Register
           							</button>
           							</a>';
           				}
           			
           			}catch(PDOException $e){
           			echo "PDO Error:",$e -> getMessage(),"<br>\n";
           		}
           	}else{
           		echo '<a href="../Login/Login.php">
           				<button type="button" id="LogButton" class="btn btn-outline-secondary">
           				<img id="logpic" src="Homepage_img/unknown.png">Log in/Register
           				</button>
           				</a>';
           	}
           ?>
        </div>

        <ul class="menu">
            <li><a href="">Home</a></li>
            <li><a id="showUser">User Profile</a></li>
<!--            新加-->
            <li><a id="showPublish">Publish</a></li>
            <li><a id="showRec">Recommend</a></li>

        </ul>

    </div>

    <div class="filter">
        <ul>
            <li><a id="showFilter">Filter</a></li>
        </ul>
        <div class="filterConte" id="filterConteid">
            <div class="container scroll">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h7 class="card-subtitle mb-2 text-muted">Room Type<br/></h7>
                        <input type="checkbox" style="font-size: 60%" onchange="addPrior(event)" value="classicStudio">Classic Studio<br/>
                        <input type="checkbox" style="font-size: 60%" onchange="addPrior(event)" value="premiumStudio">Premium Studio<br/>
                        <input type="checkbox" style="font-size: 60%" onchange="addPrior(event)" value="threeToFiveEnsuite">3-5 ensuite<br/>
                        <input type="checkbox" style="font-size: 60%" onchange="addPrior(event)" value="sixToEightEnsuite">6-8 ensuite
                    </div>
                </div>
                <br/>
                <div class="card" style="width: 100%;" id="oneCheck">
                    <div class="card-body">
                        <h7 class="card-subtitle mb-2 text-muted">Price<br/></h7>
                        <input type="checkbox" onchange="addPrice(event)" value="level1" name="onecheck"> below 100/week<br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level2" name="onecheck"> 100-119/week <br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level3" name="onecheck"> 120-139/week <br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level4" name="onecheck"> 140-159/week <br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level5" name="onecheck"> 160-179/week <br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level6" name="onecheck"> 180-200/week <br/>
                        <input type="checkbox" onchange="addPrice(event)" value="level7" name="onecheck"> above 200/week
                    </div>
                </div>
                <br/>

                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h7 class="card-subtitle mb-2 text-muted">Surrounding<br/></h7>
                        <input type="checkbox" onchange="addPrior(event)" value="Restaurant" > Restaurant<br/>
                        <input type="checkbox" onchange="addPrior(event)" value="Shop" > Shop<br/>
                        <input type="checkbox" onchange="addPrior(event)" value="Hospital" > Hospital<br/>
                        <input type="checkbox" onchange="addPrior(event)" value="BusStop"> Bus stop<br/>
                        <input type="checkbox" onchange="addPrior(event)" value="Gym"> Gym<br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--新加z-index-->
<!-- <form method="post" action="../php/p_search.php"> -->
    <div class="SearchArea" style="z-index: 999">
        <div class="container">
            <div class="input-group mb-3" id="searchBar">
                <input type="text" name = "searchApt"  class="form-control" placeholder="Search" id="searchText" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
        </div>
    </div>
<!-- </form> -->
    <div class="brief" id="brief">

        <div id="permission">
            <p style="margin-left:35%;font-size: 150%"><a href="../Login/Login.php">You haven't logged in. Click here to log in.</a></p>
        </div>

     <div id="userInfo">
            <div id="infoContainer">
                <br><br><br>
                <div id="userimg">
                    <img src="Homepage_img/unknown.png" style="height: 100px;width: 100px">
                </div>
                <br>
                <div><h3 id="username">...</h3></div><br>
                <div id="navigation">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="width: 300px">Your Comments</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="width: 300px">Favourite List</a>
                    </div>
                </nav>
                    <br>
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="commentbox">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div id="listbox">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div id="briefContent">
        <div id="allboxes">


        </div>
        </div>

			<div id="publish">
			    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcKUmBwQbg4ia6BPFVPKbYkUyMwLTL2CM&callback=initMap"></script>
			    <br>
			    <div><h2>Publish your apartment</h2></div>
			    <div id="form">
			    <form method="post" action = "../php/p_publish.php">
			        <div class="form-group">
			            <label>Apartment name</label>
			            <input  class="form-control" name = "pName">
			        </div>
			        <div class="form-group">
			            <label>Website/E-mail</label>
			            <input  class="form-control" name = "website">
			        </div>
			        <div class="form-row">
			        <div class="form-group col-md-10">
			            <label for="inputAddress">Address</label>
			            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name = "address">
			        </div>
			            <div class="form-group col-md-2">
			                <label for="inputZip">Postcode</label>
			                <input type="text" class="form-control" id="inputZip" name = "postcode" onchange="getLatLngByZipcode(event)">
			            </div>
			        </div>
			        <div id="roomtype">
			        <div  class="form-row">
			            <div class="form-group col-md-4">
			                <label >Room Type</label>
			                <button id="addButton" type="button" style="height: 30px">Add</button>
			                <select  class="form-control" name = "roomType[]">
			                    <option selected>Choose...</option>
			                    <option>3-5En-suite</option>
			                    <option>6-8En-suite</option>
			                    <option>ClassicStudio</option>
			                    <option>PremiumStudio</option>
			                </select>
			            </div>
			            <div class="form-group col-md-2">
			                <label for="inputZip">Price</label>
			                <input type="text" class="form-control" name = "price[]">
			            </div>
			        </div>
			        </div>
			        <label>Surrounding</label>
			        <div id="surroundArea">
			        <div class="form-row">
			            <div class="form-check">
			                <input class="form-check-input" type="checkbox" name = "surrounding[resturant]">
			                <label class="form-check-label">
			                    Resturant
			                </label>
			            </div>
			            <div class="form-check">
			                <input class="form-check-input" type="checkbox" name = "surrounding[shop]">
			                <label class="form-check-label">
			                    Shop
			                </label>
			            </div>
			            <div class="form-check">
			                <input class="form-check-input" type="checkbox" name = "surrounding[hospital]">
			                <label class="form-check-label">
			                    Hospital
			                </label>
			            </div>
			        </div>
			        <div class="form-row">
			            <div class="form-check">
			                <input class="form-check-input" type="checkbox" name = "surrounding[busStop]">
			                <label class="form-check-label">
			                    Bus stop
			                </label>
			            </div>
			            <div class="form-check">
			                <input class="form-check-input" type="checkbox" name = "surrounding[gym]">
			                <label class="form-check-label">
			                    Gym
			                </label>
			            </div>
			        </div>
			        </div>
			        <br>
			       <label>Upload apartment images:</label>
			        <div id="imagebox">
			            <div class="uploadimg">
			                <div class="imgspace" id="dropBox"></div>
			                <input type="file" accept="imgage/*" id="img1" style="margin: 5px 30px">
			            </div>
			            <div class="uploadimg">
			                <div class="imgspace" id="dropBox2"></div>
			                <input type="file" accept="imgage/*" id="img2" style="margin: 5px 30px">
			            </div>
			            <div class="uploadimg">
			                <div class="imgspace" id="dropBox3"></div>
			                <input type="file" accept="imgage/*" id="img3" style="margin: 5px 30px">
			            </div>
			        </div>
			        <div id="description">
			            <label>Apartment Description:</label>
			            <div id="descriptionArea">
			                <div class="form-group">
			                    <input class="form-control" id="exampleFormControlTextarea1" rows="3" name = "description"></input>
			                </div>
			            </div>
			        </div>
			        <button type="submit" class="btn btn-primary" style="display: block;margin: 0 auto">Submit</button>
			    </form>
			    </div>
			</div>
        <div id="recommendation">
            <div id="recommandContain">
                <br>

                <div id="mostPopular"><h2>Most Popular:</h2>

                    <div class="popular">
                    <h3 >1st:</h3>
                    <div class="card" style="width: 18rem">
                    <div class="imgbox">
                        <img id="popularimg1" style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 id="popularname1" class="card-title">Liberty Prospect Point</h5>
                        <a  class="btn btn-primary" id ="p1">More information</a>
                    </div>
                    </div>
                    </div>

                    <div class="popular">
                    <h3>2nd:</h3>
                    <div class="card" style="width: 18rem">
                        <div class="imgbox">
                            <img id="popularimg2"  style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 id="popularname2" class="card-title">Liberty Prospect Point</h5>
                            <a  class="btn btn-primary" id = "p2">More information</a>
                        </div>
                    </div>
                    </div>

                    <div class="popular">
                    <h3>3rd:</h3>
                    <div class="card" style="width: 18rem">
                        <div class="imgbox">
                            <img id="popularimg3" style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 id="popularname3" class="card-title">Liberty Prospect Point</h5>
                            <a  class="btn btn-primary" id = "p3">More information</a>
                        </div>
                    </div>
                    </div>
                </div>


                <div id="newest"><h2>Newest:</h2>

                    <div class="popular">
                        <h3>1st:</h3>
                        <div class="card" style="width: 18rem">
                            <div class="imgbox">
                                <img id="newimg1" style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 id="newname1" class="card-title">Liberty Prospect Point</h5>
                                <a  class="btn btn-primary" id = "n1">More information</a>
                            </div>
                        </div>
                    </div>

                    <div class="popular">
                        <h3>2nd:</h3>
                        <div class="card" style="width: 18rem">
                            <div class="imgbox">
                                <img id="newimg2" style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 id="newname2" class="card-title">Liberty Prospect Point</h5>
                                <a  class="btn btn-primary" id = "n2">More information</a>
                            </div>
                        </div>
                    </div>

                    <div class="popular">
                        <h3>3rd:</h3>
                        <div class="card" style="width: 18rem">
                            <div class="imgbox">
                                <img id="newimg3" style="width: 18rem;height: 170px" src="../House_img/LPP/LPP.jpg" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 id="newname3" class="card-title">Liberty Prospect Point</h5>
                                <a  class="btn btn-primary" id = "n3">More information</a>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>

    </div>



</body>

</html>