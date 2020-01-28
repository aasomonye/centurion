<?php

return array (
  'centurion-app' => 
  array (
    'Zema_images' => 
    array (
      'a286f9b576f80783bc57ae12c5289bbc11745379a5db06ea529c5981c25216881dfe436f' => 
      array (
        'query' => 'UPDATE Zema_images SET image_path = :image_path , image_name = :image_name  WHERE imageid=:imageid ',
        'bind' => 
        array (
          'image_path' => './lab/Cms/MVC/App/Uploads/5dadb98f9286ae7902395c4d73cee36a3804.jpg',
          'image_name' => 'slide1-bg',
          'imageid' => '1',
        ),
      ),
      'a286f9b576f80783bc57ae12c5289bbc11693228f380f73a1beca47e87efdc50aa20228e' => 
      array (
        'query' => 'UPDATE Zema_images SET image_path = :image_path , image_name = :image_name  WHERE imageid=:imageid ',
        'bind' => 
        array (
          'image_path' => './lab/Cms/MVC/App/Uploads/d585c3448b63483976403179af9391448972.jpg',
          'image_name' => 'slide2-bg',
          'imageid' => '2',
        ),
      ),
      'a286f9b576f80783bc57ae12c5289bbcb541a7ebd304de3e12cfc9e31a1abe3d6155459d' => 
      array (
        'query' => 'UPDATE Zema_images SET image_path = :image_path , image_name = :image_name  WHERE imageid=:imageid ',
        'bind' => 
        array (
          'image_path' => './lab/Cms/MVC/App/Uploads/3f300023b4831cc89c4ffad089585ad2OE9UOO0.jpg',
          'image_name' => 'slide3-bg',
          'imageid' => '3',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e932fbcdfa5fccf56273884fb1803764d4e1bed4ab02' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/24011eccd02d490bafe27eea2b7a699f5051.jpg',
          'image_name0' => 'slide4-bg',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e9320e820f4cce6e6fa070a2777ebc352bed98672ed6' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/a0652874a7294982ef670617bf8c7f401587.jpg',
          'image_name0' => 'slide5-bg',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e93226d91eb3af46255e80de52a9f51c9cdf4317cf30' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/1cb43d9b901e6c83061fb3ca1f0319682449320.jpg',
          'image_name0' => 'slide6-bg',
          'siteid0' => 'Centurion',
        ),
      ),
    ),
    'Zema_users' => 
    array (
      '248f71412349f00ac171168756aa9b57707092dcefda2e13ed3077a336f25eade93aa290' => 
      array (
        'query' => 'UPDATE Zema_users SET loggedinToken = :loggedinToken  WHERE userid = :userid ',
        'bind' => 
        array (
          'loggedinToken' => 'e4e53978ea53c9b21fb862ba520d26e6',
          'userid' => '1',
        ),
      ),
    ),
    'Zema_containers' => 
    array (
      'caaa57d18bdee9f4ddb1a3337cc32bf3bc7a226649d2ebdf3ced3b5246e8458d0e116cac' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'footer-text',
          'container_body0' => 'Centurion Apartments is tastefully furnished with a modern interior and comfortable bedrooms, located at the hearth of Abuja City, Nigeria, it about 25 minutes drive from the international Airport and 4 minutes drive from the Internal Conference Centre.',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf3d14bed7b734f86fa6244db1b09593d39ebd1006f' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'subscribe-text',
          'container_body0' => 'Save up to 50% off your next booking',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf39b4f82f55033efa8358a14c764063c7cba48952f' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'hero-text',
          'container_body0' => 'Book and manage your trips on the go. Be notified of our hot deals and offers.',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf393d7fc68314a7075d8f4da536b235760c9304f81' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'theme-hero-one',
          'container_body0' => '{$static = pagepath(&#039;Static&#039;);}

<div class="theme-hero-area">
	<div class="theme-hero-area-bg-wrap">
	  <div class="theme-hero-area-bg-pattern theme-hero-area-bg-pattern-ultra-light" style="background-image:url(img/patterns/travel/2.png);"></div>
	  <div class="theme-hero-area-grad-mask"></div>
	  <div class="theme-hero-area-inner-shadow theme-hero-area-inner-shadow-light"></div>
	</div>
	<div class="theme-hero-area-body">
	  <div class="container">
		<div class="theme-page-section _p-0">
		  <div class="row">
			<div class="col-md-10 col-md-offset-1">
			  <div class="theme-mobile-app">
				<div class="row">
				  <div class="col-md-6">
					<div class="theme-mobile-app-section">
					  <img class="theme-mobile-app-img" src="{$static->find(&#039;phone-1.png&#039;)}" alt="Image Alternative text" title="Image Title"/>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="theme-mobile-app-section">
					  <div class="theme-mobile-app-body">
						<div class="theme-mobile-app-header">
						  <h2 class="theme-mobile-app-title">Download our app</h2>
						  <p class="theme-mobile-app-subtitle">@container(&#039;hero-text&#039;);</p>
						</div>
						<ul class="theme-mobile-app-btn-list">
						  <li>
							<a class="btn btn-dark theme-mobile-app-btn" href="#">
							  <i class="theme-mobile-app-logo">
								<img src="{$static->find(&#039;apple.png&#039;)}" alt="Image Alternative text" title="Image Title"/>
							  </i>
							  <span>Download on
								<br/>
								<span>App Store</span>
							  </span>
							</a>
						  </li>
						  <li>
							<a class="btn btn-dark theme-mobile-app-btn" href="#">
							  <i class="theme-mobile-app-logo">
								<img src="{$static->find(&#039;play-market.png&#039;)}" alt="Image Alternative text" title="Image Title"/>
							  </i>
							  <span>Download on
								<br/>
								<span>Play Market</span>
							  </span>
							</a>
						  </li>
						</ul>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf31be0c0c1c5aa9ce281e903e53d9f24209a4e58a1' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'theme-hero-two',
          'container_body0' => '{$static = pagepath(\'Static\');}

<div class="theme-hero-area">
	<div class="theme-hero-area-bg-wrap">
		{$bgImage = $static->find(\'-p4e59r092q_1500x800.jpeg\');}
	  <div class="theme-hero-area-bg" style="background-image:url({$bgImage});"></div>
	  <div class="theme-hero-area-mask theme-hero-area-mask-half"></div>
	</div>
	<div class="theme-hero-area-body">
	  <div class="container">
		<div class="theme-page-section _p-0">
		  <div class="row">
			<div class="col-md-10 col-md-offset-1">
			  <div class="theme-mobile-app">
				<div class="row">
				  <div class="col-md-6">
					<div class="theme-mobile-app-section"></div>
				  </div>
				  <div class="col-md-6">
					<div class="theme-mobile-app-section">
					  <div class="theme-mobile-app-body">
						<div class="theme-mobile-app-header">
						  <h2 class="theme-mobile-app-title">Download our app</h2>
						  <p class="theme-mobile-app-subtitle">@container(\'hero-text\');</p>
						</div>
						<ul class="theme-mobile-app-btn-list">
						  <li>
							<a class="btn btn-dark theme-mobile-app-btn" href="#">
							  <i class="theme-mobile-app-logo">
								<img src="{$static->find(\'apple.png\')}" alt="Image Alternative text" title="Image Title"/>
							  </i>
							  <span>Download on
								<br/>
								<span>App Store</span>
							  </span>
							</a>
						  </li>
						  <li>
							<a class="btn btn-dark theme-mobile-app-btn" href="#">
							  <i class="theme-mobile-app-logo">
								<img src="{$static->find(\'play-market.png\')}" alt="Image Alternative text" title="Image Title"/>
							  </i>
							  <span>Download on
								<br/>
								<span>Play Market</span>
							  </span>
							</a>
						  </li>
						</ul>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf3298812ed04ac541b9de53a525dd5d7c2cdb1feff' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'why-pay-more',
          'container_body0' => 'Subscribe now and unlock our secret deals. Save up to 70% by getting access to our special offers for hotels, flights, cars, vacation rentals and travel experiences.',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf3d79f1332288e9b0aaee1ab07cb767fa8f95cfcc5' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => '',
          'container_body0' => '',
          'siteid0' => 'Centurion',
        ),
      ),
    ),
    'Zema_directives' => 
    array (
      '50bfb5d6654e91a8390b713122d3afb9d70b1c05b6d1a5fd6ffc8cc9d6b7bcfcfefd0d9d' => 
      array (
        'query' => 'INSERT INTO Zema_directives (directive,directive_class,directive_method,siteid) VALUES (:directive0,:directive_class0,:directive_method0,:siteid0)',
        'bind' => 
        array (
          'directive0' => 'getImage',
          'directive_class0' => 'CmsGlobalCms',
          'directive_method0' => 'loadImages',
          'siteid0' => 'Centurion',
        ),
      ),
    ),
  ),
);

?>