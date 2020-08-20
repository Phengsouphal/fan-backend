<?php

namespace App\Http\Controllers;


Use \Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FieldValue;

class StudentController extends Controller
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
        $query = $usersRef->where('role', '=', 'STUDENT');
        $snapshot = $query->documents();
        
        foreach ($snapshot as $user) {
            $eachUser = [];

            $username = isset($user->data()['username']) ? $user->data()['username'] : '';
            $password = isset($user->data()['password']) ? $user->data()['password'] : '';
            $created_at = isset($user->data()['created_at']) ? $user->data()['created_at'] : '';
            $updated_at = isset($user->data()['updated_at']) ? $user->data()['updated_at'] : '';
            $id = isset($user->data()['id']) ? $user->data()['id'] : '';
            $student_phone = isset($user->data()['student_phone']) ? $user->data()['student_phone'] : '';
            $parent_phone = isset($user->data()['parent_phone']) ? $user->data()['parent_phone'] : '';
            $status = isset($user->data()['status']) ? $user->data()['status'] : '';
            
            
            // $gender = isset($user->data()['gender']) ? $user->data()['gender'] : '';
            // $address = isset($user->data()['address']) ? $user->data()['address'] : '';
            // $date_of_birth = isset($user->data()['date_of_birth']) ? $user->data()['date_of_birth'] : '';
            // $type = isset($user->data()['type']) ? $user->data()['type'] : '';

            $eachUser = array(  "username"=>$username,
                                "uid"=>$user->id(), 
                                "password"=>$password,
                                "created_at"=>$created_at,
                                "updated_at"=>$updated_at,
                                "id"=>$id,
                                "student_phone"=>$student_phone,
                                "parent_phone"=>$parent_phone,
                                "status"=>$status == 'active' ? 'Active' : 'Inactive',
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
        return view('student.student_home', compact('user'))->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $classData = [];
        $classRef = $this->data->collection('class');
        $classSnapshot = $classRef->documents();
        foreach ($classSnapshot as $class) {
            $eachClass = [];
            $eachClass = array( "class_name"=>$class->data()['class_name'], "id"=>$class->id() );
            array_push($classData, $eachClass);
        }
        $arrProvice['classes'] = $classData;
         
        $arrStatus['status'] = ['Active', 'Inactive'];
        return view('student.create_student')->with($arrStatus)->with($arrProvice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classes = [];
        if($request->class != 'choose') {
            $classes = [$request->class];
        }
       
        $this->validate($request, [
            'username' => 'required|max:255',
            'password'  => 'required|max:10',
            'parent_phone'  => 'required|numeric',
        ]);
        $userReference = $this->data->collection('users');
        $query = $userReference->where('role', '=', 'STUDENT');
        $studentSnapshot = $query->documents();
        $id = 0;
        foreach ($studentSnapshot as $student) {
            if ($student->data()['id'] > $id) {
                $id = $student->data()['id'];
            }
        }
        $dataFireStore = [
            'username' => $request->username,
            'password' => $request->password,
            'status' => $request->status,
            'student_phone' => $request->student_phone,
            'parent_phone' => $request->parent_phone,
            'role' => "STUDENT",
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => '',
            'id' => $id + 1,
            'classes' => $classes
        ];
       
        $userReference->add($dataFireStore);
        return redirect('student');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
        $uid = $id;
        $collectionReference = $this->data->collection('users');
        $documentReference = $collectionReference->document($id);
        $snapshot = $documentReference->snapshot();
        $arr['user'] = $snapshot->data();

        $classData = [];
        $classRef = $this->data->collection('class');
        $classSnapshot = $classRef->documents();
        
        foreach ($classSnapshot as $class) {
            foreach ($snapshot->data()['classes'] as $class_id) {
                if($class_id == $class->id()) {
                    $eachClass = [];
                    $eachClass = array( "class_name"=>$class->data()['class_name'], 
                                        "class_id"=>$class->id(),
                                        "level_name"=>$class->data()['level_name'], 
                                        "level_id"=>$class->data()['level_id'],
                                        "created_at"=>$class->data()['created_at'], 
                                        "category_id"=>$class->data()['category_id'],
                                        "category_name"=>$class->data()['category_name'], 
                                        "session_id"=>$class->data()['session_id'],
                                        "session_name"=>$class->data()['session_name'], 
                                        "description"=>$class->data()['description'],
                                    );
                    array_push($classData, $eachClass);
                }
            }
        }
  
        return view('student.detail_student', compact('classData'), compact('uid'))->with($arr);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $id = str_replace(' ', '', $id);
            $userReference = $this->data->collection('users');
            $documentReference = $userReference->document($id);
            $snapshot = $documentReference->snapshot();
            $arr['user'] = $snapshot->data();

            // $levelData = [];
            // $levelRef = $this->data->collection('province');
            // $levelSnapshot = $levelRef->documents();
            // foreach ($levelSnapshot as $Level) {
            //     $eachLevel = [];
            //     $eachLevel = array( "name"=>$Level->data()['name'], "id"=>$Level->id() );
            //     array_push($levelData, $eachLevel);
            // }
            // $arrLevel['Levels'] = $levelData;
        $classData = [];
        $classRef = $this->data->collection('class');
        $classSnapshot = $classRef->documents();
        
        foreach ($classSnapshot as $class) {
            $statusClasses = true;
            foreach ($snapshot->data()['classes'] as $class_id) {
                if($class_id == $class->id()) {
                    $statusClasses = false;
                }
            }
            $eachClass = [];
            $eachClass = array( "class_name"=>$class->data()['class_name'], 
                                "class_id"=>$class->id(),
                                "level_name"=>$class->data()['level_name'], 
                                "level_id"=>$class->data()['level_id'],
                                "created_at"=>$class->data()['created_at'], 
                                "category_id"=>$class->data()['category_id'],
                                "category_name"=>$class->data()['category_name'], 
                                "session_id"=>$class->data()['session_id'],
                                "session_name"=>$class->data()['session_name'], 
                                "description"=>$class->data()['description'],
                            );
            if ($statusClasses) {
                array_push($classData, $eachClass);
            }
        }
            return view('student.edit_student', compact('id'), compact('classData'))->with($arr);
         
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
        
        
             
            $collectionReference = $this->data->collection('users')->document($id);
            $snapshot = $collectionReference->snapshot()->data();
          
            $classes = $snapshot['classes'];
            if($request->class != 'choose') {
                array_push($classes, $request->class);
            }

            $collectionReference->update([
                ['path' => 'username', 'value' => $request->username],
                ['path' => 'password', 'value' => $request->password],
                ['path' => 'student_phone', 'value' => $request->student_phone],
                ['path' => 'parent_phone', 'value' => $request->parent_phone],
                ['path' => 'status', 'value' => $request->status],
                ['path' => 'updated_at', 'value' => Carbon::now()->toDateTimeString()],
                ['path' => 'classes', 'value' => $classes],
                // ['path' => 'phone', 'value' => $request->phone],
                // ['path' => 'province_name', 'value' =>  $province_name]
            ]  );

            return redirect()->route('show.student', $id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collectionReference = $this->data->collection('users')->document($id);
        $collectionReference->delete();
        return redirect()->route('student');
    }
}
