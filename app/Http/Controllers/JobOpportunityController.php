<?php

namespace App\Http\Controllers;


Use \Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use Google\Cloud\Firestore\FieldValue;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class JobOpportunityController extends Controller
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
        $serviceAccount = ServiceAccount::fromJsonFile($path);
        $factory = (new Factory)->withServiceAccount($serviceAccount);
        $storage = $factory->createStorage();
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
        $job_opportunityData = [];
        $job_opportunityRef = $this->data->collection('job_opportunity');
        $snapshot = $job_opportunityRef->documents();
        
        foreach ($snapshot as $job_opportunity) {
            $eachjob_opportunity = [];

            $title = isset($job_opportunity->data()['title']) ? $job_opportunity->data()['title'] : '';
            $description = isset($job_opportunity->data()['description']) ? $job_opportunity->data()['description'] : '';
            $created_at = isset($job_opportunity->data()['created_at']) ? $job_opportunity->data()['created_at'] : '';
            $updated_at = isset($job_opportunity->data()['updated_at']) ? $job_opportunity->data()['updated_at'] : '';
            $id = isset($job_opportunity->data()['id']) ? $job_opportunity->data()['id'] : '';
            
             
            $eachjob_opportunity = array( "title"=>$title,
                                "uid"=>$job_opportunity->id(), 
                                "description"=>$description,
                                "created_at"=>$created_at,
                                "updated_at"=>$updated_at,
                                "id"=>$id,
                            );
            array_push($job_opportunityData, $eachjob_opportunity);
        }
        $arr['job_opportunity'] = $job_opportunityData;
        
        return view('job.job_home' )->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
