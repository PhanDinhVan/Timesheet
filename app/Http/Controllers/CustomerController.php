<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    //
    public function getList(){
    	$customer = Customer::get();
    	return view('admin/customer/list',['customer'=>$customer]);
    }

    public function getAdd(){
    	return view('admin/customer/add');
    }

    public function postAdd(Request $request){
    	
    	$customer = new Customer;
    	$customer->name = $request->name;
        $customer->contact = $request->contact;
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

		$customer = Customer::find($id);
		$customer->name = $request->name;
        $customer->contact = $request->contact;
        $customer->email = $request->email;
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
