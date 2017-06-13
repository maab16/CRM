<?php

namespace App\Models;

use Blab\Mvc\Models\Blab_Model;
use Blab\Libs\Input;
use Blab\Libs\Session;
use Blab\Libs\Redirect;

class Product extends Blab_Model
{
	public function getAllCompany(){
		return $this->_db->query()
				->from('companies',['id','company_name'])
				->results();
	}

	public function getAvailabilities(){
		return $this->_db->query()
				->from('availabilities',['code','title'])
				->results();
	}

	public function createProduct($source){
		
		$input = new Input();
								
		$validation = $input->check($source,array(
			'code'=>array(
					'required'=>true,
					'unique'=>'products'
					),
			'company'=>array(
					'required'=>true,
					),
			'status'=>array(
					'required'=>true,
					),						
		));
		if ($validation->passed()) {


			try{

				$product_image_name = $_FILES['product_image']['name'];
				$image_tmp = $_FILES['product_image']['tmp_name'];
				move_uploaded_file($image_tmp,'assets/images/products/'.$product_image_name);

				$insertProduct = $this->_db->query()
							->into('products')
							->insert(array(
								'code'=>input::get('code'),
								'title'=>input::get('title'),
								'company'=>input::get('company'),
								'price'=>input::get('price'),
								'currency'=>input::get('currency'),
								'product_image'=>$product_image_name,
								'status'=>input::get('status'),
								'created_at'=>date("Y-m-d"),
								'updated_at'=>date("Y-m-d")
							));
									
				Session::setFlash('Your registration Successfully.');
				Redirect::to('/products/');
										
			} catch (Exception $e) {

				die($e->getMessage());
										
			}

		}else{

			return $validation->errors();
		}
	}

	public function getAllProduct($limit,$page){
		return $this->_db->query()
				->from('products',[
					'products.id'=>'id',
					'products.code'=>'code',
					'products.title'=>'title',
					'products.price'=>'price',
					'products.currency'=>'currency',
					'products.product_image'=>'product_image',
					'companies.company_name'=>'company',
					'availabilities.title' => 'status'
				])
				->join('INNER','companies','companies.id=products.company')
                ->join('INNER','availabilities','availabilities.code=products.status')
                ->limit($limit,$page)
                ->order(array('id'=>'DESC'))
                ->results();
	}

	public function getCartList($user_id){

		return $this->_db->query()
				->from('user_products',['product_id'])
				->where(array('user_id'=>$user_id))
				->results();
	}

	public function getSingleProduct($id){
		return $this->_db->query()
				->from('products')
				->where(array('id'=>$id))
				->firstResult();
	}

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

	public function updateProduct($source){

		$input = new Input();
								
		$validation = $input->check($source,array(
			'code'=>array(
					'required'=>true,
					'unique'=>'products'
					),							
		));

		if ($validation->passed()) {

			$id = input::get('id');

			$product_image = $_FILES['product_image']['name'];
			$image_tmp = $_FILES['product_image']['tmp_name'];
			move_uploaded_file($image_tmp,'assets/images/products/'.$product_image);

			try{

				$updateProduct = $this->_db->query()
						->into("products")
						->where(array('id'=> $id))
						->update([
								'code'=>input::get('code'),
								'title'=>input::get('title'),
								'company'=>input::get('company'),
								'price'=>input::get('price'),
								'currency'=>input::get('currency'),
								'product_image'=>$product_image,
								'status'=>input::get('status'),
								'updated_at'=>date("Y-m-d")
							]
						);
				if ($updateProduct) {
					Session::setFlash('Your registration Successfully.');
					Redirect::to("/products/");
										
				}
			} catch (Exception $e) {

				die($e->getMessage());
										
			}

		}else{

			return $validation->errors();
		}
	
	}

	public function deleteProduct($id){

		$deleteProduct = $this->_db->query()
					->from('products')
					->where(array('id'=>$id),'=')
					->delete();

		if ($deleteProduct) {
			
			echo "<script>alert('Product Deleted Successfully.')</script>";
			Redirect::to('/products/');
		}

	}

	public function count($tableName,$where=array()){

		return $this->_db->query()
				->from($tableName)
				->where($where)
	            ->countRows();
	}
}