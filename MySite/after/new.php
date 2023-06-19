<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>

<div class="container" style="margin-top: 20px">
  <button class="btn btn-primary" onclick="openModal()">
   OPEN MODAL
  </button>
  
  <div id="modal-window"  class="shadow" >
    <div class="main-modal">
      <h1>Main Modal</h1>
      <button class="btn btn-danger" onclick="closeM()">
        CLOSE MODAL
      </button>
      
    </div>
  </div>
</div>

<script>

  let ini= document.querySelector('#modal-window');
  ini.classList.add("hideModal");
  
  function openModal(){
  let modal= document.querySelector('#modal-window');
  modal.classList.add("showModal");
  
}

function closeM(){

    let m= document.querySelector('#modal-window');
  m.classList.remove("showModal");
  
}
  
</script>

    </body>

</html>


