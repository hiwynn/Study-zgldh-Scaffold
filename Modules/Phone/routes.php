<?php
$api->get('c:/program files/git/phone', '\Modules\Phone\Controllers\C:Controller@getProgramFilesGitPhone');

$api->post('phone/bundle', '\Modules\Phone\Controllers\PhoneController@bundle');
$api->resource('phone', '\Modules\Phone\Controllers\PhoneController');


