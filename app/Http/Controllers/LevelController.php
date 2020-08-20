<?php

namespace App\Http\Controllers;

Use \Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FieldValue;

class LevelController extends Controller
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
        $levelData = [];
        $levelRef = $this->data->collection('levels');
        $snapshot = $levelRef->documents();
        
        foreach ($snapshot as $level) {
            $eachLevel = [];

            $level_name = isset($level->data()['level_name']) ? $level->data()['level_name'] : '';
            $description = isset($level->data()['description']) ? $level->data()['description'] : '';
            $created_at = isset($level->data()['created_at']) ? $level->data()['created_at'] : '';
            $updated_at = isset($level->data()['updated_at']) ? $level->data()['updated_at'] : '';
            $id = isset($level->data()['id']) ? $level->data()['id'] : '';
            
             
            $eachLevel = array( "level_name"=>$level_name,
                                "uid"=>$level->id(), 
                                "description"=>$description,
                                "created_at"=>$created_at,
                                "updated_at"=>$updated_at,
                                "id"=>$id,
                            );
            array_push($levelData, $eachLevel);
        }
        $arr['levels'] = $levelData;
        $user = 'user';
        return view('level.level_home', compact('user'))->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('level.create_level');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $levelReference = $this->data->collection('levels');
        $levelSnapshot = $levelReference->documents();
        $id = 0;
        foreach ($levelSnapshot as $level) {
            if ($level->data()['id'] > $id) {
                $id = $level->data()['id'];
            }
        }
        $dataFireStore = [
            'level_name' => $request->level_name,
            'description' => $request->description,
            'created_at' => Carbon::now()->toDateTimeString(),
            'id' => $id + 1
        ];
       
        $levelReference->add($dataFireStore);
        return redirect('level');
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
