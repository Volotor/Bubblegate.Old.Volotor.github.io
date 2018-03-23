<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
	<head><!--Links to the external Javascript and Css pages -->
		<link rel="stylesheet" href="Css.css">
		<!--script src="JavScrpt.js"></script-->
		<title>iBar</title>





	</head>
	<body>

		<script>
			//ajax implementation
			var ajbutt = new XMLHttpRequest(); //ajbutt = ajax button
			ajbutt.onreadystatechange = function() { //when the ajax changes
				if(ajbutt.readyState == 4){ //readystate 4 is "request finished and responce is ready", so if the ajax is ready
					document.getElementById('ajax').innerHTML=ajbutt.responseText; //print out in the ajax area, the functions below determain this
				}
			};


			//functions for displaying
			function loadTable(){
				ajbutt.open('GET', 'loadTable.php') //will GET loadTable.php to be loaded in the ajax area
				ajbutt.send();

			}

			function adminMenu(){
				ajbutt.open('GET', 'admin.php')
				ajbutt.send();

			}
			function makeBarcode(){
				ajbutt.open('GET', 'barcoder.php')
				ajbutt.send();
			}





			function getSuggestion(product) {
			    if (product.length == 0) {  //ensure something is entered
			        document.getElementById("suggest").innerHTML = "";
			        return;
			    } else {
			        var xmlhttp = new XMLHttpRequest(); //same as ajax above but is self contained as it has a diffrent location
			        xmlhttp.onreadystatechange = function() {
			            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { //xmlhttp.status == 200 means that its "ok", other errors could be 404 for not found.
			                document.getElementById("suggest").innerHTML = xmlhttp.responseText; //load to suggest area
			            }
			        };
			        xmlhttp.open("GET", "getSuggestion.php?q=" + product, true); //load the getSuggestion and the inputted data that was passed through
			        xmlhttp.send();
			    }
			  }





		</script>

		<div id="container"> <!--Container div contains the header,breakbar and parchment divs to ensure formating is inline-->
			<div id="header">

					<img src="images/banner.png"> <!--iBar Banner Image -->
				<form action="search.php" method="GET">

					<p>Search:<input type="text" name="search">

					  <select name="flag">
					    <option value="PRODUCT">Product</option>
					    <option value="CODE">Code</option>

					  </select>
					<input type="submit" value="Search"/></p>

				</form>
			</div>
		<div id="parchment"><!--main text wall is here -->

				<h1>Welcome to iBar</h1>

			<div>
				<form  method="GET">
				<p>Enter Barcode Number:</p> <input type="text" name="barcode" onkeyup="getSuggestion(this.value)">  <!--onkeyup is when the user enters a keypress, so on keypress pass the entered value to the getsuggestion function-->
				<input type="submit" value="Generate Barcode" onclick="makeBarcode()" />
				</form>
				<p> Suggestions: <span id="suggest"></span></p>
			</div>

			<div id="ReadOut">
</div>
			<button id="load" onclick="loadTable()"> Load Database </button>
			<a href="admin.php"><button id="loader"> Admin Menu </button></button><a> <!--Using a ling around the button to give the appearence that the button sends you to a page-->
			<a href="editData.php"> <button id="loadering" onclick="editData.php"> Edit Database </button><a>
			<a href="gallery.php?page=1"><button> Show Barcodes </button><a>
			<div id="ajax">
			<?php
				include 'barcoder.php'; //includes the barcoder.


			?>
			</div>






<!--



				<p>Product Code: <input type="text" value=""></p>


				</br></br>
				<input type="submit" name="Generate" value="Generate Barcode" onclick="makeBarcode()">

				-->


        </div>
	</body>

</html>
