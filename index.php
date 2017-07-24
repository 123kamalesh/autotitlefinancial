<?php
session_start();
require_once "../includes/functions.php"; 
$states = statesList();
$months = monthsList(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Auto Title Financial</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="/styles.css" />

</head>
<body>
<!--header start-->
<div class="header">
  <div class="header-safe">
    <div class="hdr-lft">
      <div class="hdr-text"><img src="/images/header-text.png" alt="" /></div>
      <div class="hdr-list">
        <ul>
          <li>Affordable Payment Options!</li>
          <li>Fast, Easy, & Secure!</li>
          <li>No Credit Check!</li>
          <li>Keep your Car!</li>
        </ul>
      </div>
      <div class="top-arrow"><img src="/images/arrow-text.png" alt="" /></div>
    </div>
    <div class="hdr-rit">
      <div class="logo"><img src="/images/logo.png" alt="" /></div>
      	<form method="post" action="/moreinfo.php" name="front-page" id="front-page">
      		<input name="aff_id" value="<?php echo (isset($_REQUEST['aff_id']) ? $_REQUEST['aff_id'] : '1' ) ?>" type="hidden" />
            <input name="sub_id" value="<?php echo (isset($_REQUEST['sub_id']) ? $_REQUEST['sub_id'] : '1' ) ?>" type="hidden" />
            <input name="sub_id2" value="<?php echo (isset($_REQUEST['sub_id2']) ? $_REQUEST['sub_id2'] : '1' ) ?>" type="hidden" />
            <input name="offer_id" value="<?php echo (isset($_REQUEST['offer_id']) ? $_REQUEST['offer_id'] : '1' ) ?>" type="hidden" />
      
          <div class="applic-form">
            <div class="form-head"><img src="/images/form-head.png" alt="" /></div>
            <div class="form-top"> Fill out our Quick and Easy <span class="text">3 Minute application</span></div>
            <div class="form-raw">
              <div class="form-raw-lft">First Name</div>
              <div class="form-raw-rit">
                <input type="text" name="first_name" class="required" />
              </div>
              <div class="clear"></div>
            </div>
            <div class="form-raw">
              <div class="form-raw-lft">Last Name</div>
              <div class="form-raw-rit">
                <input type="text" name="last_name" class="required" />
              </div>
              <div class="clear"></div>
            </div>
            <div class="form-raw">
              <div class="form-raw-lft">Phone Number</div>
              <div class="form-raw-rit">
                  <input type="text" name="primary_phone" class="required" />
              </div>
              <div class="clear"></div>
            </div>
            <div class="form-raw">
              <div class="form-raw-lft">Email Address</div>
              <div class="form-raw-rit">
                <input type="text" name="email" class="required" id="email" />
                <div id="email_suggestion"></div>
              </div>
              <div class="clear"></div>
            </div>
            <div class="form-raw">
              <div class="form-raw-lft">Street Address</div>
              <div class="form-raw-rit">
                <input type="text" name="street_address" class="required" />
              </div>
              <div class="clear"></div>
            </div>
            
            <div class="form-raw-last">
              <div class="form-raw-lft">Postal Code</div>
              <div class="form-raw-rit">
                <input type="text" name="zipcode" class="required" />
              </div>
       
                
              <div class="clear"></div>
            </div>
            <div class="apply-now-btn">
              <input id="step1button" type="submit" onClick="exit=false;" value="APPLY FREE NOW" />
            </div>
          </div>
      </form>
    </div>
    <div class="clear"></div>
  </div>
</div>
<!--header end-->
<!--mid start-->
<div id="mid">
  <div class="mid-lft">
    <h1>get cash fast!</h1>
    <h3>If you have the title to your car!</h3>
    <p>Are you in need of fast cash? Auto Title Financial is your trusted & secured online auto title lending matching service.  Auto Title Financial is not a direct lender, but a lending matching service.</p>
    <p>Auto Title Financial has partnered with auto title lenders nationwide to match you to the best qualified lender in your area!</p>
    <div class="mid-lft-pic"><img src="/images/cash-chavy.jpg" alt="" /></div>
  </div>
  <div class="mid-rit">
    <h2>3 Easy Steps</h2>
    <h3>to your fast & Secure <br />
      Auto Title Loan:</h3>
    <div class="mid-rit-raw">
      <div class="raw-lft">
        <h4>1. FILL OUT THE FORM</h4>
        <p>Quick & Secure 3 Minute Application</p>
      </div>
      <div class="raw-rit"><img src="/images/fill-out-icon.gif" alt="" /></div>
      <div class="clear"></div>
    </div>
    <div class="mid-rit-raw">
      <div class="raw-lft">
        <h4>2. REQUEST A LOAN</h4>
        <p>We will match you to over 25 auto title lenders.</p>
      </div>
      <div class="raw-rit"><img src="/images/loan-icon.gif" alt="" /></div>
      <div class="clear"></div>
    </div>
    <div class="mid-rit-raw">
      <div class="raw-lft">
        <h4>3. GET CASH FAST</h4>
        <p>Once approved we will call to get you your cash!</p>
      </div>
      <div class="raw-rit"><img src="/images/fast-cash-icon.gif" alt="" /></div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<!--mid end-->
<div class="footer">
  <div class="ftr-safe">
    <div class="btm-arrow"><img src="/images/btm-arrow-text.png" alt="" /></div>
    <div class="btm-apply-btn">
      <input type="submit" value="APPLY FREE NOW" />
    </div>
    <div class="clear"></div>
    <div class="nav"><a href="/">Home</a> | <a href="/how-it-works.php">How It Works</a> | <a href="/privacy.php">Privacy Policy</a> | <a href="/about-us.php">About Us</a> | <a href="http://unsubmyemail.org/MTE1NjJ8MTQ">Unsubscribe</a></div>
    <p>*LEGAL DISCLAIMER: The operator of this website is not responsible for making any decisions regarding loans and credits. The information on our website is nothing more than advertising.<br />
      The procedure of loan application is being held in order to archive the best cooperating match between the borrower and the lender and it is based on the applicant’s information.<br />
      It should be mentioned, that provided data will be available to third parties. Every application is introduced to a variety of lenders in order to increase the chance of success.<br />
      The operator of the site does not deal with any of the lender products or lender institutions. The period of money transferring can differ, and in some cases faxing can be necessary.<br />
      Filling out this application does not insure you of approval of any services provided. Credit checks are not popular, but do not hesitate and ask your individual lender in case of necessity.<br />
      By submitting your information, you certify that you are a US resident over 18 years of age and that you agree to ONLINE AUTO TITLEs PRIVACY POLICY AND TERMS & CONDITIONS.<br />
      You also agree to receive calls from trusted 3rd parties even if your phone is listed on a DNC (Do Not Call) List.<br />
      You agree to receive promotional emails, phone calls and offers from AUTOTITLEFINANCIAL.COM  and its affiliated marketing partners.*<br />
      This service does not constitute an offer or solicitation for short term loans in all states.<br />
      This service may or may not be available in your particular state.The states this site services may change from time to time without notice.<br />
      All aspects and transactions on this site will be deemed to have taken place in our office, regardless of where you may be viewing or accessing this site.</p>
  </div>
</div>
<script type="text/javascript" src="/js/mailcheck.js?ver=001"></script>
<script type="text/javascript" src="/js/jquery.validate.js?ver=001"></script>
<script type="text/javascript" src="/js/cashform.js?ver=001"></script>
</body>
</html>
