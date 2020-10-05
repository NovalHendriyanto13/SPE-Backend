<?php
namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\BaseController;
use App\Models\Transaction;
use App\Form\TransactionForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransactionController extends BaseController {

	protected $_baseUrl = 'transaction';
	protected $_title = 'Transaction';
	protected $_model = Transaction::class;

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
						'name'=>'trans_id',
						'title'=>'Trans ID',
						'visible'=>true,
					],
					[
						'name'=>'trans_datetime',
						'title'=>'Date',
						'visible'=>true,
					],
					[
						'name'=>'customer.customer_code',
						'title'=>'Customer Code',
						'visible'=>true,
					],
					[
						'name'=>'customer.name',
						'title'=>'Name',
						'visible'=>true,
					],
					[
						'name'=>'trans_amount',
						'title'=>'Amount',
						'visible'=>true,
					],
					[
						'name'=>'discount',
						'title'=>'Discount',
						'visible'=>true,
					],
					[
						'name'=>'paid_amount',
						'title'=>'Paid Amount',
						'visible'=>true,
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

	protected function setForm() {
		return TransactionForm::class;
	}
}