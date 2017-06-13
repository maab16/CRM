<?php
namespace App\Models;

use Blab\Mvc\Models\Blab_Model;
use Blab\Libs\Input;
use Blab\Libs\Redirect;

class Dashboard extends BLAB_Model
{

	public function getProductByUser($user_id,$limit,$page){
		return $this->_db->query()
				->from('user_products',[
					'products.id'=>'product_id',
					'products.code'=>'product_code',
					'products.product_image'=>'product_image',
					'products.price'=>'price',
					'products.currency'=>'currency',
					'companies.company_name'=>'company_name',
					'user_products.qty'=>'qty',
					'user_products.created_at'=>'issued_date',
				])
				->where(array('user_id'=>$user_id))
				->join('INNER','products','user_products.product_id=products.id')
				->join('INNER','companies','products.company=companies.id')
				->limit($limit,$page)
                ->order(array('user_products.updated_at'=>'DESC'))
				->results();
	}

	public function getAllCarts($limit,$page){
		return $this->_db->query()
				->from('user_products',[
					'users.username'=>'username',
					'products.id'=>'product_id',
					'products.code'=>'product_code',
					'products.product_image'=>'product_image',
					'products.price'=>'price',
					'products.currency'=>'currency',
					'companies.company_name'=>'company_name',
					'user_products.qty'=>'qty',
					'user_products.created_at'=>'issued_date',
				])
				->join('INNER','users','user_products.user_id=users.id')
				->join('INNER','profiles','profiles.user_id=users.id')
				->join('INNER','products','user_products.product_id=products.id')
				->join('INNER','companies','products.company=companies.id')
				->limit($limit,$page)
                ->order(array('user_products.updated_at'=>'DESC'))
				->results();
	}

	public function deleteCart($id){

		$deleteCart = $this->_db->query()
					->from('user_products')
					->where(array('product_id'=>$id),'=')
					->delete();

		if ($deleteCart) {
			Redirect::to('/dashboard/carts/');
		}
	}

	public function count($tableName,$where=array()){

		return $this->_db->query()
				->from($tableName)
				->where($where)
	            ->countRows();
	}
}