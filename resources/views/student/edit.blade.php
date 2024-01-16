@extends('student.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{route('student.index')}}">Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whhops!</strong>There is some problem with your input. <br><br>
    <ul>
        @foreach ($errors->all as $error)
           <li>{{$error}}</li>            
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('student.update',$student->id)}}" method="post" enctype="multipart/form-data">
    
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{$student->name}}" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <strong>Standard:</strong>
            <select name="std" id="std" class="form-control">
                
                @foreach ($standard as $data)
                <option value="{{$data->id}}" {{$student->std==$data->id ? 'selected': '' }}>
                    {{$data->standard}}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control" placeholder="Image" >
                <img src="{{ asset('image/student/'.$student->image) }}" width="70px" height="70px" alt="Image">
                {{-- <img src="/image/student/{{$student->image}}" > --}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"> 
                <strong>Maths:</strong>
                <input type="number" name="maths" id="maths" class="form-control" value="{{$student->maths}}">
               
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Science:</strong>
                <input type="number" name="science" id="science" class="form-control" value="{{$student->science}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>History:</strong>
                <input type="number" name="history" id="history" class="form-control" value="{{$student->history}}" >
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>English:</strong>
                <input type="number" name="english" id="english" class="form-control" value="{{$student->english}}">
                
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </div>
</form>
@endsection