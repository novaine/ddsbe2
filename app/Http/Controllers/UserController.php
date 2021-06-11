<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
use App\Models\UserJob;
class UserController extends Controller
{
    use ApiResponser;

    private $request;

    public function _construct(Request $request){
        $this ->request = $request;
    }
    public function getUsers(){
        //$users = User::all();
        //return response()->json($users, 200);
        $users = DB::connection('mysql')
        ->select("Select * from tbluserinfo");

        //return response 
        return $this->successResponse($users);
    }
    public function index(){
            $users = User::all();
            return $this->successResponse($users);
    }
    public function add(Request $request){
        $rules = [
            'Username' => 'required|max:20',
            'Password' => 'required|max:20',
            'JobID' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        $userjob = UserJob::findOrFail($request->jobid);
        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($id){
        $user = User::where('UserID', $id)->first();
        if ($user){
            return $this->successResponse($user);
        }
        {
        return $this->ErrorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);
        }  
    }

    public function update(Request $request, $id){
        $rules = [
            'Username' => 'max:20',
            'Password' => 'max:20',
            'JobID' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        //$user = User::findOrFail($id);
        $user = User::where('UserID', $id)->first();
        $userjob = UserJob::findOrFail($request->jobid);

        if ($user){
        $user->fill($request->all());
        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', 
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();
        return $this->successResponse($user);
        }
}

    public function delete($id)
    {
        $user = User::where('UserID', $id)->first();
        if($user){
            $user->delete();
            return $this->successResponse($user);
        }
        {
            return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
        }
    }

    }

?>