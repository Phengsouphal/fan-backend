<?php

namespace App\Http\Controllers;

Use \Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FieldValue;


class ClassController extends Controller
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
        $classData = [];
        $classRef = $this->data->collection('class');
        $snapshot = $classRef->documents();
        
        foreach ($snapshot as $class) {
            $eachClass = [];

            $classname = isset($class->data()['class_name']) ? $class->data()['class_name'] : '';
            $description = isset($class->data()['description']) ? $class->data()['description'] : '';
            $created_at = isset($class->data()['created_at']) ? $class->data()['created_at'] : '';
            $updated_at = isset($class->data()['updated_at']) ? $class->data()['updated_at'] : '';
            $id = isset($class->data()['id']) ? $class->data()['id'] : '';
            $session = isset($class->data()['session_name']) ? $class->data()['session_name'] : '';
            $category = isset($class->data()['category_name']) ? $class->data()['category_name'] : '';
            $level = isset($class->data()['level_name']) ? $class->data()['level_name'] : '';
            
            $eachClass = array( "classname"=>$classname,
                                "uid"=>$class->id(), 
                                "description"=>$description,
                                "created_at"=>$created_at,
                                "updated_at"=>$updated_at,
                                "id"=>$id,
                                "session"=> $session,
                                "category"=>$category,
                                "level"=>$level, 
                                // "date_of_birth"=>$date_of_birth, 
                                // "address"=>$address
                            );
            array_push($classData, $eachClass);
        }
        $arr['classes'] = $classData; 
        return view('class.class_home' )->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levelData = [];
        $levelRef = $this->data->collection('levels');
        $levelSnapshot = $levelRef->documents();
        foreach ($levelSnapshot as $level) {
            $eacjLevel = [];
            $eacjLevel = array( "level_name"=>$level->data()['level_name'], "id"=>$level->id() );
            array_push($levelData, $eacjLevel);
        }
        $arrLevels['levels'] = $levelData;

        $sessionData = [];
        $sessionRef = $this->data->collection('session');
        $sessionSnapshot = $sessionRef->documents();
        foreach ($sessionSnapshot as $session) {
            $eachSession = [];
            $eachSession = array( "session_name"=>$session->data()['session_name'], "id"=>$session->id() );
            array_push($sessionData, $eachSession);
        }
        $arrSession['sessions'] = $sessionData;

        $catData = [];
        $catRef = $this->data->collection('categories');
        $catSnapshot = $catRef->documents();
        foreach ($catSnapshot as $cat) {
            $eachCat = [];
            $eachCat = array( "category_name"=>$cat->data()['category_name'], "id"=>$cat->id() );
            array_push($catData, $eachCat);
        }
        $arrCat['categories'] = $catData;
        return view('class.create_class')->with($arrSession)->with($arrLevels)->with($arrCat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classReference = $this->data->collection('class');
        $classSnapshot = $classReference->documents();
        $id = 0;
        foreach ($classSnapshot as $class) {
            if ($class->data()['id'] > $id) {
                $id = $class->data()['id'];
            }
        }

        $levelReference = $this->data->collection('levels')->document($request->level);
        $levelSnapshot = $levelReference->snapshot();
        $level_name = isset($levelSnapshot->data()['level_name']) ? $levelSnapshot->data()['level_name'] : '';
         
        $catReference = $this->data->collection('categories')->document($request->category);
        $catSnapshot = $catReference->snapshot();
        $category_name = isset($catSnapshot->data()['category_name']) ? $catSnapshot->data()['category_name'] : '';
         
        $sessionReference = $this->data->collection('session')->document($request->session);
        $sessionSnapshot = $sessionReference->snapshot();
        $session_name = isset($sessionSnapshot->data()['session_name']) ? $sessionSnapshot->data()['session_name'] : '';

        $dataFireStore = [
            'class_name' => $request->name,
            'description' => $request->description,
            'level_id' => $request->level,
            'level_name' => $level_name,
            'category_id' => $request->category,
            'category_name' => $category_name,
            'session_id' => $request->session,
            'session_name' => $session_name,
            'created_at' => Carbon::now()->toDateTimeString(),
            'id' => $id + 1
        ];
       
        $classReference->add($dataFireStore);
        return redirect('class');
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
