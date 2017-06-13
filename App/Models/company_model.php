<?php

namespace App\Models;

use Blab\Mvc\Models\Blab_Model;
use Blab\Libs\Input;
use Blab\Libs\Session;
use Blab\Libs\Redirect;

class Company extends Blab_Model
{
	public function getAllCompany($limit,$page){

		return $this->_db->query()
				->from('companies')
				->limit($limit,$page)
                ->order(array('id'=>'DESC'))
				->results();
	}

	public function getSinglCompany($id){
		return $this->_db->query()
				->from('companies')
				->where(array('id'=>$id))
				->firstResult();
	}

	public function createCompany($source){

		$input = new Input();
								
		$validation = $input->check($source,array(
			'company_name'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'email'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'vat_no'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'reg_no'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'phone'=>array(
					'required'=>true,
					'unique'=>'companies'
					),							
		));

		if ($validation->passed()) {

			$company_image = $_FILES['company_image']['name'];
			$image_tmp = $_FILES['company_image']['tmp_name'];
			move_uploaded_file($image_tmp,'assets/images/companies/'.$company_image);

			try{

				$updateCompany = $this->_db->query()
						->into("companies")
						->insert([
								'company_name'=>input::get('company_name'),
								'email'=>input::get('email'),
								'company_image'=>$company_image,
								'address'=>input::get('address'),
								'vat_no'=>input::get('vat_no'),
								'reg_no'=>input::get('reg_no'),								
								'phone'=>input::get('phone'),
								'website'=>input::get('website'),
								'created_at'=>date("Y-m-d"),
								'updated_at'=>date("Y-m-d"),
							]
						);
				if ($updateCompany) {
					Session::setFlash('Company Created Successfully.');
					Redirect::to("/companies/");
										
				}
			} catch (Exception $e) {

				die($e->getMessage());
										
			}

		}else{

			return $validation->errors();
		}
	
	}

	public function updateCompany($source){

		$input = new Input();
								
		$validation = $input->check($source,array(
			'company_name'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'email'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'vat_no'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'reg_no'=>array(
					'required'=>true,
					'unique'=>'companies'
					),
			'phone'=>array(
					'required'=>true,
					'unique'=>'companies'
					),							
		));

		if ($validation->passed()) {

			$id = input::get('id');

			$company_image = $_FILES['company_image']['name'];
			$image_tmp = $_FILES['company_image']['tmp_name'];
			move_uploaded_file($image_tmp,'assets/images/companies/'.$company_image);

			try{

				$updateCompany = $this->_db->query()
						->into("companies")
						->where(array('id'=> $id))
						->update([
								'company_name'=>input::get('company_name'),
								'email'=>input::get('email'),
								'company_image'=>$company_image,
								'address'=>input::get('address'),
								'vat_no'=>input::get('vat_no'),
								'reg_no'=>input::get('reg_no'),								
								'phone'=>input::get('phone'),
								'website'=>input::get('website'),
								'updated_at'=>date("Y-m-d")
							]
						);
				if ($updateCompany) {
					Session::setFlash('Your registration Successfully.');
					Redirect::to("/companies/");
										
				}
			} catch (Exception $e) {

				die($e->getMessage());
										
			}

		}else{

			return $validation->errors();
		}
	
	}

	public function deleteCompany($id){

		$existsCompany = $this->_db->query()
						->from('products')
						->where(array('company'=>$id))
						->delete();

		$deleteCompany = $this->_db->query()
					->from('companies')
					->where(array('id'=>$id),'=')
					->delete();

		if ($existsCompany && $deleteCompany) {
			
			echo "<script>alert('Company Deleted Successfully.')</script>";
			Redirect::to('/companies/');
		}
	}

	public function count(){

		return $this->_db->query()
				->from('companies')
	            ->countRows();
	}
}