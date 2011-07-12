Introduction
============

Clone the codebase and checkout/switch to the yii branch

This should result in the following high-level directory structure

	frameworks/
		blog/	
		yii-1.1.7/
		README.md
		
Setup your Web server such that the blog/ directory is the webroot

Create a new MySQL DB named "blog"

Create the db structure in this new db based on blog/protected/data/schema.mysql.sql

Alter the blog/protected/config/main.php file to specify your proper db settings:

	'db'=>array(
		'connectionString' => 'mysql:host=127.0.0.1;dbname=blog',
		'emulatePrepare' => true,
		'username' => '[YOUR-DB-USERNAME-HERE]',
		'password' => '[YOUR-DB-PASSWORD-HERE]',
		'charset' => 'utf8',
		'tablePrefix' => 'tbl_',
		'enableProfiling'=>true,
		'enableParamLogging' => true,
	),


