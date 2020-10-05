<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use App\Models\Discount;
use App\Form\DiscountForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscountController extends BaseController {
	protected $_baseUrl = 'discount';
	protected $_title = 'Discount';
	protected $_model = Discount::class;

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
						'name'=>'amount_min',
						'title'=>'Min',
						'visible'=>true,
					],
					[
						'name'=>'amount_max',
						'title'=>'Max',
						'visible'=>true,
					],
					[
						'name'=>'probability',
						'title'=>'Probability',
						'visible'=>true,
					],
					[
						'name'=>'discount',
						'title'=>'Discount',
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
			'action_buttons'=>[
				[
					'icon'=>'plus-circle',
					'class'=>'btn-primary',
					'title'=>'Add New',
					'url'=>url($this->_baseUrl.'/create'),
					'type'=>'link',
				],
			],
		];
	}

	protected function setForm() {
		return DiscountForm::class;
	}

	public function createAction(Request $request) {
		$min = $request->input('amount_min');
		$max = $request->input('amount_max');
		if ($min > $max) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>'Min value could not be bigger than Max value',
				],
				'redirect'=>false,
			]);
		}
		$data = [
			'amount_max'=>$max,
			'amount_min'=>$min,
			'probability'=>$request->input('probability'),
			'discount'=>$request->input('discount'),
		];
		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}

		$check = Discount::where(function($query) use ($min, $max){
			$query->where('amount_min','<=',$min)
				->where('amount_max','>=',$max);
		})->orWhere(function($query) use ($min, $max) {
			$query->where('amount_min','<=',$max)
			->where('amount_max','>=',$min);		
		})->first();

		if (!$check) {
			$data = [
				'amount_max'=>$max,
				'amount_min'=>$min,
				'probability'=>$request->input('probability'),
				'discount'=>$request->input('discount'),
			];
			if (Discount::create($data)) {
				$request->session()->flash('status', 'Update was successful!');
				return response()->json([
					'status'=>true,
					'data'=>$data,
					'errors'=>null,
					'redirect'=>[
						'page'=>$this->_baseUrl
					],
				]);
			}
		}

		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input / the value is overlaping',
			],
			'redirect'=>false,
		]);
	}
	public function updateAction(Request $request, $id) {
		// $data = $request->all()
		$min = $request->input('amount_min');
		$max = $request->input('amount_max');
		if ($min > $max) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>'Min value could not be bigger than Max value',
				],
				'redirect'=>false,
			]);
		}

		$data = [
				'amount_max'=>$max,
				'amount_min'=>$min,
				'probability'=>$request->input('probability'),
				'discount'=>$request->input('discount'),
			];

		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}

		$check = Discount::where(function($query) use ($min, $max){
			$query->where('amount_min','<=',$min)
				->where('amount_max','>=',$max);
		})->orWhere(function($query) use ($min, $max) {
			$query->where('amount_min','<=',$max)
			->where('amount_max','>=',$min);		
		})
		->where('id','<>',$id)
		->first();

		if ($check) {
			if (Discount::where('id',$id)->update($data)) {
				$request->session()->flash('status', 'Update was successful!');
				return response()->json([
					'status'=>true,
					'data'=>$data,
					'errors'=>null,
					'redirect'=>[
						'page'=>$this->_baseUrl
					],
				]);
			}
		}

		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input / the value is overlaping',
			],
			'redirect'=>false,
		]);
	}

	protected function validation() {
		return [
			'amount_min'=>'required|numeric',
			'amount_max'=>'required|numeric',
			'probability'=>'required|numeric',
			'discount'=>'required|numeric',
		];
	}
}