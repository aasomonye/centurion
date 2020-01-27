<?php

return array (
  'centurion-app' => 
  array (
    'Zema_directives' => 
    array (
      'cf1fc9b87989f50bc71c545f3712155ae3258a9696a2ec2789fcec32f7e1741be052ed9c' => 
      array (
        'query' => 'INSERT INTO Zema_directives (directive,directive_class,directive_method) VALUES (:directive0,:directive_class0,:directive_method0), (:directive1,:directive_class1,:directive_method1), (:directive2,:directive_class2,:directive_method2)',
        'bind' => 
        array (
          'directive0' => 'image',
          'directive_class0' => 'CmsGlobalCms',
          'directive_method0' => 'loadImages',
          'directive1' => 'breacum-title',
          'directive_class1' => 'CmsGlobalCms',
          'directive_method1' => 'loadBreadcumTitle',
          'directive2' => 'goto',
          'directive_class2' => 'CmsGlobalCms',
          'directive_method2' => 'gotoDirective',
        ),
      ),
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
    'Zema_navigationtypes' => 
    array (
      '06813ccd3efc2619a30fb2bbc56a3de3327f58fedbae9bc47d9b56256f0dc9b46bff54b3' => 
      array (
        'query' => 'INSERT INTO Zema_navigationtypes (navigationtype) VALUES (:navigationtype0), (:navigationtype1)',
        'bind' => 
        array (
          'navigationtype0' => 'public',
          'navigationtype1' => 'admin',
        ),
      ),
    ),
    'Zema_permission' => 
    array (
      'd1d2ca2aac5fc08fe6bf2b42b5bc16e87a68f97f8fdf8546cd8fc423b99b954cab00d3c9' => 
      array (
        'query' => 'INSERT INTO Zema_permission (permission,permission_group) VALUES (:permission0,:permission_group0)',
        'bind' => 
        array (
          'permission0' => 'Basic Moderator',
          'permission_group0' => 'view',
        ),
      ),
      'd1d2ca2aac5fc08fe6bf2b42b5bc16e8a0d36f8e9ecdb76192a1986e975512e464098a02' => 
      array (
        'query' => 'INSERT INTO Zema_permission (permission,permission_group) VALUES (:permission0,:permission_group0)',
        'bind' => 
        array (
          'permission0' => 'Moderator',
          'permission_group0' => 'view,edit,update,upload',
        ),
      ),
      'd1d2ca2aac5fc08fe6bf2b42b5bc16e82de80c6918059d1ef4b31a9725a8dd19ead16a0c' => 
      array (
        'query' => 'INSERT INTO Zema_permission (permission,permission_group) VALUES (:permission0,:permission_group0)',
        'bind' => 
        array (
          'permission0' => 'Administrator',
          'permission_group0' => 'view,edit,update,delete,upload',
        ),
      ),
      'd1d2ca2aac5fc08fe6bf2b42b5bc16e83a79c1608cd0cd2ba942e7830521ce85186c0c93' => 
      array (
        'query' => 'INSERT INTO Zema_permission (permission,permission_group) VALUES (:permission0,:permission_group0)',
        'bind' => 
        array (
          'permission0' => 'Super Adminstrator',
          'permission_group0' => 'view,edit,update,delete,upload,create,destroy',
        ),
      ),
    ),
    'Zema_users' => 
    array (
      'e846ceffb501d457345790656f1ea5f20f80aa43d5c1d6b650f609d43ffda4c1d2ffbb7d' => 
      array (
        'query' => 'INSERT INTO Zema_users (username,password,fullname,permissionid,siteid) VALUES (:username0,:password0,:fullname0,:permissionid0,:siteid0)',
        'bind' => 
        array (
          'username0' => 'admin',
          'password0' => '$2y$10$PPDxeGy86YABJB22IQ1LkuWh6YdUa7ql4A70biNc6L5tKHcCVdz7.',
          'fullname0' => 'John Duo',
          'permissionid0' => '4',
          'siteid0' => 'Centurion',
        ),
      ),
      '248f71412349f00ac171168756aa9b57b2736a20199309de0ff36addfb721879bf51b18a' => 
      array (
        'query' => 'UPDATE Zema_users SET loggedinToken = :loggedinToken  WHERE userid = :userid ',
        'bind' => 
        array (
          'loggedinToken' => 'a3dcfad6107ea9fd1df8e02586b90993',
          'userid' => '1',
        ),
      ),
      'a82b8119e783c563ef3ecd05d6a87bee464e5ddd71af1b9d3cd3de742fdc697630d9a0f3' => 
      array (
        'query' => 'UPDATE Zema_users SET username = :username , fullname = :fullname , password = :password , permissionid = :permissionid  WHERE userid=:userid ',
        'bind' => 
        array (
          'username' => 'admin',
          'fullname' => 'Amadi ifeanyi',
          'password' => '$2y$10$9h7FJgvc1jZC3YajXtJJuuSMEkB3JxK7sNhulgzUFDG77BQBTrJku',
          'permissionid' => '4',
          'userid' => '1',
        ),
      ),
      '248f71412349f00ac171168756aa9b5756a608ecfea1d55f5283fcbaadf555b053499296' => 
      array (
        'query' => 'UPDATE Zema_users SET loggedinToken = :loggedinToken  WHERE userid = :userid ',
        'bind' => 
        array (
          'loggedinToken' => '2771020491c9db5fbf754f6291c59f39',
          'userid' => '1',
        ),
      ),
      '248f71412349f00ac171168756aa9b571bd0a6d15fa1223cbe8c5d38537d9049399a64d2' => 
      array (
        'query' => 'UPDATE Zema_users SET loggedinToken = :loggedinToken  WHERE userid = :userid ',
        'bind' => 
        array (
          'loggedinToken' => 'b6241a8c60406f8c395dd7371b66c314',
          'userid' => '1',
        ),
      ),
    ),
    'Zema_containers' => 
    array (
      'caaa57d18bdee9f4ddb1a3337cc32bf3b8acb2c25ed0ad3ff4833cd4a7d31963723a60ed' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'our-address',
          'container_body0' => 'No 30, Wuse Zone 4, Abuja Ciry, Nigeria',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf3087f8bdb5be3411acbcdf448f88038310c0530a3' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'our-phone',
          'container_body0' => '+2348024745595',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf32ed8ae2be8e56d355e0791a53d17dbf82476ce05' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'our-email',
          'container_body0' => 'booking@centurionhotel.com',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf3914cc8312edd19dbca32668bf654231aaa5fa21a' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'introductory-text',
          'container_body0' => 'Centurion Apartments is tastefully furnished with a modern interior and comfortable bedrooms, located at the hearth of Abuja City, Nigeria, it about 25 minutes drive from the international Airport and 4 minutes drive from the Internal Conference Centre.',
          'siteid0' => 'Centurion',
        ),
      ),
      'caaa57d18bdee9f4ddb1a3337cc32bf36776fa674edbbb05abd8c24bc1f0756ab8aafff8' => 
      array (
        'query' => 'INSERT INTO Zema_containers (container_name,container_body,siteid) VALUES (:container_name0,:container_body0,:siteid0)',
        'bind' => 
        array (
          'container_name0' => 'platform',
          'container_body0' => 'Centurion Apartments',
          'siteid0' => 'Centurion',
        ),
      ),
    ),
    'Zema_images' => 
    array (
      '9aea5e176467cc4c7dee6f23ad82e93259a88369199304066bfbb809466e8aa9ccc4876b' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/5dadb98f9286ae7902395c4d73cee36aOE9UOO0.jpg',
          'image_name0' => 'slide1-bg',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e932aff95177b946e47b1af3a9ceb7a125a1a86c5bf6' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/d585c3448b63483976403179af9391443804.jpg',
          'image_name0' => 'slide2-bg',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e932a0a56e411ebeb9b1095ce7d94c0975e63a9fe26d' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/3f300023b4831cc89c4ffad089585ad28972.jpg',
          'image_name0' => 'slide3-bg',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e9323f268d0fd44eee452082a3ae465cddc6b829e3e8' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/624100c8051e1f09d18c9bfaf45af94cLagos-Lagoon_View-Hotels.ng_.jpg',
          'image_name0' => 'lagos-thumb',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e9321c215ab4812290f6282f567556a775f8370ee7aa' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/44c772b3a161dfe3a39f004dac2000c1abuja-view.jpg',
          'image_name0' => 'abuja-thumb',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e9320441163c07921fa4b26490860978b58b78975e06' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/c379715379085843424ad404bee6c078owerri-center.jpg',
          'image_name0' => 'owerri-thumb',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e9324bb18c05513e456e1dba640c0854465981910421' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/2a74fc4597ef0795abf196ffb298d364Kajuru-Castle.-Photo-findingae.jpg',
          'image_name0' => 'kaduna-thumb',
          'siteid0' => 'Centurion',
        ),
      ),
      '9aea5e176467cc4c7dee6f23ad82e932c63ddd7875ce871bed569441868e4ee8fdb700d5' => 
      array (
        'query' => 'INSERT INTO Zema_images (image_path,image_name,siteid) VALUES (:image_path0,:image_name0,:siteid0)',
        'bind' => 
        array (
          'image_path0' => './lab/Cms/MVC/App/Uploads/1abd48b6e3954e27627f09f33700ce7bcalabar-hotel.jpg',
          'image_name0' => 'calabar-thumb',
          'siteid0' => 'Centurion',
        ),
      ),
      'a286f9b576f80783bc57ae12c5289bbc63b07e9f6499fa420aa96b7fecf83f8746f3cbfa' => 
      array (
        'query' => 'UPDATE Zema_images SET image_path = :image_path , image_name = :image_name  WHERE imageid=:imageid ',
        'bind' => 
        array (
          'image_path' => './lab/Cms/MVC/App/Uploads/d585c3448b63483976403179af9391443804.jpg',
          'image_name' => 'slide2-bg',
          'imageid' => '2',
        ),
      ),
    ),
  ),
);

?>