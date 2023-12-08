<?php
/*
 * Database configurations
 *
 */
define ('DB_HOST',  '127.0.0.1');
define ('DB_NAME',  'project_ls');
define ('DB_USER',  'root');
define ('DB_PASS',  '');

//define ('DB_HOST',  'localhost');
//define ('DB_NAME',  'sns_dev');
//define ('DB_USER',  'root');
//define ('DB_PASS',  'root');

/*
 *  Root directory
 */

define('ROOT' , '/');

/*
 *  APACHE SOLR PORT (LUCENE)
 */

define('SOLR_PORT', 'http://127.0.0.1:8983');

//define('SOLR_PORT', 'http://192.168.1.13:8983');
define('SOLR_URL', 'http://127.0.0.1:8983/solr/sns/');