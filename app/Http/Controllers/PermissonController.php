<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permisson;
use App\Project;
use App\Users;

class PermissonController extends Controller
{
    //
    public function getList(){
    	// Phan trang khi lay du lieu ra all() tren trang view de {{ $permisson->links() }}
    	$project = Project::select('id')->get();
    	$permisson = Permisson::groupBy('permisson_users_projects.user_id')->groupBy('permisson_users_projects.project_id')->whereIn('permisson_users_projects.project_id', $project)->get();
    	// die($permisson);
        return view('admin.permisson.list',['permisson'=>$permisson]);
    }

    public function getAdd(){
        $project = Project::all();
        $user = Users::all();
        return view('admin.permisson.add',['project'=>$project,'user'=>$user]);
    }

    public function postAdd(Request $request){
		$this->validate($request,
			[
				'username'=>'required',
				'projectname'=>'required'
			],
			[
				'username.required'=>'Please select username',
				'projectname.required'=>'Please select project name'
			]);

		// Check username and project name have exits?
		$temp = Permisson::where('user_id',$request->username)->where('project_id',$request->projectname)->get();

		if($temp->isEmpty()){

			$permisson = new Permisson;
			$permisson->user_id = $request->username;
			$permisson->project_id = $request->projectname;
			$permisson->save();

			return redirect('admin/permisson/list')->with('thongbao','You add success');
			
		}else{
			return redirect('admin/permisson/add')->with('error','permission_exits');
		}
	}

	public function getEdit($id){
		$permisson = Permisson::find($id);
		$project = Project::all();
		$user = Users::all();
		return view('admin/permisson/edit',['project'=>$project,'user'=>$user,'permisson'=>$permisson]);
	}

	public function postEdit(Request $request, $id){

		// Check username and project name have exits?
		$temp = Permisson::where('user_id',$request->username)->where('project_id',$request->projectname)->get();

		if($temp->isEmpty()){

			$permisson = Permisson::find($id);
			$permisson->user_id = $request->username;
			$permisson->project_id = $request->projectname;
			
			$permisson->save();

			return redirect('admin/permisson/list')->with('thongbao','You edit success');
			
		}else{
			return redirect('admin/permisson/edit/'.$id)->with('error','permission_exits');
		}
	}

	public function getDelete($id){
        $permisson = Permisson::find($id);
        $permisson->delete();

        return redirect('admin/permisson/list')->with('thongbao','You delete success');
    }
}
