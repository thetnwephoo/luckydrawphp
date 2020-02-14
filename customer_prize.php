<?php 
session_start();
$auth = isset($_SESSION['auth']);
if($auth) {
require_once "inc/header.php"; 
require_once "inc/functions.php"; 

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $prize_id= filter_input(INPUT_POST,'prize_id' , FILTER_SANITIZE_NUMBER_INT);
  $winning_number = trim(filter_input(INPUT_POST,'winning_number' , FILTER_SANITIZE_NUMBER_INT));
  // var_dump($prize_id);
  // exit;
  if(add_winning_number($prize_id,$winning_number)){
      echo "<script type='text/javascript'> window.location = 'all_customer_prizes.php'; </script>";

      echo "success";
      exit;
  }else{
      $error_message = 'Could not add project';
      exit;
  }
}


?>
<div class="container custom-prize hero-section">
<div class="action_icon">
  <img src="img/iconfinder_b-42_4229852.png" alt="project list icon" class="img-fluid mb-2">
</div>
    <form id="customer_prize" action="customer_prize.php" method="post">
    <div class="form-group">
    <label for="prize_id">Prize:</label>
    <select class="form-control"  required name="prize_id" id="prize_id" title="Please select prize type">
    <option value=""> Select prize type here</option>
    <?php 
        // get_customer_list();
        foreach (get_prize_for_winning() as $prizes) {
          echo "<option value='".$prizes['id']."'>".$prizes['prize_type']."</option>";
        }
    ?>
    </select>
    </div>
    <div class="form-group">
    <label for="ramdom">Generated Randomly:</label>
    <select class="form-control" id="random" required>
    <option value="">Please select generated randomly</option>
      <option value="yes">Yes</option>
      <option value="no">No</option>
    </select>
    </div>
    <div class="form-group">
        <label for="winning_number">Winning Number:</label>
        <input type="text"  pattern="\d*" min="0000" max="9999" minlength="4" step="4" maxlength="4" size="4" class="form-control" id="winning_number" placeholder="Enter the winning number here" title="Please enter the winning number" name="winning_number">
    </div>
      <button class="btn btn-md btn-success button-margin demo" type="button" id="draw">Draw</button>
    <button type="submit" class="btn btn-primary button-margin" id="btn_draw">Save</button>
    </form>
</div>




<script>
  $('option:not(:nth-child(2))').attr("disabled","disabled");
$('#draw').click(function(){
 
    var prize_id = $('#prize_id').val();
    console.log(prize_id);
    
    $.ajax({
      
      type: 'GET',
        // url: 'http://luckydrawphp.itbankus.com/inc/get_winning_num.php',
      url: 'http://localhost:70/luckydrawphp/inc/get_winning_num.php',
    
      data: { functionname : 'get_winning_number' , arguments: prize_id},
      dataType: "json",
     
      success: function(response) {
        console.log(response.lucky_number);
        $('#winning_number').val(response.lucky_number);
        $('#draw').hide();
      },
      error: function(xhr, status, error) {
        alert("Please add more customer!")
 }
  });
});
</script>

<?php
}

else {
    header('location:login-form.php');
}
include "inc/footer.php";
?>