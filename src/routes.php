<?php
Route::view('/vnpt-epay-demo', '/vnpt-epay-demo') -> name('vnpt-epay-portal');
Route::post('/process', 'TestVNPTEpaytController@process_VNPTEPay') -> name('demo-process-vnpt-epay');
Route::any('/result', 'TestVNPTEpaytController@getResult')-> name('demo-result-vnpt-epay');