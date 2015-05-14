Laravel-Login-Article CRUD-Connect with Facebook
================================================
||            Author : Noni Wiluyo            ||
================================================

Welcome!
Berikut merupakan langkah pengaturan website ini
1. Setting database pada file /app/config/database.php
2. Buat sebuah facebook app 
3. Setting facebook apps pada file /app/config/facebook.php

	<?php
		//app/config/facebook.php
		// Facebook app Config
		return array(
			'appId' => 'FB_APP',
			'secret' => 'FB_SECRET'
		);

4. Setting facebook php sdk dengan perintah 'composer require facebook/php-sdk' pada cmd
5. Buat database dengan perintah 'php artisan migrate'
6. website siap dijalankan.
=======
