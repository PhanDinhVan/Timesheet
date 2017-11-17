<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    //
    public function getList(){
    	$customer = Customer::paginate(10);
    	return view('admin/customer/list',['customer'=>$customer]);
    }

    public function getAdd(){
    	return view('admin/customer/add');
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'required|min:2',
    			'email'=>'required|email|unique:customers,email',
    			'city'=>'required|min:2',
    			'country'=>'required|min:2'
    		],
    		[
    			'name.required'=>'Please enter customer name',
    			'name.min'=>'Customer name minimum 2 characters',
    			'email.required'=>'Please enter customer email',
    			'email.email'=>'Email malformed',
    			'email.unique'=>'Customer name is exits',
    			'city.required'=>'Please enter customer city',
    			'city.min'=>'Customer city minimum 2 characters',
    			'country.required'=>'Please enter customer country',
    			'country.min'=>'Country city minimum 2 characters'
    		]);

    	$customer = new Customer;
    	$customer->name = $request->name;
    	$customer->email = $request->email;
    	$customer->city = $request->city;
    	$customer->country = $request->country;
    	$customer -> save();

    	return redirect('admin/customer/add')->with('thongbao','You add success');
    }

    public function getEdit($id){
    	$customer = Customer::find($id);
    	return view('admin/customer/edit',['customer'=>$customer]);
    }

    public function postEdit(Request $request, $id){
		$this->validate($request,
		[
			'name'=>'required|min:2',
			'city'=>'required|min:2',
			'country'=>'required|min:2'
		],
		[
			'name.required'=>'Please enter customer name',
			'name.min'=>'Customer name minimum 2 characters',
			'city.required'=>'Please enter customer city',
			'city.min'=>'Customer city minimum 2 characters',
			'country.required'=>'Please enter customer country',
			'country.min'=>'Country city minimum 2 characters'
		]);

		$customer = Customer::find($id);
		$customer->name = $request->name;
		$customer->city = $request->city;
		$customer->country = $request->country;
		$customer->save();

		return redirect('admin/customer/edit/'.$id)->with('thongbao','You edit success');
    }

    public function getDelete($id){
        $user = Customer::find($id);
        $user->delete();

        return redirect('admin/customer/list')->with('thongbao','You delete success');
    }
}
