<?php require_once("includes/functions.php");?>
<?php require_once("includes/db.php");?>
<?php require_once("includes/sessions.php"); ?>
<?php
$_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];

  mconfirm_login();

 ?>

<!-- //////////////////////////////////////////////////////////////////////////////// -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Styles.css">
  <title>Document</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
      <!--ABOVE DIV WILL GET """"BLUE STRIP"""" ABOVE header -->
      <!--to color navbar button add navbar-dark as below   -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container ml-5">
      <a href="#" class="navbar-brand">    FPO.com   </a>

      <!--this below button will get all the items into its div with the help of class and ""ID"" which must not be missed -->
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <!--SPAM THE ICON class TO GET THE BUTTON   -->
        <span class="navbar-toggler-icon"></span>
      </button>

      <!---->
      <!---->
      <!---->
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="formembers.php?page=<?php echo "0"; ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="aboutus.php" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="features.php" class="nav-link">Features</a>
        </li>
        <li class="nav-item">
          <a href="members.php" class="nav-link">Members</a>
        </li>
        <li class="nav-item">
          <a href="requests.php" class="nav-link">Requests</a>
        </li>

      <ul class="navbar-nav ml-5">
        <form class="form-inline d-none d-sm-block" action="formembers.php">
          <div class="form-group">
            <input class="form-control mr-1" type="text" name="search" value="" placeholder="search here">
            <button class="btn btn-primary" name="searchbutton">go</button>

          </div>
        </form>
      </ul>

      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="mLogout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i>
           Logout
         </a>
       </li>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- ========================================================================================================================================== -->



<?php
// $searchqueryparameter=$_GET["id"];

  if (isset($_POST["Submit"])) {
  $rname=$_POST["name"];
  $rtitle=$_POST["title"];
  $rcomment=$_POST["requestinfo"];
  date_default_timezone_set("Asia/Kolkata");
  $currenttime=time();//to get date we must get the time
  $currentdate=strftime("%B-%d-%Y %H-%M-%S",$currenttime);//this will take 2 Arguments 1-DATE FORMATE and 2-Current time variable

  if (empty($rname)||empty($rtitle)||empty($rcomment)) {
    //code For all the validation of categoryTitle
    $_SESSION["Errormsg"]="to send Request all fields must be filled out";
    redirect_to("requests.php?id={$searchquaryparameter}");
  }elseif (strlen($rcomment)>500) {
    $_SESSION["Errormsg"]="comment cahracters should be less than 500 caharacters";
    redirect_to("requests.php?id={$searchquaryparameter}");
  }else {
    //query to add COMMENT into the database TABLE::::::::::::::::::::::::
    global $connectingdb;
    $sql = "INSERT INTO requests(title,name,rstatus,datetime,info)";
    //PDO method used
    $sql.="VALUES(:title,:Name,'Pending',:datetime,:info)";
    //Dummy values used to make it SQL injection free
    $stmt =$connectingdb->prepare($sql);
    $stmt->bindValue(':title',$rtitle);//$stmt var will be considered as an OBJECT bcause of the arrow
    $stmt->bindValue(':Name',$rname);
    $stmt->bindValue(':datetime',$currentdate);
    $stmt->bindValue(':info',$rcomment);
  //  $stmt->bindValue(':rstatus',$searchquaryparameter);
    //now take var and aboject and call the PDO method of Object
    $Execute=$stmt->execute();
    if ($Execute) {
      $_SESSION["Successmsg"]="comment submitted successfully";
      redirect_to("requests.php?id={$searchquaryparameter}");
    }else {
      $_SESSION["Errormsg"]="comments not added !! something went wrong WRONG ";
      redirect_to("requests.php?id={$searchquaryparameter}");
    }
  }
}



 ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->

<div class="offset-1 col-lg-10 mt-5">
  <?php
  echo Errormsg();//php scope of the function
  echo Successmsg();
   ?>

    <!-- <form class="" action="aboutus.php?id=<?php echo $searchqueryparameter ?>" method="post"> -->
        <div class="">
          <h4 class="Fieldinfo">Farmer Producer Organizations and the Future of Agriculture Marketing Imperatives for inclusive economic <br><br>
             growth Small Farmers’ Agribusiness Consortium.</h5>
             <hr>
        </div>
        <div class="">
          <h5>
1. Farmer Producer Organizations and the Future of Agriculture Marketing Imperatives for inclusive economic growth Small Farmers’ Agribusiness Consortium (Dept. of Agriculture and Cooperation) Govt. of India लघु कृषक कृषि व्यापार संघ भारत सरकार, कृषि मंत्रालय
<br><br>
2. How FPOs benefit small producers
Aggregating smallholders into FPOs proven pathway to increase investment, improve bargaining power, move up value chains and improve access to technology, markets. Aggregation only way to enable SMF to exploit emerging opportunities domestic and global by integrating with SMEs; retail chains Climate change coping mechanisms and risk mitigation requires aggregated platforms for efficient delivery Aggregation will facilitate more effective targeting of subsidies to farmers
<br><br>
3. SFAC FPO network structure
Marketing linkage/inputs/credit S F A C Village level (Crop planning, seed production, demonstration, knowledge sharing, aggregation) Cluster level (10-12 villages) (Credit, inputs, technology, capacity building, marketing linkages) State level (Policy advocacy, explore wider markets, strategic partnerships) Federation of KPCs ( farmers) KPC (1000 farmers/ 50 FIGs in each) FIG (15-20 farmers in each group) Kisan Producer Co/Coop
<br><br>
4. Training and Networking
Farmer Producer Organizations (FPOs) Typical range of services provided FPO (Seed, fertilizer, machinery) Input supply (Credit, savings, insurance, extension) Financial & technical (contract farming, procurement under MSP) Marketing linkages (HRD, policy advocacy, documentation) Training and Networking
<br><br>
5. Promotion of Farmer Producer Organizations by SFAC S.No Name of State
Achievement Farmers mobilized/under mobilization No. of FIGs FPO Registered FPO registration under process 1 Arunachal Pradesh 1750 94 2 Andhra Pradesh 34395 837 10 20 3 Bihar 28606 526 7 22 4 Chhattisgarh 26063 412 5 21 Delhi 3535 196 6 Goa 1810 116 Gujarat 30461 536 25 8 Haryana 7048 362 9 Himachal Pradesh 3850 226 Jammu 3000 170 11 Srinagar 117 12 Jharkhand 10107 628 13 Karnataka 36828 864 23 14 Madhya Pradesh 118410 5585 34 89 15 Maharashtra 72917 2952 33 35 16 Manipur 4750 260 17 Meghalaya 3750 258 18 Mizoram 700 19 Nagaland 139 Odisha 38523 1006 Punjab 6005 343 Rajasthan 56215 2061 27 Sikkim 1876 159 24 Tamil Nadu 21000 50 Tripura 127 26 Uttarakhand 6004 359 Uttar Pradesh 39697 1034 28 West Bengal 58322 3582 TOTAL 622122 23034 200 420
<br><br>
6. Integrated development of 60,000 Pulses Village in Rainfed areas – an Overview
Name of State No. of Farmers mobilized No. of FPOs formed Andhra Pradesh 14395 10 Gujarat 7350 6 Karnataka 16828 14 Madhya Pradesh 229403 29 Maharashtra 27187 23 Rajasthan 22092 15 Uttar Pradesh 19697 Total 136952 108 Name of State No. of FIGs with Bank Account No. of Demo. in Kharif Season Andhra Pradesh 316 350 Gujarat 22 150 Karnataka 304 384 Madhya Pradesh 985 1185 Maharashtra 595 2565 Rajasthan 227 433 Uttar Pradesh 26 500 Total 2475 5567
<br><br>
7. Major activities carried out so far
4626 Audio / Visual Shows organized for participants Red gram Transplanting method and techniques to be followed while transplanting LRP and BDS capacity building programme on the pre monsoon session on red gram with INM and IPM techniques 3234Orientation Trainings conducted covering members INM and IPM Training programme has been conducted on demonstration sites Red gram cultivation Krishidoot - Mobile base Advisory Services 186 Exposure visits for 9286 farmers KVK demonstration plots Seed processing unit ARS Bidar Demonstration plots Benefit of collectivization Mini Dal mill Vermicompost unit and dairy units of Gudur village of Gulbarga Taluk and Sedam taluk Farmers pulse industries, Bidar 7108 Trainings conducted to enhance the capacity of members Detailing on package and practices for Pulse production like line sowing, land preparation, seed treatment, seed rate. Plant Protection Improved agriculture practices for Rabi 7256 Kisan Sabha/Goshties held at village/block levels with a total participation of members Pest and diseases control, Good agricultural practices followed Demonstration on Seed treatment FPO Formation Intercrops in Red gram and crop diversity 1240 Workshops conducted for imparting knowledge on various topics to 3824 participants Hand holding support for FIG, FPO formation and legal aspects to be followed by Basic Live hood school at Gulbarga Soil Testing Ideal demonstration plot
<br><br>
8. Details of Pulse Demonstration Plots Conducted in Kharif-2012
S.No State No of FIG Covered Crop Area (In Acre) No of Demo's Conducted 1 Andhra Pradesh 406 Red Gram, Bengal Gram, Green Gram major crop with Redgram as inter crop, Blackgram major crop with Redgram as inter crop 661 2 Gujarat 135 Black Gram, Tur (Pigeon peas ), Mung, Math, Chana, Urad, Tur 142 131 3 Karnataka 395 Green Gram, Soyabeen, Red Gram, Composting, Green manuring, Vermi Composting, Red gram-Dibbling Method, Red Gram-Transplanting, Seed Treatment, Bengal Gram 442 4 Madhya Pradesh 933 Urad, Arhar, Moong, Pigeon pea, Black gram,Pigeon pea + Soybean 1349 5 Maharashtra 1255 Black Gram, Red Gram, Bengal Gram, Peagion Pea + Green Gram, Vermicompost, Tur, MoongTur, Udid, Soil Testing to Harvesting, Compost Demonstration, Soil 1384 1240 6 Rajasthan 480 Green Gram, Black Gram, Moong, Moong (Dinkar), Moong (Green Gram), Urad (Black Gram) 479 7 Uttar Pradesh 534 Arhar,Urad,Moong 1320 Total 4138 5775 3585
<br><br>
9. & Value Chain development of pulses and millets under NFSM
National Demonstration Project for promotion of FPOs & Value Chain development of pulses and millets under NFSM Duration: to Sl. No. Name of State Targeted No. of Farmers Target No. of FPOs 1 Andhra Pradesh 10000 10 2 Uttar Pradesh 3 Karnataka 4 Madhya Pradesh 6000 6 5 Gujarat Chhattisgarh 7 Bihar 8 Maharashtra 9 Odisha Rajasthan 11 Tamil Nadu Total 106000 106 SFAC has already issued work order to the Resource Institutions in all States for FPO Promotion
<br><br>
10. Cumulative purchase value
SFAC PROCUREMENT OF PULSES & OILSEEDS AT MINIMUM SUPPORT PRICE RABI State Commodity No. of FPOs No. of Farmers Cumulative purchase (MT) Cumulative purchase value (Rs. in Crore) Andhra Pradesh Groundnut 5 111 164 0.65 Tur 590 796 3.42 Chana 3 0.02 Sub Total  704 965 4.09 Gujarat 3854 14516 58.07 Karnataka Sunflower Seed 4 203 516 1.91 78 184 0.57 281 700 2.38 Maharashtra Black Gram 26 1726 3830 11.87 2975 4939 21.24 4704 8774 33.13 Grand Total 40 9543 24955 97.67
<br><br>
11. FIG Meeting at Village level Cluster level meeting of FIG leaders
FIG Development & Capacity Building in Gujarat FIG Meeting at Village level Cluster level meeting of FIG leaders
<br><br>
12. Increasing Income Through Value Addition Name of FPO: (Akola Soy and Cotton producer Company Ltd, West Vidarbha Maharashtra) Grading of Tur Dal (Double Roller Dal Mill) Collective procurement of fertilizer
<br><br>
13. FPOs make business sense
FPO Input Shop FPO Name: Kedar Nath Kisan Agro Producer Co. Ltd, Rajasthan
<br><br>
14. Inputs Supply Facilitation in Gujarat
Seed Procurement Fertilizer Demonstration
<br><br>
15. Value Addition Activities undertaken for value addition in Mahrashtra FPO: Grading of Red Gram in Maharashtra Processing of tur (leveraging the existing interventions.) Setting up of Mini Dal mill
<br><br>
16. Setting up Of Mini Dal Mill in Maharashtra and Karnataka
Capacity - 40 Qtl per day Plans to buy low cost gravity separator for grading
<br><br>
17. Agribusiness Centre, Halbarga, Karnataka
FPO - Jai Kissan Souharda MultiPurpose Cooperative Location- Halbarga, Bhalki, Bidar Warehouse Mini Dall Mill Input Store FPO Office - Plan to have similar Agribusiness Centres for all the 5 Locations
<br><br>
18. Input Licences of “Jai Kissan Souharda MultiPurpose Cooperative”
Fertilizer & Pesticide License Seed License
<br><br>
19. Farm Mechanization Centre
This center is Likely to get support under “Custom Hiring Centre” from Department of Agriculture, Bidar, Karnataka Tractor Tanker Trolley Plough Cultivator Hand Weeder
<br><br>
20. FPOs in the XII Plan XII Plan document endorses FPO mobilization
Policy framework to promote FPOs under RKVY 2014: Year of Farmer Producer Organizations 2014: UN Year of Family Farming Equity Grant and Credit Guarantee Fund Scheme for Farmer Producer Companies
<br><br>
21. Thank You
<br><br><hr>
          </h5>
        </div>


  </div>

<!-- ==================================================================================== -->
</div>
</div>
<?php require_once 'footer.php'; ?>
