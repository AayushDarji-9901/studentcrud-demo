@extends('student.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('student.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('student.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Standard:</strong>
                <select name="std" id="std" class="form-control">
                    
                    @foreach ($standard as $data)
                    <option value="{{$data->id}}">
                        {{$data->standard}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div><br><br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control" placeholder="Image" enctype="multipart/form-data">
            </div>
        </div>

        <div>
            <strong>Subject:</strong>
        <input type="checkbox" id="maths1" name="maths" value="Maths">
        <label for="maths"> Maths</label>
        <input type="checkbox" id="science1" name="science" value="Science">
        <label for="science">Science</label>
        <input type="checkbox" id="history1" name="history" value="History">
        <label for="history">History</label>
        <input type="checkbox" id="english1" name="english" value="English">
        <label for="english">English</label>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group"> 
                <strong>Maths:</strong>
                <input type="number" name="maths" id="maths" class="form-control" placeholder="Maths" disabled>
                <script>
                   document.getElementById('maths1').onchange = function() {
                   document.getElementById('maths').disabled = !this.checked;
                };
                </script>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Science:</strong>
                <input type="number" name="science" id="science" class="form-control" placeholder="Science" disabled>
                <script>
                    document.getElementById('science1').onchange=function(){
                        document.getElementById('science').disabled=!this.checked;
                    };
                </script>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>History:</strong>
                <input type="number" name="history" id="history" class="form-control" placeholder="History" disabled>
                <script>
                    document.getElementById('history1').onchange = function() {
                    document.getElementById('history').disabled = !this.checked;
                 };
                 </script>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>English:</strong>
                <input type="number" name="english" id="english" class="form-control" placeholder="English" disabled>
                <script>
                    document.getElementById('english1').onchange = function() {
                    document.getElementById('english').disabled = !this.checked;
                 };
                 </script>
            </div>
        </div>
        
        <div>
            <strong> Gender:</strong>
            <input type="radio" name="male" id="male" value="Male">
            <label for="male">Male</label>
            <input type="radio" name="female" id="female" value="Female">
            <label for="female">Female</label><br>
        </div>
         
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection