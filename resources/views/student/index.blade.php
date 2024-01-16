@extends('student.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Student Form with CRUD</h2>
            
        </div><br>
        <div class="pull-right">
            <a class="btn btn-success" href="{{route('student.create')}}">Create New Student</a>
            <form action="{{route('student.search')}}" method="post">
                @csrf
                <div class="">
                <input type="text" name="name" class="form-control w-25" placeholder="Name" value="{{$search}}">
                <input type="number" name="percentage" class="form-control w-25" placeholder="Percentage greater than" value="{{$percentage}}">
                <select name="result" id="" class="form-control w-25">
                    <option value="" disabled selected>Select Result</option>
                    <option value="Pass" >
                        Pass
                    </option>
                    <option value="Fail">
                        Fail
                    </option>
                </select>
                <button class="btn btn-primary">Search</button>
                </div>
                
            </form>
        </div>

       
        
    </div>
</div><br>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Standard</th>
        <th>Image</th>
        <th>Maths</th>
        <th>English</th>
        <th>Science</th>
        <th>History</th>
        <th>Total</th>
        <th>Percentage</th>
        <th>Result</th>
        <th width="280px">Action</th>
    </tr>

    @foreach ($students as $student)
    <tr>
        <td>{{$student->id}}</td>
        <td>{{$student->name}}</td>
        <td>{{$student->std}}</td>
        <td> <img src="{{ asset('image/student/'.$student->image) }}"   width="70px" height="70px" alt="Image"></td>
        {{-- <td><img src="public/image/student/{{$student->image}}" alt="" srcset=""></td> --}}
        <td>{{$student->maths}}</td>
        <td>{{$student->english}}</td>
        <td>{{$student->science}}</td>
        <td>{{$student->history}}</td>
        <td>{{$student->total}}</td>
        <td>{{$student->percentage}}</td>
        <td>{{$student->result}}</td>
        <td>
            <form action="{{route('student.destroy',$student->id)}}" method="post" enctype="multipart/form-data">
                <a class="btn btn-primary" href="{{route('student.edit',$student->id)}}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{!! $students->links() !!}
@endsection