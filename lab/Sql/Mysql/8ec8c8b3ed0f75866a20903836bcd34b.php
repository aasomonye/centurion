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
  ),
);

?>