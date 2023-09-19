<!-- create.blade.php -->
@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            font-size: 24px;
            margin: 20px 0;
        }

        main {
            margin: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: #0069d9;
        }

        .editor-toolbar {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .editor-toolbar button,
        .editor-toolbar select {
            padding: 8px 10px;
            background-color: #f1f1f1;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .editor-toolbar select {
            width: 120px;
        }

        .editor-toolbar button.active {
            background-color: #007bff;
            color: #fff;
        }

        .editor {
            border: 1px solid #ccc;
            border-radius: 5px;
            min-height: 200px;
            padding: 10px;
            background-color: #fff;
            display:fix;
        }

        .editor #blog-content[contenteditable="true"]:empty:not(:focus):before {
            content: attr(placeholder);
            color: #888;
        }

        .editor #blog-content[contenteditable="true"]:focus {
            outline: none;
            border-color: #007bff;
        }


        /* Custom Styles for Toolbar Buttons */
        .editor-toolbar button {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .editor-toolbar button:hover {
            background-color: #ebebeb;
        }

        .editor-toolbar select {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Custom Styles for Dropdown Arrow */
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 5'%3E%3Cpath fill='%23007bff' d='M4 5l4-4H0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 8px 5px;
            padding-right: 20px;
        }

        /* Custom Styles for Placeholder Text */
        .editor #blog-content[contenteditable="true"]:empty:before {
            color: #888;
            content: attr(placeholder);
            pointer-events: none;
            display: block;
            padding: 10px;
        }


        .upload-container {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            width:100%
        }

        .upload-section {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .upload-section label {
            padding: 8px 12px;
            background-color: green;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-section input[type="file"] {
            display: none;
        }

        .upload-section span {
            margin-left: 10px;
            color: #777;
        }


        /* Custom Styles for File Preview */
        .file-preview {
        display: flex;
        align-items: center;
        margin-top: 10px;
        }

        .file-preview img,
        .file-preview video {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 10px;
        }

        .file-preview video {
        outline: none;
        }

        .file-preview .close-icon {
        font-size: 18px;
        color: #ff3333;
        cursor: pointer;
        }
    </style>
</head>
<body>

    <main>
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 800px; margin: 0 auto;">
            @csrf
            <input type="text" name="title" placeholder="Enter blog title">
            @error('title')
            <div class="error-message" style="color:red">{{ $message }}</div>
            @enderror

           

            <div class="form-group" >
                <h1><strong>Blog Content</strong></h1>
                <div class="editor-toolbar" >
                <button type="button" onclick="execCmd('bold')" onmousedown="toggleButton(this)" id="bold-button"><strong>B</strong></button>
                <button type="button" onclick="execCmd('italic')" onmousedown="toggleButton(this)" id="italic-button"><em>I</em></button>
                <button type="button" onclick="execCmd('underline')" onmousedown="toggleButton(this)" id="underline-button"><u>U</u></button>
                <select onchange="execCmd('fontSize', this.value)" onclick="toggleButton(this)" id="font-size-select">
                    <option value="">Font Size</option>
                    <option value="1">10</option>
                    <option value="2">20</option>
                    <option value="3">30</option>
                    <option value="4">40</option>
                    <option value="5">50</option>
                    <option value="6">60</option>
                </select>
            </div>
                <div id="blog-content" contenteditable="true"  class="form-control" style="min-height: 200px; min-width:200px; max-width:800px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;"></div>
                <textarea name="content" id="blog-content-input" style="display: none;" ></textarea>
            </div>
            @error('content')
            <div class="error-message" style="color:red">{{ $message }}</div>
            @enderror

            <br>
            <div class="upload-container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                <div class="upload-section">
                    <label for="BlogVideos">Blog Videos</label>
                    <input type="file" id="BlogVideos" name="BlogVideos[]" multiple>
                </div>
                <div id="videoPreviewContainer" class="preview-container"></div>
            @error('BlogVideos.*')
            <div class="error-message" style="color:red">{{ $message }}</div>
            @enderror
            </div>

            <br>
            <!-- Blog Images -->
            <div class="upload-container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
            <div class="upload-section">
                <label for="BlogImages">Job Images</label>
                <input type="file" id="BlogImages" name="BlogImages[]" multiple>
            </div>
            <div id="imagePreviewContainer" class="preview-container"></div>
            @error('BlogImages.*')
            <div class="error-message" style="color:red">{{ $message }}</div>
            @enderror
            </div>
            <br>
            <!-- Interface Image -->
            <div class="upload-container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                <div class="upload-section">
                    <input type="file" name="image" accept="image/*" id="image-input">
                    <label for="image-input">Choose Interface Image</label>
                    <span id="upload-message"></span>
                </div>
                @error('image')
                <div class="error-message" style="color:red">{{ $message }}</div>
                @enderror
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <br>
            <button type="submit">Publish</button>
        </form>
    </main>

    <!-- Add your JavaScript scripts here if needed -->

    <script>
  // Image preview
  document.getElementById('BlogImages').addEventListener('change', function(e) {
    var imagePreviewContainer = document.getElementById('imagePreviewContainer');
    imagePreviewContainer.innerHTML = ''; // Clear previous previews

    var files = Array.from(e.target.files);
    files.forEach(function(file) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var imagePreview = document.createElement('img');
        imagePreview.src = e.target.result;
        imagePreview.style.maxWidth = '200px';
        imagePreviewContainer.appendChild(imagePreview);
      };
      reader.readAsDataURL(file);
    });
  });

  // Video preview
  document.getElementById('BlogVideos').addEventListener('change', function(e) {
    var videoPreviewContainer = document.getElementById('videoPreviewContainer');
    videoPreviewContainer.innerHTML = ''; // Clear previous previews

    var files = Array.from(e.target.files);
    files.forEach(function(file) {
      var reader = new FileReader();
      reader.onload = function(e) {
        var videoPreview = document.createElement('video');
        videoPreview.src = e.target.result;
        videoPreview.style.maxWidth = '300px';
        videoPreview.controls = true;
        videoPreviewContainer.appendChild(videoPreview);
      };
      reader.readAsDataURL(file);
    });
  });
</script>

    <script>
        function execCmd(command, argument = null) {
            document.execCommand(command, false, argument);
            updateToolbarButtons();
        }

        function toggleButton(button) {
            button.classList.toggle("active");
        }

        function updateToolbarButtons() {
            var boldButton = document.getElementById("bold-button");
            var italicButton = document.getElementById("italic-button");
            var underlineButton = document.getElementById("underline-button");
            var fontSizeSelect = document.getElementById("font-size-select");

            boldButton.classList.toggle("active", document.queryCommandState("bold"));
            italicButton.classList.toggle("active", document.queryCommandState("italic"));
            underlineButton.classList.toggle("active", document.queryCommandState("underline"));

            var fontSize = document.queryCommandValue("fontSize");
            fontSizeSelect.value = fontSize;
        }

        document.addEventListener("DOMContentLoaded", function() {
            var blogContent = document.getElementById("blog-content");
            var blogContentInput = document.getElementById("blog-content-input");

            blogContent.addEventListener("input", function() {
                blogContentInput.value = blogContent.innerHTML;
            });

            blogContent.addEventListener("mouseup", function() {
                updateToolbarButtons();
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var uploadInput = document.getElementById("image-input");
            var uploadMessage = document.getElementById("upload-message");

            uploadInput.addEventListener("change", function() {
                var filename = uploadInput.value.split("\\").pop();
                uploadMessage.textContent = "uploaded：" + filename;

                
            });
        });

        
    </script>
        </body>
</html>
@endsection