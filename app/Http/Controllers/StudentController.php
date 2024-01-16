<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\standard;


use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
        $students = Student::select("student.*","standard.standard as std")
        ->leftJoin("standard", "student.std", "=", "standard.id")->paginate(3);
        $standard=standard::all();  //Select * from standard
       // $students=student::latest()->paginate(5);

       $search=$request->post('name');
       $percentage=$request->post('percentage');
       $result=$request->post('result');


        return view('student.index',compact('standard','students','search','percentage','result'));
    }

    public function search(Request $request)
    {
        $students = Student::select("standard.standard as std","student.*")
        ->leftJoin("standard", "student.std", "=", "standard.id");
        $standard=standard::all();  //Select * from standard
       // $students=student::latest()->paginate(5);

       $search=$request->post('name');
       $percentage=$request->post('percentage');
       $result=$request->post('result');

       if($search!=''){
        $students->where('student.name','LIKE','%'.$search.'%');
       }
       if($percentage!=''){
        $students->where('student.percentage','>=',$percentage);
       }
       if($result!=''){
        $students->where('student.result','=',$result);
       }
       $students=$students->paginate(2);
     //  dd($res);
       return view('student.index',compact('students'))
          ->with('student',$students)
          ->with('search',$search)
          ->with('percentage',$percentage)
          ->with('result',$result);
  
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $standard=standard::all();
        $students = Student::select("student.*","standard.standard as std")
        ->leftJoin("standard", "student.std", "=", "standard.id");
        return view('student.create',compact('standard','students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'std' => '',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'maths' => 'integer|between:1,100',
            'science' => 'integer|between:1,100',
            'english' => 'integer|between:1,100',
            'history' => 'integer|between:1,100'
        ]);
      //  dd($request->all());
        //student::create($request->all());
       // dd($image);
        $student=new Student;

        $count = 0;
        if($request->maths > 0){
            $count++;
        }
        if($request->science > 0){
            $count++;
        }
        if($request->english > 0){
            $count++;
        }
        if($request->history > 0){
            $count++;
        }

        $student->name=$request->input('name');
        $student->std=$request->input('std');
        $student->maths=$request->input('maths');
        $student->science=$request->input('science');
        $student->english=$request->input('english');
        $student->history=$request->input('history');
        $student->total=$request->maths+$request->science+$request->english+$request->history;
        $student->percentage=($request->maths+$request->science+$request->english+$request->history)/$count;

        if($student->percentage>=35)
        {
            $student->result="Pass";
        }
        else{
            $student->result="Fail";
        }
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('image/student/', $filename);
            $student->image = $filename;
        }
        $student->save();
        return redirect()->route('student.index')->with('status','Student Image Added Successfully');
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
    public function edit(Student $student,$id)
    {
       // $student=student::all();
        $student=Student::find($id);
        $standard=Standard::all();
        return view('student.edit',compact('id','student','standard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Student $student, $id)
    {
        $request->validate([
            'name' => 'required',
            'std' => '',
            'image'=>'',
            'maths' => 'nullable|between:1,100',
            'science' => 'nullable|between:1,100',
            'english' => 'nullable|between:1,100',
            'history' => 'nullable|between:1,100'
        ]);
        //$standard=Standard::all();

        $count = 0;
        if($request->maths > 0){
            $count++;
        }
        if($request->science > 0){
            $count++;
        }
        if($request->english > 0){
            $count++;
        }
        if($request->history > 0){
            $count++;
        }

        $student=Student::find($id);
    //    // $input=$request->all();
        $percentage=($request->maths+$request->science+$request->english+$request->history)/$count;
        $total=$request->maths+$request->science+$request->english+$request->history;
        $update = [   
        'name' => $request->name,
        'std' => $request->std,
        'maths' => $request->maths,
        'science' => $request->science,
        'english' => $request->english,
        'history' => $request->history,
        'total' =>$total,
        'percentage' => $percentage,
        'result'=>  ($percentage>35 ? "Pass" : "Fail")
    ];

    $file = $request->file("image");

    if($request->hasfile("image"))
    {
      $file->move("image/student/",time().'.'.$file->getClientOriginalExtension());
      $update['image'] = time().'.'.$file->getClientOriginalExtension();
    }
    
    DB::table('student')->where('id', $id)->update($update);
   // $student->update();
    return redirect()->route('student.index')
                     ->with('student',$student)
                     ->with('success','Student has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student,$id)
    {
        $student=Student::find($id);
        $student->delete();

        return redirect()->route('student.index')
                         ->with('success','Student deleted successfully');
    }
}
