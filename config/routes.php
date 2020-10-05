<?php
$base = [
	'log'=>Logs\LogController::class,
	'user'=>Authentication\UserController::class,
	'transaction'=>Transaction\TransactionController::class,
	'customer'=>Masters\CustomerController::class,
	'discount'=>Masters\DiscountController::class,
];

foreach($base as $prefix=>$c) {
	Route::prefix($prefix)->group(function() use ($prefix, $c) {
		Route::get('/',['as'=>$prefix.'.index','uses'=>$c.'@index']);
		Route::get('create',['as'=>$prefix.'.create','uses'=>$c.'@create']);
		Route::post('create',['as'=>$prefix.'.create','uses'=>$c.'@createAction']);
		Route::get('update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@update']);
		Route::match(['post','put'],'update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@updateAction']);
	});
}