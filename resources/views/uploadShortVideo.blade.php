@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>视频上传</title>
    <style>
         body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
        }

        form div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="file"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Video</h1>
        
        <!-- 上传表单 -->
        <form action="{{route('video.upload')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="video">Choose your video:  <span style="color:red">*</span></label>
              
                <input type="file" id="video" name="video">
             
            </div>
          
            <div>
                <label for="interface">Choose your interface image: <span style="color:red">*</span></label>
                <input type="file" id="interface" name="interface">
            </div>
            <div>
                <label for="description">Description: <span style="color:red">*</span></label>
                <input type="text" id="description" name="description">
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>

    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
    
    <!-- 引入自定义的JavaScript文件 -->
</body>
</html>

@endsection
