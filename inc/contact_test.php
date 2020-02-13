<!-- Intro section -->
   <script src="http://code.jquery.com/jquery-1.10.2.js"></script>

    <script src='https://www.google.com/recaptcha/api.js'></script>
<script>



</script>
<!--for check button-->


<section class="intro-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-title">
						<h2>Contact</h2>
						<form action="#" id="receptcha_form"  onsubmit="return submitUserForm();">
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter your name here" title="Please enter your name" required>
								
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address:</label>
								<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter your email here" title="Please enter your email" required>
								
							</div>
							<div class="form-group">
								<label for="phone">Phone Number:</label>
								<input type="tel" pattern="[0-9]{2}[0-9]{9}" class="form-control" name="phone" id="phone" aria-describedby="emailHelp" placeholder="Enter your phone number here" title="Please enter your phone number" required>
								
							</div>
							<div class="form-group">
								<label for="message">Your Message:</label>
								<textarea class="form-control" id="message" rows="3" placeholder="Enter your message here" title="Please enter your message" required></textarea>
							</div>
							<div id="g-recaptcha" class="g-recaptcha" data-sitekey="6Lfioc4UAAAAAN6P5Nd_kaoFsgBRIllKDsYzzbHb"  data-callback="verifyCaptcha"></div>
                            <div id="g-recaptcha-error"></div>
							<input type="submit" class="btn btn-primary" name="submit" value="submit" />
						</form>
						<!--js-->

					</div>
				</div>
				<div class="col-lg-6">
					<img src="img/lucky.jpg">
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->
	
<!--	<form method="post" onsubmit="return submitUserForm();">-->
<!--    <div class="g-recaptcha" data-sitekey="6Lfioc4UAAAAAN6P5Nd_kaoFsgBRIllKDsYzzbHb" data-callback="verifyCaptcha"></div>-->
<!--    <div id="g-recaptcha-error"></div>-->
<!--    <input type="submit" name="submit" value="Submit" />-->
<!--</form>-->

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function submitUserForm() {
    var response = grecaptcha.getResponse();
    if(response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
 
function verifyCaptcha() {
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>