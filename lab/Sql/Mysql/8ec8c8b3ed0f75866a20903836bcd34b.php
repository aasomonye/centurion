<?php

return array (
  'centurion-app' => 
  array (
    'Centurion_accounts' => 
    array (
      '51b76cfe9426403f672676c5b5d56895b1044e0d79982294c50cec63e485623eef91e5eb' => 
      array (
        'query' => 'INSERT INTO Centurion_accounts (account_name,account_base_url) VALUES (:account_name0,:account_base_url0)',
        'bind' => 
        array (
          'account_name0' => 'customer',
          'account_base_url0' => 'customer/dashboard',
        ),
      ),
      '51b76cfe9426403f672676c5b5d56895d31faa8e1bd26eaeb5001331ec9889f3636545fb' => 
      array (
        'query' => 'INSERT INTO Centurion_accounts (account_name,account_base_url) VALUES (:account_name0,:account_base_url0)',
        'bind' => 
        array (
          'account_name0' => 'admin',
          'account_base_url0' => 'admin/dashboard',
        ),
      ),
      '51b76cfe9426403f672676c5b5d5689522a3b7c5155317375dfdcce8acb06cacbc6bc3ec' => 
      array (
        'query' => 'INSERT INTO Centurion_accounts (account_name,account_base_url) VALUES (:account_name0,:account_base_url0)',
        'bind' => 
        array (
          'account_name0' => 'partner',
          'account_base_url0' => 'partner/dashboard',
        ),
      ),
      '51b76cfe9426403f672676c5b5d5689543101abcd18c2f3b57cb918ff04f644b877786cf' => 
      array (
        'query' => 'INSERT INTO Centurion_accounts (account_name,account_base_url) VALUES (:account_name0,:account_base_url0)',
        'bind' => 
        array (
          'account_name0' => 'prenium',
          'account_base_url0' => 'customer/dashboard',
        ),
      ),
    ),
    'Centurion_nationality' => 
    array (
      '4369849d7cdc51fc83c3e2511cde19e7372a3456d685eb2df122a5b9d992fa9b435a088b' => 
      array (
        'query' => 'INSERT INTO Centurion_nationality (country_name,country_code) VALUES (:country_name0,:country_code0)',
        'bind' => 
        array (
          'country_name0' => 'Nigerian',
          'country_code0' => 'NG',
        ),
      ),
      '4369849d7cdc51fc83c3e2511cde19e7b3e3ea61c193c37da2aacad94af096ad92b17cac' => 
      array (
        'query' => 'INSERT INTO Centurion_nationality (country_name,country_code) VALUES (:country_name0,:country_code0)',
        'bind' => 
        array (
          'country_name0' => 'Ghanian',
          'country_code0' => 'GH',
        ),
      ),
    ),
    'Centurion_lock_status' => 
    array (
      'd3a605c76be9b5a75722724dfd672117715ce51dd0a464749b69f48a30cffdb5eafe10df' => 
      array (
        'query' => 'INSERT INTO Centurion_lock_status (lock_status,lock_note,lock_screen_link) VALUES (:lock_status0,:lock_note0,:lock_screen_link0)',
        'bind' => 
        array (
          'lock_status0' => 'blocked',
          'lock_note0' => 'Account was blocked by the system',
          'lock_screen_link0' => 'app/contact',
        ),
      ),
      'd3a605c76be9b5a75722724dfd6721178b4c143a8ff8b07ca996e98b3b1ddbeb48daa29e' => 
      array (
        'query' => 'INSERT INTO Centurion_lock_status (lock_status,lock_note,lock_screen_link) VALUES (:lock_status0,:lock_note0,:lock_screen_link0)',
        'bind' => 
        array (
          'lock_status0' => 'password reset',
          'lock_note0' => 'Account was locked due to password reset',
          'lock_screen_link0' => 'app/activate',
        ),
      ),
      'd3a605c76be9b5a75722724dfd6721174440ff95aa326d7b8789daea9b4e4c17aa85e628' => 
      array (
        'query' => 'INSERT INTO Centurion_lock_status (lock_status,lock_note,lock_screen_link) VALUES (:lock_status0,:lock_note0,:lock_screen_link0)',
        'bind' => 
        array (
          'lock_status0' => 'profile update',
          'lock_note0' => 'Account was locked due to profile update',
          'lock_screen_link0' => 'app',
        ),
      ),
      'd3a605c76be9b5a75722724dfd67211700b0a9d574e89be940574cd14179233bd84c0d43' => 
      array (
        'query' => 'INSERT INTO Centurion_lock_status (lock_status,lock_note,lock_screen_link) VALUES (:lock_status0,:lock_note0,:lock_screen_link0)',
        'bind' => 
        array (
          'lock_status0' => 'new account',
          'lock_note0' => 'Account was locked due to verification',
          'lock_screen_link0' => 'dashboard',
        ),
      ),
    ),
    'Centurion_email_templates' => 
    array (
      '4cd261cbd026483f1622375c36f176cddb2fd2a49d4ef7672aa2f1f2252e008cd83d177f' => 
      array (
        'query' => 'INSERT INTO Centurion_email_templates (lockid,template_name,template_body) VALUES (:lockid0,:template_name0,:template_body0)',
        'bind' => 
        array (
          'lockid0' => '4',
          'template_name0' => 'onboarding',
          'template_body0' => '<div class="template-wrapper">
	<div class="template-body">
		<h1>Welcome Onboard</h1>
		<p>Hello <b>{name},</b> we are happy to have you on board and we look forward to your satisfaction and happiness. So what’s next? Your account has a pending confirmation. Click on the button below to confirm your account.</p>
		<div class="template-button">
			<a href="{link}" target="_blank">Confirm my account</a>
		</div>

		<div class="template-footer">
			<ul>
				<li><a href="">About us</a></li>
				<li><a href="">Properties</a></li>
				<li><a href="">Car rental</a></li>
				<li><a href="">Become a partner</a></li>
				<li><a href="">Trust & Safety</a></li>
				<li><a href="">Best price</a></li>
			</ul>
			<span class="template-footer-text">
				© {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
			</span>

			<span class="template-footer-small-text">
				You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
			</span>
		</div>
	</div>
</div>',
        ),
      ),
      '4cd261cbd026483f1622375c36f176cde709b9aac600eb69af81b78cbedd00eeeedd7341' => 
      array (
        'query' => 'INSERT INTO Centurion_email_templates (lockid,template_name,template_body) VALUES (:lockid0,:template_name0,:template_body0)',
        'bind' => 
        array (
          'lockid0' => '4',
          'template_name0' => 'resend activation',
          'template_body0' => '<div class="template-wrapper">
	<div class="template-body">
		<h1>Account Activation</h1>
		<p>Hi there, you are just one step away from unlocking all the amazing features for your account. Confirming your account would allow you make bookings,reservations and much more. Why wait?</p>
		<div class="template-button">
			<a href="{link}" target="_blank">Confirm my account</a>
		</div>

		<div class="template-footer">
			<ul>
				<li><a href="">About us</a></li>
				<li><a href="">Properties</a></li>
				<li><a href="">Car rental</a></li>
				<li><a href="">Become a partner</a></li>
				<li><a href="">Trust & Safety</a></li>
				<li><a href="">Best price</a></li>
			</ul>
			<span class="template-footer-text">
				© {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
			</span>

			<span class="template-footer-small-text">
				You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
			</span>
		</div>
	</div>
</div>',
        ),
      ),
      '4cd261cbd026483f1622375c36f176cd964138b8b76ae445f043e3da71f661afeeb62d0e' => 
      array (
        'query' => 'INSERT INTO Centurion_email_templates (lockid,template_name,template_body) VALUES (:lockid0,:template_name0,:template_body0)',
        'bind' => 
        array (
          'lockid0' => '4',
          'template_name0' => 'confirmation complete',
          'template_body0' => '<div class="template-wrapper">
	<div class="template-body">
		<h1>Confirmation Complete</h1>
		<p>Hello <b>{name},</b> we are happy you made it! We look forward to your satisfaction and happiness. So what’s next? Explore our top destinations, properties and cars for rentals. Click on the button below to proceed.</p>
		<div class="template-button">
			<a href="{link}" target="_blank">My account</a>
		</div>

		<div class="template-footer">
			<ul>
				<li><a href="">About us</a></li>
				<li><a href="">Properties</a></li>
				<li><a href="">Car rental</a></li>
				<li><a href="">Become a partner</a></li>
				<li><a href="">Trust & Safety</a></li>
				<li><a href="">Best price</a></li>
			</ul>
			<span class="template-footer-text">
				© {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
			</span>

			<span class="template-footer-small-text">
				You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
			</span>
		</div>
	</div>
</div>',
        ),
      ),
      '4cd261cbd026483f1622375c36f176cd140aed04c90123660d44a57f5066733c18a63648' => 
      array (
        'query' => 'INSERT INTO Centurion_email_templates (lockid,template_name,template_body) VALUES (:lockid0,:template_name0,:template_body0)',
        'bind' => 
        array (
          'lockid0' => '2',
          'template_name0' => 'password reset',
          'template_body0' => '<div class="template-wrapper">
	<div class="template-body">
		<h1>Password Recovery</h1>
		<p>Hi there, a password reset was initiated on your account on the {date} with this IP address {ipaddress}.  Please ignore this if it wasn’t you, or proceed with this request by clicking on the button below if it was you</p>
		<div class="template-button">
			<a href="{link}" target="_blank">Reset my password</a>
		</div>

		<div class="template-footer">
			<ul>
				<li><a href="">About us</a></li>
				<li><a href="">Properties</a></li>
				<li><a href="">Car rental</a></li>
				<li><a href="">Become a partner</a></li>
				<li><a href="">Trust & Safety</a></li>
				<li><a href="">Best price</a></li>
			</ul>
			<span class="template-footer-text">
				© {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
			</span>

			<span class="template-footer-small-text">
				You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
			</span>
		</div>
	</div>
</div>',
        ),
      ),
    ),
  ),
);

?>