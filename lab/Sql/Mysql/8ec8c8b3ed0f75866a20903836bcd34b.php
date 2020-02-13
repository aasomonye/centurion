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
    'Centurion_authentication' => 
    array (
      'e8f79dcc2ec50bd17087c67649fea98fc6d8a3f77e3f0e5812cd6e4370b6e8ee678483c6' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => '5557a5def0f470018f125cfe510bb4aeb7b6ce8a',
          'session_token' => 'c4ba59afc2ac69193b71332d31e04d1a',
          'authenticationid' => '1',
        ),
      ),
      '16a1f7e9fa4a62eb007ec472b31a48c5356a192b7913b04c54574d18c28d46e6395428ab' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET session_token = :session_token , remember_me_cookie = :remember_me_cookie  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'session_token' => '',
          'remember_me_cookie' => '',
          'authenticationid' => '1',
        ),
      ),
      'e8f79dcc2ec50bd17087c67649fea98f77ccca547c746a1e3d4456686897a8576bc317fd' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => '902ae4de365d7f13cfabf7cb98b5f14c77dde08d',
          'session_token' => 'c226cef664b34a48b9973d945b99f171',
          'authenticationid' => '1',
        ),
      ),
      'e8f79dcc2ec50bd17087c67649fea98f3d7d0f996d508c1beb7d59f716eda8623fe79e1d' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => '5a2e0dc1e6d36cb85de67bbcbf366f0d6c3dea42',
          'session_token' => 'dd1950fd6d0be374e9c3a740be25fabf',
          'authenticationid' => '1',
        ),
      ),
      'e8f79dcc2ec50bd17087c67649fea98fc62013c10d7659daabd820ad305a7de0d9ce63fa' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => 'e2ba043e6098c8152c381df5c1858bd1a76a77dd',
          'session_token' => 'c3da2ec35f559a10640c7a491a04c2e4',
          'authenticationid' => '1',
        ),
      ),
      'e8f79dcc2ec50bd17087c67649fea98f457293cdcac55c69e3f5d37c61e1e3fbbb9752a9' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => '5edeea30e387a5d77666489eaea2160766a049e9',
          'session_token' => 'a17934187e04e7624d993dcd0f13318b',
          'authenticationid' => '1',
        ),
      ),
      '45c79a5911a9a119fd7bd8ef83d664f126633dcaec3768b5176c227acd234a48ea272393' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET remember_me_cookie = :remember_me_cookie  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'remember_me_cookie' => '76018e531a72e8592242cbba1ec3e0b3ead5cdb5',
          'authenticationid' => '1',
        ),
      ),
      '45c79a5911a9a119fd7bd8ef83d664f12a2ae065ff83b7aef1c4ca2138e645c74ee2f490' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET remember_me_cookie = :remember_me_cookie  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'remember_me_cookie' => '14c1a2f02c34b6cab6fa8203c81edfcd6f5564fb',
          'authenticationid' => '1',
        ),
      ),
      '45c79a5911a9a119fd7bd8ef83d664f1478fefe547d7f782154bed1eceb785c95e64ca95' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET remember_me_cookie = :remember_me_cookie  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'remember_me_cookie' => 'be46d5809f59da3ff36ccfb583dc083707466ad3',
          'authenticationid' => '1',
        ),
      ),
      '45c79a5911a9a119fd7bd8ef83d664f11caf7685a785dd8bea1e7b2ebf3bbebb3289ce07' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET remember_me_cookie = :remember_me_cookie  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'remember_me_cookie' => '61dc8939c4ae62d1648701ab8773f7cc25c81172',
          'authenticationid' => '1',
        ),
      ),
      'dea6d8a5319e01962a4f7a6d74cd248c257b60560e5f4beb873920661efea5a5333ceca7' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token , password_hash = :password_hash  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => 'b4b5028fcfd18d97e52c7fcf2984aff1e6470bce',
          'session_token' => '5512cbf542a4e9057e893ada9849113d',
          'password_hash' => '$2y$10$mWMNutFLrILPijstQNPvnutYeymRtZlOuoWdBjHwkFE68R41iNvzq',
          'authenticationid' => '1',
        ),
      ),
      'dea6d8a5319e01962a4f7a6d74cd248cb225a5378c0ed5ffc3818a7581c34770144d9328' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token , password_hash = :password_hash  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => '1469d42183bea7bcf760246f636c8492c1c7c295',
          'session_token' => '841823529878d58a0aee70230db60390',
          'password_hash' => '$2y$10$YPnVtq7k9ewbdA0LG1xg4OIRyvdX1vUOS6UzZOiuJkdIk5hs.gqsS',
          'authenticationid' => '1',
        ),
      ),
      'dea6d8a5319e01962a4f7a6d74cd248cfb2c1cf16d4f219047d41dfb68e5787d93da7b87' => 
      array (
        'query' => 'UPDATE Centurion_authentication SET password_salt = :password_salt , session_token = :session_token , password_hash = :password_hash  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'password_salt' => 'f55e8bd22f62691834f8ded1ea080b7fe95f7f6b',
          'session_token' => '5fbf99deba582dc72910ec6713bfc10c',
          'password_hash' => '$2y$10$ZM2ZdF3.WdRz2gNPgCBCOOqpcLp8acnzGDLrFU2I0BFUPtaY2ai06',
          'authenticationid' => '1',
        ),
      ),
    ),
    'Centurion_login_tracker' => 
    array (
      '0de7d9d70141985603f08b04d9acbfd2ddfe163345d338193ac2bdc183f8e9dcff904b43' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '0',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b24318349c1c995f790f0d443e1352506da30cb54' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:35:02 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7af465717032ce687ccfa8afe29ba38b936870e9' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:36:59 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796befd6a5606bdc07644ec00f157932e43219f854b0' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:40:42 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bca97ecc1b45a87689818e36d949f031cc0260481' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:42:16 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b11d07f3220e018aec37f83d4a68e1ef87c035656' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:42:39 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bb2137c50fd1ace98d5a1a66a44eaa83b37602779' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-08 9:46:56 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796ba5564a20011f4b8b444017e03ed86864d49e10a4' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:16:37 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b526a1e7dfac39f95ef8009955eab04471584e041' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:16:50 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b8f14d3fcfccf9ba4eca968257b225ea3e143a5b1' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:20:40 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7163253f3a0de2878a1932b942042d49a039b840' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:21:48 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b2b254aff1d3b36bd0ffe3282d3f5f8f00d373e35' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:23:03 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bb0e9b57e829436ebc8e882590acdfa9472f4ec56' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:24:33 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b416cf6b325e5f9e480465127723ba85741b5762a' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:26:07 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b4fab5f9b1560140f64f33abd9a0fdfc964648a75' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:38:51 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b05dc02c69a74f4a0293582b68d818cded6287678' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:41:20 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b5c3962e9d133d40a4656639e61079d27fd944497' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:41:54 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b18f54dafa96b59e9e84a42bad6a9728fc9c7af07' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:42:18 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796beebfd9b7b5b0d630e73ebae35132bca1538e4b6a' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:43:06 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796be7c68ee63939cae31d069a657be8d670f9cf19f5' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:45:20 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bbe7e18056597ceb7b243f6cdf57c9835ef2f7a1c' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:45:41 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bf53f4ddf3c6b6e3d5ab46e4f30a4b2ea80342035' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:46:36 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b6be3dcbab138bc8f6fead5285859930f41fa30cf' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:46:51 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bd33e745447ba970823ecca68bd978a016653b9c7' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:47:15 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bc323109626a49f1f1cb3345034d9201b6e180677' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:51:56 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796beb793b543721d5d975a7e1d010dc3479dd047363' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:57:34 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b89467f7c464590a0ff8a2580dee65a3e7fb35432' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:57:52 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bd0ab02266ef5ac07c6e5f8b4db53bf2f9db67bc8' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 1:59:44 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b9f675beb0e90ae74ecdccfe0fc113304467d1f2e' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 2:01:34 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b09420e1848be886081728a72be7bc9d1810e7134' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:07:29 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b5f61209cdcf0d470d4bfba2356ef7e736c124996' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:07:57 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bc68df11bbde50cded427bdad556ee8091916e28d' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:09:53 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b850e4e82056cb25eb6050cdc473e869dd8a9b1af' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:10:55 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bad0f3f965735299b26a8f8d55f441c4474bda4f1' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:11:12 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7cf7ca8f48841cf5d16e5b4959872027c38d776b' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:13:08 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796ba634b4c021716df5b90da90dd82e15cea4c1b564' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:15:50 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b8c6b2c37b49485d80a448e049afd9b7deb39b500' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:23:58 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b816b724dae02be411fe54c20b152827c2f36eb47' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:32:20 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b4dfb0b359c4c2a98bcfcec00e75a56cdf869b239' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:33:41 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b3222b975c203ff9d7ec70a0beae5880e1bf8c10a' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:33:43 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796becb0cc2b6570d9a3d5b6408b1f4db2f54ec51727' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:33:57 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7011e7000d242caef348c8032c6f3e2b4f188c09' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 7:36:18 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b3123693db906985d2feb111e7a008ca397aba53e' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 8:04:04 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796ba432dab894f19b44ca75c576bdff8469c0cedf0d' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 8:05:54 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7200432f302a1df063c2dabedca2abf5f207aad9' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 10:45:11 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7d316d23f55c2aa38e8c9b57f5a29a39f98cca42' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 10:47:40 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b1c1a8d6d40b1a30e9a8cd21bb4b73358e901b85a' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 10:48:15 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bba434dcaaa5176bab4d592dfc04f37fc0a5e0ea1' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 11:09:41 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b33f45740729ee8f6ca7aae9d78b1b2e907131a8c' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 11:10:27 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b7fabe9112f07e23dc713a9b7aa172fae28baaabc' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-12 2:27:16 pm',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796beca9da3923b1525e541b9e33c97e0a52304aa119' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-13 11:07:55 am',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bbb7228e40c96e3912d0de57278d413e13f94cb2e' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-13 1:05:39 pm',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796bcd7728552d57638504cdba5df96c51faee6614fb' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-13 1:07:05 pm',
          'authenticationid' => '1',
        ),
      ),
      '0b7c9587c8693c7a72644fad24b1796b1374786064523655e29739ec939412473fd7ce91' => 
      array (
        'query' => 'UPDATE Centurion_login_tracker SET isloggedin = :isloggedin , last_login = :last_login  WHERE authenticationid = :authenticationid ',
        'bind' => 
        array (
          'isloggedin' => '1',
          'last_login' => '2020-02-13 1:15:03 pm',
          'authenticationid' => '1',
        ),
      ),
    ),
    'Centurion_activations' => 
    array (
      'e08b96326e081b7bed9c442e9667bd1516f57215a01d13cc150a9adf6ccc2ba25e69a20d' => 
      array (
        'query' => 'UPDATE Centurion_activations SET userid = :userid , activation_code = :activation_code , redirect_to = :redirect_to , satisfied = :satisfied , lockid = :lockid , activationid = :activationid  WHERE activation_code = :activation_code0 ',
        'bind' => 
        array (
          'userid' => '1',
          'activation_code' => '840d7497c498a1d10408cc96ce775168a11b1ebb',
          'redirect_to' => 'dashboard',
          'satisfied' => '1',
          'lockid' => '2',
          'activationid' => '7',
          'activation_code0' => '840d7497c498a1d10408cc96ce775168a11b1ebb',
        ),
      ),
      'e08b96326e081b7bed9c442e9667bd1507a3cf2d775a3a69f6c5b1adb22c2b14f449725a' => 
      array (
        'query' => 'UPDATE Centurion_activations SET userid = :userid , activation_code = :activation_code , redirect_to = :redirect_to , satisfied = :satisfied , lockid = :lockid , activationid = :activationid  WHERE activation_code = :activation_code0 ',
        'bind' => 
        array (
          'userid' => '1',
          'activation_code' => '4244dea1dc5c2fb51baf2be096fe669108a17344',
          'redirect_to' => 'dashboard',
          'satisfied' => '1',
          'lockid' => '2',
          'activationid' => '8',
          'activation_code0' => '4244dea1dc5c2fb51baf2be096fe669108a17344',
        ),
      ),
      'e08b96326e081b7bed9c442e9667bd15b898ac7f87d35f623842d19d8cdf0df474c27b43' => 
      array (
        'query' => 'UPDATE Centurion_activations SET userid = :userid , activation_code = :activation_code , redirect_to = :redirect_to , satisfied = :satisfied , lockid = :lockid , activationid = :activationid  WHERE activation_code = :activation_code0 ',
        'bind' => 
        array (
          'userid' => '1',
          'activation_code' => '4d83e3ea659170a38d2da4003cb3665adc4fc404',
          'redirect_to' => 'dashboard',
          'satisfied' => '1',
          'lockid' => '2',
          'activationid' => '9',
          'activation_code0' => '4d83e3ea659170a38d2da4003cb3665adc4fc404',
        ),
      ),
    ),
    'Centurion_accountNavigation' => 
    array (
      '6661a098dafb4f3a46ee1bbdb3ee6778cc6d82139749d6b8c0ee33b883c96316ab2eb002' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Dashboard',
          'page_link0' => 'customer/dashboard',
          'page_icon0' => 'nav-icon fas fa-tachometer-alt',
          'accountid0' => '1',
        ),
      ),
      '6661a098dafb4f3a46ee1bbdb3ee6778cf0155c28bceb8b4627bc722b89aeddb0a358bd9' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Booking',
          'page_link0' => 'customer/booking',
          'page_icon0' => 'nav-icon fas fa-book',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abd8a8e0f1191d40309f748c696f456abd4cd48e9c2' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'History',
          'page_link0' => 'customer/booking/history',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '2',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abddfd1427122f1c57a40d602098ba675bddd625434' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Create',
          'page_link0' => 'customer/booking/create',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '2',
          'accountid0' => '1',
        ),
      ),
      '6661a098dafb4f3a46ee1bbdb3ee67789c87bf15771abcd97225e19df113f3f0a04cd203' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Rental',
          'page_link0' => 'customer/rental',
          'page_icon0' => 'nav-icon fas fa-book',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abd2bfbe8ebc466d4b874d961cce6540a10cdaf0450' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'History',
          'page_link0' => 'customer/rental/history',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '5',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abd7ea556346026f2c253b681f99e65d951853f9923' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Create',
          'page_link0' => 'customer/rental/create',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '5',
          'accountid0' => '1',
        ),
      ),
      '6661a098dafb4f3a46ee1bbdb3ee6778c76519f21b4769c7f4d73213d048ec1e6d72a911' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Profile',
          'page_link0' => 'dashboard/profile',
          'page_icon0' => 'nav-icon fas fa-user',
          'accountid0' => '1',
        ),
      ),
      '6661a098dafb4f3a46ee1bbdb3ee677897a2d0bf91ae46725be22174133472979ecbed07' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Support',
          'page_link0' => 'customer/support',
          'page_icon0' => 'nav-icon far fa-envelope',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abd8b78d8cbbf91665e05cb4872ce13b24fe4882ef3' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Testimonial',
          'page_link0' => 'customer/support/testimonial',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '9',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abd33552fd897e159613ecb6a9646c318ac36250eab' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Ticket',
          'page_link0' => 'customer/support/ticket',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '9',
          'accountid0' => '1',
        ),
      ),
      '6661a098dafb4f3a46ee1bbdb3ee677811ba3131ea696603ef92cf9acec979e4a57c3abd' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Reports',
          'page_link0' => 'customer/report',
          'page_icon0' => 'nav-icon fas fa-table',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abdfff19b97fe56eac1ff375cba4e6a1e633bb6ffd3' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Orders',
          'page_link0' => 'customer/report/orders',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '12',
          'accountid0' => '1',
        ),
      ),
      'ef501048c7bc586ae8effa6732731abdb7c68f0d6fc51f29733a6360e8be55ae3947e1dd' => 
      array (
        'query' => 'INSERT INTO Centurion_accountNavigation (page_title,page_link,page_icon,parentid,accountid) VALUES (:page_title0,:page_link0,:page_icon0,:parentid0,:accountid0)',
        'bind' => 
        array (
          'page_title0' => 'Checking History',
          'page_link0' => 'customer/report/checking-history',
          'page_icon0' => 'far fa-circle nav-icon',
          'parentid0' => '12',
          'accountid0' => '1',
        ),
      ),
    ),
    'Centurion_users_information' => 
    array (
      '1f7b58c3c62b3f50487152d1e25f9ced3656467fad5bcdb23656aa7bedc9d9e18969515a' => 
      array (
        'query' => 'INSERT INTO Centurion_users_information (userid,next_of_kin_name,next_of_kin_telephone,next_of_kin_address,next_of_kin_relationship,telephone,home_address,work_address) VALUES (:userid0,:next_of_kin_name0,:next_of_kin_telephone0,:next_of_kin_address0,:next_of_kin_relationship0,:telephone0,:home_address0,:work_address0)',
        'bind' => 
        array (
          'userid0' => '1',
          'next_of_kin_name0' => 'ifeoma',
          'next_of_kin_telephone0' => '08092727228',
          'next_of_kin_address0' => '10 kaslat avenue kebe',
          'next_of_kin_relationship0' => 'sister',
          'telephone0' => '08029925179',
          'home_address0' => '10 kaslat avenue kebe',
          'work_address0' => '10 kaslat avenue kebe',
        ),
      ),
      '20dbcdccfc781667936b8bf4a0a2b4c11814eb694313c2a3b192749cefc444c4f17c1361' => 
      array (
        'query' => 'UPDATE Centurion_users_information SET home_address = :home_address , work_address = :work_address  WHERE informationid = :informationid ',
        'bind' => 
        array (
          'home_address' => '10 kaslat avenue kebe',
          'work_address' => '10 kaslat avenue kebe',
          'informationid' => '1',
        ),
      ),
      '20dbcdccfc781667936b8bf4a0a2b4c18dbc6d699f8e0535c0bf1d1d064dc495e419df79' => 
      array (
        'query' => 'UPDATE Centurion_users_information SET home_address = :home_address , work_address = :work_address  WHERE informationid = :informationid ',
        'bind' => 
        array (
          'home_address' => '10 kaslat avenue kebe 2',
          'work_address' => '10 kaslat avenue kebe',
          'informationid' => '1',
        ),
      ),
    ),
    'Centurion_users' => 
    array (
      '477e38b5e9b1a0bdaa3211945fa98309c21c323143f2cafeba9b5a622486c67b32f9182e' => 
      array (
        'query' => 'UPDATE Centurion_users SET firstname = :firstname , lastname = :lastname , userid = :userid  WHERE userid = :userid0 ',
        'bind' => 
        array (
          'firstname' => 'ifeanyi',
          'lastname' => 'amadi',
          'userid' => '1',
          'userid0' => '1',
        ),
      ),
    ),
  ),
);

?>