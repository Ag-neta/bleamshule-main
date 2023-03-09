<?php

namespace App\Http\Controllers\SupportTeam;

use App\Models\sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Qs;
use App\Repositories\UserRepo;
use App\User;
use Response;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::select('users.*')
            ->where('user_type', 'student')
            ->orderBy('name', 'ASC')
            ->get();

        

        return view('pages.support_team.sms.index',['students'=>$students]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $teachers = User::select('users.*')
            ->where('user_type', 'teacher')
            ->orderBy('name', 'ASC')
            ->get();

        

        return view('pages.support_team.sms.teachers',['teachers'=>$teachers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $msg = $request->input('msg');
      $phone_number = $request->input('recipients');
      $userid = "bleaminc";
      $pass = "P15_Mai_2016";
      $authkey = '293e03960e3f08c51a5407ea01222128ddb7162e';
      $senderId = 'ZTSMS';
      $route = 2;
      $postData = $request->all();
      $Number= implode('',$postData['recipients']);
      
      $arr = str_split($Number, '12');
      $mobiles = implode(",", $arr);
      
    
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://portal.zettatel.com/SMSApi/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"userid=".$userid."&password=".$pass."&&sendMethod=quick&mobile=".$mobiles."&msg=".$msg."&ZTSMS&msgType=text&duplicatecheck=true&output=text",
        CURLOPT_HTTPHEADER => array(
          "apikey: 293e03960e3f08c51a5407ea01222128ddb7162e",
          "cache-control: no-cache",
          "content-type: application/x-www-form-urlencoded"
        ),
        ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }

      return redirect('sms')->with('flash_success', __('message sent successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function show(sms $sms)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(sms $sms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sms $sms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(sms $sms)
    {
        //
    }
}
