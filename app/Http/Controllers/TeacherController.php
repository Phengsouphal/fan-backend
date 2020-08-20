<?php

namespace App\Http\Controllers;

Use \Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FieldValue;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

        $path = base_path('secret/firebase_key.json');
        $this->data = new FirestoreClient([  'keyFilePath' => $path ]);
        $this->host_name = 'www.google.com';
        $this->port_no  = '80';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userData = [];
        $usersRef = $this->data->collection('users');
        $query = $usersRef->where('role', '=', 'TEACHER');
        $snapshot = $query->documents();
        
        foreach ($snapshot as $user) {
            $eachUser = [];

            $username = isset($user->data()['username']) ? $user->data()['username'] : '';
            $password = isset($user->data()['password']) ? $user->data()['password'] : '';
            $create_at = isset($user->data()['created_at']) ? $user->data()['created_at'] : '';
            $id = isset($user->data()['id']) ? $user->data()['id'] : '';
            // $gender = isset($user->data()['gender']) ? $user->data()['gender'] : '';
            // $address = isset($user->data()['address']) ? $user->data()['address'] : '';
            // $date_of_birth = isset($user->data()['date_of_birth']) ? $user->data()['date_of_birth'] : '';
            // $type = isset($user->data()['type']) ? $user->data()['type'] : '';

            $eachUser = array(  "username"=>$username,
                                "uid"=>$user->id(), 
                                "password"=>$password,
                                "created_at"=>$create_at,
                                "id" => $id 
                                // "last_name"=> $last_name,
                                // "province_name"=>$province_name,
                                // "email"=>$email, 
                                // "gender"=> $gender ,
                                // "date_of_birth"=>$date_of_birth, 
                                // "address"=>$address
                            );
            array_push($userData, $eachUser);
        }
        $arr['users'] = $userData;
        $user = 'user';
        return view('teacher.teacher_home', compact('user'))->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create_teacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userReference = $this->data->collection('users');
        $query = $userReference->where('role', '=', 'TEACHER');
        $teahcerSnapshot = $query->documents();
        $id = 0;
        foreach ($teahcerSnapshot as $teahcer) {
            if ($teahcer->data()['id'] > $id) {
                $id = $teahcer->data()['id'];
            }
        }
        $dataFireStore = [
            'username' => $request->name,
            'password' => $request->password,
            'role' => "TEACHER",
            'created_at' => Carbon::now()->toDateTimeString(),
            'id' => $id + 1,
        ];
        $userReference->add($dataFireStore);
        return redirect('teacher');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
