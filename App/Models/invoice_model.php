<?php
namespace App\Models;

use Blab\Mvc\Models\Blab_Model;
use Blab\Libs\Input;
use Blab\Libs\Redirect;

class Invoice extends Blab_Model
{

	public function getProductByID($id,$user_id){
		$results =  $this->_db->query()
					->from('user_products',[
						'user_products.id'=>'invoice_id',
						'user_products.qty'=>'qty',
						'user_products.created_at'=>'issued_date',
						'users.email'=>'email',
						'products.title'=>'product_title',
						'products.price'=>'price',
						'companies.company_name'=>'company',
						'companies.address'=>'company_address',
						'companies.vat_no'=>'company_vat',
						'companies.reg_no'=>'company_reg',
					])
					->where(array('product_id'=>$id))
					->andWhere(array('user_id'=>$user_id))
					->join('INNER','users','user_products.user_id=users.id')
					->join('INNER','products','user_products.product_id=products.id')
					->join('INNER','companies','products.company=companies.id')
					->firstResult();
		$profiles = $this->_db->query()
					->from('profiles',[
						'profiles.fname'=>'first_name',
						'profiles.lname'=>'last_name',
						'profiles.address'=>'user_address'
					])
					->where(array('user_id'=>$user_id))
					->firstResult();

		return (object)array_merge((array)$results,(array)$profiles);
	}

	public function getSingleCart($id,$user_id){
		return $this->_db->query()
				->from('user_products',[
					'user_products.user_id'=>'user',
					'user_products.qty'=>'qty',
					'products.id'=>'id',
					'products.code'=>'code',
					'products.product_image'=>'product_image',
					'products.currency'=>'currency',
					'products.price'=>'price',
					'companies.company_name'=>'company'
				])
				->where(array('product_id'=>$id))
				->where(array('user_id'=>$user_id))
				->join('INNER','products','user_products.product_id=products.id')
				->join('INNER','companies','products.company=companies.id')
				->results();
	}

	public function deleteCart($id,$user_id){

		$deleteCart = $this->_db->query()
					->from('user_products')
					->where(array('product_id'=>$id),'=')
					->where(array('user_id'=>$user_id))
					->delete();

		if ($deleteCart) {
			Redirect::to('/dashboard/');
		}
	}
}