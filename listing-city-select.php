<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Listing city select page For Homes For Gnomes
Date:         	28 September 2018
*/

require "header.php";
?>
  <!-- start of main page content -->
<div class="container" style="height:100vh">
    <div class="row" style="margin-top:75px">
        <?php //echo $_SESSION['RedirectError']; ?>
  <!-- Image Map Generated by http://www.image-map.net/ -->
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h2>Please select the city you wish to see listings for:</h2>
            <img src="./images/map1.png" usemap="#image-map" style="margin-left:auto; margin-right:auto; display: block;">

            <map name="image-map">
                <area target="" alt="NewCastle" title="NewCastle" href="listing-search.php?city=16" coords="435,456,498,439,523,544,465,540,453,498" shape="poly">
                <area target="" alt="BowmanVille" title="BowmanVille" href="listing-search.php?city=2" coords="365,478,424,461,454,549,390,575" shape="poly">
                <area target="" alt="Oshawa" title="Oshawa" href="listing-search.php?city=8" coords="239,517,318,495,332,578,257,594" shape="poly">
                <area target="" alt="Whitby" title="Whitby" href="listing-search.php?city=128" coords="181,504,228,490,244,589,206,609" shape="poly">
                <area target="" alt="Ajax" title="Ajax" href="listing-search.php?city=1" coords="130,535,178,522,201,611,159,626" shape="poly">
                <area target="" alt="Pickering" title="Pickering" href="listing-search.php?city=32" coords="59,557,121,539,143,629,81,634" shape="poly">
                <area target="" alt="Uxbridge" title="Uxbridge" href="listing-search.php?city=256" coords="27,266,142,344" shape="rect">
                <area target="" alt="Port Perry" title="Port Perry" href="listing-search.php?city=64" coords="226,311,179,323,208,382,269,382,299,349,249,360" shape="poly">
                <area target="" alt="Beaverton" title="Beaverton" href="listing-search.php?city=4" coords="76,0,66,17,68,48,56,65,53,82,43,94,34,100,24,100,2,86,0,139,174,69,151,0" shape="poly">
            </map>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>



  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
