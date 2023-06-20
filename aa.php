<!DOCTYPE html>
<html>

<head>
  <title>Form with Two Parts</title>
  <style>
    .but {
      display: inline-block;
      float: right;
      padding: 8px 16px;
      background-color: green;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 4px;
      cursor: pointer;
      border: none;
    }

    .containerData {
      display: flex;
      flex-wrap: wrap;
    }

    .itemX {
      flex: 0 0 200px;
      margin: 10px;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    select {
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 200px;
      width: 70%;
      display: block;
      margin: 0 auto;
      text-align: center;
    }

    option {
      padding: 8px;
    }

    .bodyX {
      margin: 50px 100px 100px 100px;
      padding: 20px 50px 50px 50px;
      background-color: lightblue;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    //Table Design
    .custom-table {
      width: 100%;
      border-collapse: collapse;
    }

    .custom-table th,
    .custom-table td {
      padding: 10px;
      text-align: left;
      border: 1px solid #ddd;
    }

    .custom-table th {
      background-color: #f2f2f2;
    }

    .custom-table tbody tr {
      background-color: #f9f9f9;
    }

    #hiddenDiv {
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .hidden {
      display: none;
    }


    .radio-select {
      display: flex;
      float: right;
    }

    .radio-select label {
      margin-right: 10px;
    }

    .radio-button {
      display: inline-block;
      padding: 5px 10px;
      background-color: #FFA500;
      color: white;
      cursor: pointer;
      border-radius: 4px;
    }

    .radio-button:hover {
      background-color: darkgreen;
    }

    #secondHalfForm {
      margin-left: 30%;
    }

    #secondHalfForm>label {
      text-align: center;
      display: inline-block;
      font-size: 120%;
      margin-right: 3%;
    }
  </style>
</head>

<body>
  <div id="formContainer">
    <div id="firstHalf">
      <div class="bodyX"">
             
                    <h4 align=" left" id="toggleButton">
        Show/hide previous appointments ⬇
        </h4>
        <div id="hiddenDiv" class="hidden">
          <table class="custom-table">
            <tr>
              <th>AID</th>
              <th>Specialization</th>
              <th>Doctor</th>
              <th>Date & Time</th>
              <th>Status</th>
            </tr>
            <tbody>
              <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
              </tr>
              <tr>
                <td>Data 4</td>
                <td>Data 5</td>
                <td>Data 6</td>
              </tr>
            </tbody>
          </table>
          <?php
          #<-----Fetching Previous Booked Appointments------>
          ?>
          </table>
        </div>
        </h4>


        <hr>
        <h2 align="center">Book a new Appointment</h2>
        <label for="firstSelect">
          <h2 align="center">
            <h3 align="center">Select a Specialization: </h3>
        </label>
        <select id="firstSelect" name="specialization" onchange="fetchData()">
          <option value="">Select an option</option>
          <option value="diab">Diab</option>
          <option value="cardio">Cardio</option>
        </select>
        <div id="selectedSpec"></div>

        <!--Initalizing the form for appointment booking-->

        <form method="POST" action="">

          <div id="printArea" class="containerData"></div>

          <button type="button" class="but" onclick="showSecondHalf()">Next</button>
        </form>


      </div>

    </div>

    <!-----Second Half------->

    <div id="secondHalf" class="bodyX hidden">
      <h3 align="center">Step 2</h3>
      <button type="button" class="but" style="background-color: red; float: left;" onclick="goBack()">Back</button>
      <br><br><br><br>

      <hr> <br><br><br>
      <form id="secondHalfForm" method="POST" action="">
        <input type="hidden" name="radio-option" value="">

        <label for="date">Select a date: </label>
        <input type="date" id="date" style="font-size: 180%" name="date" required>

        <br>
        <br>

        <label for="time">Select a time: </label>
        <input type="time" style="font-size: 180%" id="time" name="time" required>

        <br>
        <br>
        <br>
        <label for="description">Description: </label><br>
         <textarea id="description" name="desc" type="textarea" rows="4" cols="40"></textarea><br><br><br>
        <input class="but" type="submit" value="Book Appointment">
      </form>

      </form>
    </div>

  </div>






  <script>
    //main form hide/show
    function showSecondHalf() {
      var firstHalf = document.getElementById('firstHalf');
      var secondHalf = document.getElementById('secondHalf');
      var drSelected = document.querySelector('input[name="radio-option"]:checked').value;
      var secondHalfForm = document.getElementById('secondHalfForm');
      var drSelectedInput = secondHalfForm.querySelector('input[name="radio-option"]');
      drSelectedInput.value = drSelected;

      firstHalf.style.display = 'none';
      secondHalf.style.display = 'block';
    }

    function goBack() {
      var firstHalf = document.getElementById('firstHalf');
      var secondHalf = document.getElementById('secondHalf');
      firstHalf.style.display = 'block';
      secondHalf.style.display = 'none';
    }
    //AJAX fetch data
    function fetchData() {
      var selectElement = document.getElementById('firstSelect');
      var selectedOption = selectElement.value;

      if (selectedOption !== "") {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              var response = xhr.responseText;
              var printArea = document.getElementById('printArea');
              selectedSpec.innerHTML = '<h3>List of Doctors under specialization: ' + selectedOption + '</h3>';
              printArea.innerHTML = response;
            } else {
              console.log('Error: ' + xhr.status);
            }
          }
        };

        xhr.open('GET', 'fetch_data.php?option=' + selectedOption, true);
        xhr.send();
      } else {
        var printArea = document.getElementById('printArea');
        printArea.innerHTML = ''; // Clear the print area if no option is selected
      }
    }

    //Show or hide Div
    const toggleButton = document.getElementById('toggleButton');
    const hiddenDiv = document.getElementById('hiddenDiv');

    toggleButton.addEventListener('click', function () {
      if (hiddenDiv.classList.contains('hidden')) {
        hiddenDiv.classList.remove('hidden');
        setTimeout(function () {
          hiddenDiv.style.opacity = 1;
          hiddenDiv.style.visibility = 'visible';
        }, 10);
      } else {
        hiddenDiv.style.opacity = 0;
        hiddenDiv.style.visibility = 'hidden';
        setTimeout(function () {
          hiddenDiv.classList.add('hidden');
        }, 500);
      }
    });


  </script>
</body>

</html>