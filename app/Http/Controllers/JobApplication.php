<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSeeker;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Technical;

class JobApplication extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs =  JobSeeker::orderBy('jobSeekerId','desc')->get();
        return view('jobseeker.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobseeker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
      
        // return $techData;
        return redirect()->back()->with('success','Job Application Form submitted Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $job =  JobSeeker::find($id);
       return view('jobseeker.show',compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job =  JobSeeker::find($id);

        return view('jobseeker.edit',compact('job'));
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
        $this->validation($request,$id);
  
        return redirect()->back()->with('success','Job Application Form Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        JobSeeker::find($id)->delete($id);
        Education::where('jobSeekerId',$id)->delete();
        Experience::where('jobSeekerId',$id)->delete();
        Language::where('jobSeekerId',$id)->delete();
        Technical::where('jobSeekerId',$id)->delete();
         return redirect()->back()->with('success','Job Application Form Deleted Successfully');

    }

    public function validation($request,$jobSeekerId =null){
          $data =   $request->validate([
            'name'      => 'required|string|min:3|max:180',
            'email'     => 'required|min:2|email',
            'contact'   => 'required|min:10|max:10',
            'address'   => 'required|string',
            'gender'    => 'required|not_in:""',
            'city_id'   => 'required|not_in:""',
            'current_ctc'=> 'required',
            'expected_ctc'=> 'required',
            'notice_period'=> 'required'
        ]);

        if($jobSeekerId != null ){
            JobSeeker::find($jobSeekerId)->update($data);
            Education::where('jobSeekerId',$jobSeekerId)->delete();
            Experience::where('jobSeekerId',$jobSeekerId)->delete();
            Language::where('jobSeekerId',$jobSeekerId)->delete();
            Technical::where('jobSeekerId',$jobSeekerId)->delete();

        }else{
            $jobSeekerId = JobSeeker::create($data)->jobSeekerId;
        }

        

        $eduNames = $request->eduName;
        foreach ($eduNames as $key => $eduName) {
            $eduData = [
                'jobSeekerId'   => $jobSeekerId,
                'educName'      => $eduName,
                'board'         => $request->board[$key],
                'year'          => $request->year[$key],
                'percent'       => $request->percent[$key]
            ];

            Education::create($eduData);
        }




        $companies = $request->company;

        foreach ($companies as $ckey => $company) {
            $expData = [
                'jobSeekerId'   => $jobSeekerId,
                'company'       => $company,
                'designation'   => $request->designation[$ckey],
                'from'          => $request->from[$ckey],
                'to'            => $request->to[$ckey]
            ];
            Experience::create($expData);
        }

        $languages = isset($request->langName) ? $request->langName : [];


        foreach ($languages as $lkey => $language) {
            $answers  = isset($request->$language) ? $request->$language : [];
            foreach ($answers as $akey => $answer) {
                $langData = [
                    'jobSeekerId' =>$jobSeekerId,
                    'langName' => $language,
                    'answer' =>  $answer
                ];
                Language::create($langData);
            }

        } 
        $techNames = isset($request->techName) ? $request->techName : [];

        foreach ($techNames as $lkey => $techName) {
            $tanswer  = isset($request->$techName) ? $request->$techName : '';
            $techData = [
                'jobSeekerId'   =>$jobSeekerId,
                'techName' => $techName,
                'answer' =>  $tanswer
            ];
            if($tanswer !=''){
                Technical::create($techData);
            }
            
        }
    }
}
