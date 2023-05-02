<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\student_result;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function StudentRecord(Request $request)
    {
        $data = student::all();
        if (!empty($data)) {
            $record = '';
            foreach ($data as $result) {
                $image = url('image') . '/' . $result->student_photo;
                $record .= '<tr>
                            <td>' . $result->id . '</td>
                            <td>' . $result->student_name . '</td>
                            <td>' . $result->age . '</td>
                            <td>' . $result->date_of_birth . '</td>
                            <td>' . $result->address . '</td>
                            <td>' . $result->parent_mobile_no . '</td>
                            <td>' . $result->parent_email_id . '</td>
                            <td><img src="' . $image . '" width="25px" height="25px"></td>
                            <td>' . $result->student_year_group . '</td>
                            <td>' . $result->Record_added_by . '</td>
                            <td><button type="button" class="btn btn-primary edit" style="background-color:skyblue" id=' . $result->id . ' data-toggle="modal" data-target="#exampleModal">Edit</button></td>
                            <td><button type="button" class="btn btn-success delete" style="background-color:black"id=' . $result->id . ' >Delete</button></td>
                        </tr>';
            }
        } else {
            $record = '<div class="col-md-12 mt-5"><input type="hidden" id="checkfield" value="0">No Result Found!</div>';
        }
        return json_encode($record);
    }
    public function AddStudentRecord(Request $request)
    {
        $added_by = Auth::user()->name;
        $id = $request->id;
        $oldImageName = student::where('id', $id)->value('student_photo');
        $image = $request->file('image');
        if ($request->hasFile('image') && !empty($image)) {
            $imageName = time() . '.' . $image->getClientOriginalName();
            $request->image->move(public_path('image'), $imageName);
        } else {
            $imageName = $oldImageName;
        }

        $data = array(
            'student_name' => $request->name,
            'age' => $request->age,
            'date_of_birth' => $request->dob,
            'address' => $request->address,
            'parent_mobile_no' => $request->p_number,
            'parent_email_id' => $request->email,
            'student_photo' => $imageName,
            'student_year_group' => $request->year,
            'Record_added_by' => $added_by,
        );

        student::updateOrCreate(['id' => $id], $data);
        $data['success'] = true;
        return json_encode($data);
    }
    public function EditStudentRecord(Request $request)
    {
        $id = $request->id;
        $data = student::where('id', $id)->first();
        return json_encode($data);
    }
    public function DeleteStudentRecord(Request $request)
    {
        $id = $request->id;
        student::where('id', $id)->first()->delete();
        $data['success'] = true;
        return json_encode($data);
    }
    public function StudentResult()
    {
        $student_record = student::all();
        return view('create-student-result')->with('student', $student_record);
    }
    public function ViewStudentResult()
    {
        $student_record = student_result::with('student')->get();
        return view('student-result-view')->with('student', $student_record);
    }
    public function CreateStudentResult(Request $request)
    {
        $added_by = Auth::user()->name;
        $id=$request->id;
        $request->validate([
            'student' => 'required|integer',
            'math' => 'required|numeric',
            'science' => 'required|numeric',
            'english' => 'required|numeric',
            'gujarati' => 'required|numeric',
            'computer' => 'required|numeric',
            'year' => 'required|numeric',
            'obtained_mark' => 'required|numeric',
            'total_mark' => 'required|numeric',
            'percentage' => 'required',
            'percentile' => 'required',

        ]);
        $data = [
            'student_id' => $request->student,
            'maths' => $request->math,
            'science' => $request->science,
            'english' => $request->english,
            'gujarati' => $request->gujarati,
            'computer' => $request->computer,
            'exam_year' => $request->year,
            'obtained_marks' => $request->obtained_mark,
            'total_marks' => $request->total_mark,
            'percentage' => $request->percentage,
            'percentile' => $request->percentile,
            'record_added_by' => $added_by,
        ];
        student_result::updateOrCreate(['student_id' => $id], $data);
        return redirect()->back()->with('success', 'Data inserted successfully');
    }
    public function  GetStudentResult(Request $request){
        $id=$request->id;
        $student_record['student_record'] = student::all();
        $student_record['student_result'] = student_result::with('student')->where('student_id',$id)->first();
        return view('edit-student-result')->with('student', $student_record);
    }
    public function DelteStudentResult(Request $request){
        $id=$request->id;
        student_result::where('student_id', $id)->first()->delete();
        return redirect()->back()->with('success', 'Data Deleted    successfully');
    }

}
