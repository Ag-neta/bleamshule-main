<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Repositories\UserRepo;
use App\Repositories\StudentRepo;
use App\Charts\UserChart;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $user, $student;
    
    public function __construct(UserRepo $user, StudentRepo $student)
    {
        $this->user = $user;
       $this->student=$student;
    }


    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function privacy_policy()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.privacy_policy', $data);
    }

    public function terms_of_use()
    {
        $data['app_name'] = config('app.name');
        $data['app_url'] = config('app.url');
        $data['contact_phone'] = Qs::getSetting('phone');
        return view('pages.other.terms_of_use', $data);
    }

    public function dashboard()
    {
        $gender =$this->user->getPTAUsers()->pluck('id', 'gender');
        
        $chart = new UserChart;	
        $chart->labels($gender->keys());
        $chart->dataset('Gender', 'doughnut', $gender->values())
           ->BackgroundColor('grey') ;
       
        //$enrollment=$this->student->getAll()->pluck('id', 'year_admitted');
       	
        //$charts->labels($enrollment->keys());
        //$charts->dataset('Enrollment Chart', 'line', $enrollment->values());

        $d=[];
        if(Qs::userIsTeamSAT()){
            $d['users'] = $this->user->getAll();
        }

        return view('pages.support_team.dashboard', $d, compact('chart'));
    }
}
