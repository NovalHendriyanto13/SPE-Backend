<?php
namespace App\Http\Controllers\Logs;

use App\Http\Controllers\BaseController;
use App\Models\Log;

class LogController extends BaseController {
	protected $_baseUrl = 'log';
	protected $_title = 'Log';
	protected $_model = Log::class;

	protected function indexData() {
		return [
			'table'=>[
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'endpoint',
						'title'=>'Endpoint',
						'visible'=>true,
					],
					[
						'name'=>'request',
						'title'=>'Request',
						'visible'=>true,
					],
					[
						'name'=>'response',
						'title'=>'Response',
						'visible'=>true,
					],
					[
						'name'=>'hit_date',
						'title'=>'Date',
						'visible'=>true,
					],
					[
						'name'=>'user.name',
						'title'=>'User',
						'visible'=>true,
					],
				],
				'bulks'=>[
					[
						'icon'=>'edit',
						'class'=>'button_primary',
						'title'=>'Active',
						'url'=>url($this->_baseUrl.'/active')
					],
				],
				'grid_actions'=>[
					[
						'icon'=>'edit',
						'class'=>'btn-primary',
						'title'=>'Update',
						'url'=>url($this->_baseUrl.'/update')
					],
				],
			],
		];
	}
}