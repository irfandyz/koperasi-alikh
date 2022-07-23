<?php

use Illuminate\Support\Facades\DB; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Koperasi Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/img/icon.ico" type="image/x-icon') }}" />
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
	<style>
		.button-custom {
			background: #84C225;
			color: #FFFFFF;
			font-weight: bold;
		}

		.custom-input {
			padding: 10px;
			width: 100%;
			height: 40px;
			background: none;
			border: none;
			border-bottom: solid 2px #D4BBDD;
			color: rgb(136, 136, 136);
		}
	</style>
</head>

<body style="background: #006633">
	<div class="jumbotron jumbotron-fluid">
	    <div class="container container-fluid">
	        <h1>Privacy Policy for Koperasi Al Ikhlas</h1>

            <p>At Koperasi Al Ikhlas, accessible from http://koperasi-alikhlas.online/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Koperasi Al Ikhlas and how we use it.</p>
            
            <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
            
            <h2>Log Files</h2>
            
            <p>Koperasi Al Ikhlas follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicyonline.com/privacy-policy-generator/">Privacy Policy Generator</a>.</p>
            
            
            
            
            <h2>Privacy Policies</h2>
            
            <P>You may consult this list to find the Privacy Policy for each of the advertising partners of Koperasi Al Ikhlas.</p>
            
            <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on Koperasi Al Ikhlas, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
            
            <p>Note that Koperasi Al Ikhlas has no access to or control over these cookies that are used by third-party advertisers.</p>
            
            <h2>Third Party Privacy Policies</h2>
            
            <p>Koperasi Al Ikhlas's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>
            
            <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites. What Are Cookies?</p>
            
            <h2>Children's Information</h2>
            
            <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>
            
            <p>Koperasi Al Ikhlas does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
            
            <h2>Online Privacy Policy Only</h2>
            
            <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Koperasi Al Ikhlas. This policy is not applicable to any information collected offline or via channels other than this website.</p>
            
            <h2>Consent</h2>
            
            <p>By using our website, you hereby consent to our Privacy Policy and agree to its Terms and Conditions.</p>    
	    </div>
	</div>

	<!--  <div class="row d-flex justify-content-center mt-5 py-5">-->
	<!--    <div class="container-fluid container p-5 bg-light rounded">-->
	<!--        <div class="text-center pb-3">-->
	<!--		    <img src="{{asset('images/logo.png')}}" width="150px" height="150px">-->
	<!--		    </div>-->

	<!--			<h2 class="text-center"></h2>-->
	<!--			<h2 class="text-center">Welcome</h2>-->
	<!--			<form action="{{ asset('postLogin') }}" method="post">-->
	<!--				@csrf-->
	<!--				<input type="text" name="username" id="" autocomplete="off" class="custom-input mt-3" placeholder="Username">-->
	<!--				<input type="password" name="password" id="" class="custom-input mt-3" placeholder="Password">-->
	<!--				<button type="submit" class="btn btn-block mt-3 button-custom">Submit</button>-->
	<!--			</form>-->
	<!--    </div>-->
	<!--</div>-->

	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

</body>

</html>