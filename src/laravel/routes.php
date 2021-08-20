<?php
Route::view('/vnpt-epay-demo', '/vnpt-epay-demo') -> name('vnpt-epay-portal');
Route::post('/demo-process-vnpt', 'Lamtd\VNPTEpay\\TestVNPTEpaytController@process_VNPTEPay') -> name('demo-process-vnpt-epay');
Route::any('/demo-result-vnpt', 'Lamtd\VNPTEpay\\TestVNPTEpaytController@getResult')-> name('demo-result-vnpt-epay');