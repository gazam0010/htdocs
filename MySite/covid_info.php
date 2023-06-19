<?php include('server.php') ?>
<?php $_SESSION['page']='covid'; ?>
<?php if(isset($_SESSION["14c4b06b824ec593239362517f538b29_username"])
          || isset($_SESSION['b80bb7740288fda1f201890375a60c8f_id'])
          || isset($_SESSION['a3da707b651c79ecc39a4986516180b2_fname']) 
          || isset($_SESSION['0c83f57c786a0b4a39efab23731c7ebc_email']) 
          || isset($_SESSION['532c28d5412dd75bf975fb951c740a30_mobile']))
          {
            header("location: after/covid_info_after.php");
            exit();
          }
?>
<?php if(isset($_SESSION['signup-success']))
{
    $signup_succ = $_SESSION['signup-success'];
}
?>
<?php
  unset($_SESSION['after_mobile_verification']);
  unset ($_SESSION['expT']);
   unset ($_SESSION['mobile']);
   unset ($_SESSION['otp']);
?>
<?php if (isset($_GET['falseLogin'])) : ?> 
 <html>
    <script>
        window.onload=function(){
        document.getElementById("myBtn").click();
        };
    </script>
  </html>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>C-19 Info. System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  .main-cont-serv {
    margin-left: 10%;
    margin-right: 10%;
    padding: 2%;
   }
</style>
</head>
<?php
include ("basestyle.html");
?>
</head>
<body>
      <!----------------Write header---------------->
<div class="header">
  <h2>COVID 19</h2>
  <h3> <font size="6">Information System</font></h3>
</div> 
<!-----------------Write header end------------->
   
<!------------Nav bar code------------->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
        <li ><a href="start.php"><font size = "4.5">Home</font></a></li>
      <li ><a href="donate.php"><font size = "4.5">Donate</font></a></li>
      <li ><a href="services.php"><font size = "4.5">Services</font></a></li>
      <li class="active"><a href="#"><font size = "4.5">About Corona Virus</font></a></li>
      <li ><a href="contact_us.php"><font size = "4.5">Contact Us</font></a></li>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id="mysBtn"><a href="#"><font size = "4.5"><span class="glyphicon glyphicon-user"></span> Sign Up</a></font></li>
      <li id="myBtn"><a href="#"><font size = "4.5"><span class="glyphicon glyphicon-log-in"></span> Login</a></font></li>
    </ul>
  </div>
</nav>
<!--------------Nav bar code ends---------->

<?php
include ("login-signup.php");
?>

<!--------------------------------------------------------------- PAGE BODY STARTS ------------------------------------------------------------>

<div class="w3-container">

<?php if (isset($_SESSION['signup-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
<?php 
    echo $_SESSION['signup-success']; 
    unset($_SESSION['signup-success']);
?>
    
</div>
</div>
    <?php endif ?>

<br><br>
<div class="main-cont-serv w3-card">
<h3 align="center"><font color="black"><strong>Corona Virus Disease (COVID 19)</strong></font></h3>
<br>
<div style="font-size: 20px; line-height:1.6; text-align: justify; text-justify: inter-word;">
Coronavirus disease 2019 (COVID-19) is a contagious disease caused by severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2). 
The first case was identified in Wuhan, China, in December 2019. The disease has since spread worldwide, leading to an ongoing pandemic.

Symptoms of COVID-19 are variable, but often include fever, cough, fatigue, breathing difficulties, and loss of smell and taste. 
Symptoms begin one to fourteen days after exposure to the virus. Of those people who develop noticeable symptoms, most (81%) develop mild to moderate symptoms (up to mild pneumonia), while 14% develop severe symptoms (dyspnea, hypoxia, or more than 50% lung involvement on imaging), and 5% suffer critical symptoms (respiratory failure, shock, or multiorgan dysfunction). 
Older people are more likely to have severe symptoms. 
At least a third of the people who are infected with the virus remain asymptomatic and do not develop noticeable symptoms at any point in time, but they still can spread the disease. 
Around 20% of those people will remain asymptomatic throughout infection, and the rest will develop symptoms later on, becoming pre-symptomatic rather than asymptomatic and therefore having a higher risk of transmitting the virus to others. 
Some people continue to experience a range of effects—known as long COVID—for months after recovery, and damage to organs has been observed. Multi-year studies are underway to further investigate the long-term effects of the disease.<br>

The virus that causes COVID-19 spreads mainly when an infected person is in close contact[a] with another person.
Small droplets and aerosols containing the virus can spread from an infected person's nose and mouth as they breathe, cough, sneeze, sing, or speak. Other people are infected if the virus gets into their mouth, nose or eyes. The virus may also spread via contaminated surfaces, although this is not thought to be the main route of transmission. 
The exact route of transmission is rarely proven conclusively, but infection mainly happens when people are near each other for long enough. People who are infected can transmit the virus to another person up to two days before they themselves show symptoms, as can people who do not experience symptoms. 
People remain infectious for up to ten days after the onset of symptoms in moderate cases and up to 20 days in severe cases. 
Several testing methods have been developed to diagnose the disease. The standard diagnostic method is by detection of the virus' nucleic acid by real-time reverse transcription polymerase chain reaction (rRT-PCR), transcription-mediated amplification (TMA), or by reverse transcription loop-mediated isothermal amplification (RT-LAMP) from a nasopharyngeal swab.<br>

Preventive measures include physical or social distancing, quarantining, ventilation of indoor spaces, covering coughs and sneezes, hand washing, and keeping unwashed hands away from the face. 
The use of face masks or coverings has been recommended in public settings to minimise the risk of transmissions. 
Several vaccines have been developed and several countries have initiated mass vaccination campaigns.

Although work is underway to develop drugs that inhibit the virus, the primary treatment is currently symptomatic. 
Management involves the treatment of symptoms, supportive care, isolation, and experimental measures.
<br><br>
<h3><strong>Signs and Symptoms</strong></h3>
<hr style="height:2px;
      border-width:0;
      color:gray;
      background-color:gray">
      
      Symptoms of COVID-19 are variable, ranging from mild symptoms to severe illness. 
      Common symptoms include headache, loss of smell and taste, nasal congestion and rhinorrhea, cough, muscle pain, sore throat, fever, diarrhea, and breathing difficulties. 
      People with the same infection may have different symptoms, and their symptoms may change over time. Three common clusters of symptoms have been identified: one respiratory symptom cluster with cough, sputum, shortness of breath, and fever; a musculoskeletal symptom cluster with muscle and joint pain, headache, and fatigue; a cluster of digestive symptoms with abdominal pain, vomiting, and diarrhea. 
      In people without prior ear, nose, and throat disorders, loss of taste combined with loss of smell is associated with COVID-19.<br>

Most people (81%) develop mild to moderate symptoms (up to mild pneumonia), while 14% develop severe symptoms (dyspnea, hypoxia, or more than 50% lung involvement on imaging) and 5% of patients suffer critical symptoms (respiratory failure, shock, or multiorgan dysfunction). 
At least a third of the people who are infected with the virus do not develop noticeable symptoms at any point in time. 
These asymptomatic carriers tend not to get tested and can spread the disease. 
Other infected people will develop symptoms later, called "pre-symptomatic", or have very mild symptoms and can also spread the virus.<br>

As is common with infections, there is a delay between the moment a person first becomes infected and the appearance of the first symptoms. The median delay for COVID-19 is four to five days. 
Most symptomatic people experience symptoms within two to seven days after exposure, and almost all will experience at least one symptom within 12 days.<br>

Most people recover from the acute phase of the disease. However, some people continue to experience a range of effects for months after recovery—named long COVID—and damage to organs has been observed. Multi-year studies are underway to further investigate the long-term effects of the disease.
<br><br>
<h3><strong>Cause</strong></h3>
<hr style="height:2px;
      border-width:0;
      color:gray;
      background-color:gray">
Coronavirus disease 2019 (COVID-19) spreads from person to person mainly through the respiratory route after an infected person coughs, sneezes, sings, talks or breathes. 
A new infection occurs when virus-containing particles exhaled by an infected person, either respiratory droplets or aerosols, get into the mouth, nose, or eyes of other people who are in close contact with the infected person. 
During human-to-human transmission, an average 1000 infectious SARS-CoV-2 virions are thought to initiate a new infection.<br><br>

The closer people interact, and the longer they interact, the more likely they are to transmit COVID-19. Closer distances can involve larger droplets (which fall to the ground) and aerosols, whereas longer distances only involve aerosols. 
Larger droplets can also turn into aerosols (known as droplet nuclei) through evaporation. 
The relative importance of the larger droplets and the aerosols is not clear as of November 2020; however, the virus is not known to spread between rooms over long distances such as through air ducts. 
Airborne transmission is able to particularly occur indoors, in high risk locations such as restaurants, choirs, gyms, nightclubs, offices, and religious venues, often when they are crowded or less ventilated. 
It also occurs in healthcare settings, often when aerosol-generating medical procedures are performed on COVID-19 patients.<br><br>

Although it is considered possible there is no direct evidence of the virus being transmitted by skin to skin contact. 
A person could get COVID-19 indirectly by touching a contaminated surface or object before touching their own mouth, nose, or eyes, though this is not thought to be the main way the virus spreads. 
The virus is not known to spread through feces, urine, breast milk, food, wastewater, drinking water, or via animal disease vectors (although some animals can contract the virus from humans). It very rarely transmits from mother to baby during pregnancy.<br><br>

Social distancing and the wearing of cloth face masks, surgical masks, respirators, or other face coverings are controls for droplet transmission. 
Transmission may be decreased indoors with well maintained heating and ventilation systems to maintain good air circulation and increase the use of outdoor air.<br><br>

The number of people generally infected by one infected person varies. 
Coronavirus disease 2019 is more infectious than influenza, but less so than measles. It often spreads in clusters, where infections can be traced back to an index case or geographical location. 
There is a major role of "super-spreading events", where many people are infected by one person.<br><br>

A person who is infected can transmit the virus to others up to two days before they themselves show symptoms, and even if symptoms never appear. 
People remain infectious in moderate cases for 7–12 days, and up to two weeks in severe cases. In October 2020, medical scientists reported evidence of reinfection in one person.
<br><br>

Source: <a href="https://en.wikipedia.org/wiki/COVID-19" style="color: blue;" target="_blank">Wikipedia</a>
</div>
</div>
</div>





<!--------------------------------------------------------------- PAGE BODY ENDS ------------------------------------------------------------>

<?php if (isset($_SESSION['signup-success'])) : ?>
<div class="container">
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 
<?php 
    echo $_SESSION['signup-success']; 
    unset($_SESSION['signup-success']);
?>
    
</div>
</div>
    <?php endif ?>

<?php
include ('basescript.html');
?>


</body>
<?php
include ('footer.php');
?>
</html>

