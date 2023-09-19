@extends('layouts.app')

@section('content')

    <head>
        <style>
        body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

            .container {
        position: relative;
        }

        h1 {
        font-size: 24px;
        margin-bottom: 20px;
        }

        .apply-form {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        }

        .apply-form form {
        margin-top: 20px;
        }

        .apply-form label {
        display: block;
        margin-bottom: 10px;
        }

        .apply-form textarea,
        .apply-form input[type="email"],
        .apply-form input[type="file"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 3px;
        }

        .apply-form .form-group {
        margin-bottom: 20px;
        }

        .apply-now-button {
        display: block;
        padding: 10px 20px;
        background-color:LightGray;
        border: 1px solid #ddd;
        border-radius: 3px;
        text-decoration: none;
        color: #333;
        margin-top: 20px;
        }

        .close-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        padding-right: 10px;
       
        }

        .close-icon a {
        display: inline-block;
        padding: 5px;
        background-color: LightGray;
        border: 1px solid #ddd;
        border-radius: 3px;
        text-decoration: none;
        color: #333;
        cursor: pointer;
        }

        /* 其他样式 */
        body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }
        </style>
    </head>
    <div class="container">
        <div class="close-icon">
            <a onclick="window.history.back()">&times;</a>
        </div>

        <div class="apply-form">
            <h1>Apply Job</h1>

            <form action="{{ route('submitApplication',$jobpost->jp_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="content">Content to the Company:</label>
                    <textarea name="content" id="content" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="resume">Resume:</label>
                    <input type="file" name="resume" id="resume" class="form-control-file @error('resume') is-invalid @enderror" accept=".pdf,.doc,.docx">
                    @if ($user->u_resume_file_path)
                        <p>Current Resume: <a href="{{ asset($user->u_resume_file_path) }}" target="_blank" class="mt-2">Download</a></p>
                        <input type="hidden" name="existing_resume" value="{{$user->u_resume_file_path }}">
                    @endif

                    @error('resume')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" class="form-control-file @error('profile_picture') is-invalid @enderror" name="profile_picture" id="profile_picture">
                    @if ($user->u_profile_pic && file_exists(public_path($user->u_profile_pic)))
                        <img src="{{ asset($user->u_profile_pic) }}" alt="Profile Picture" class="mt-2" id="profile_picture_preview" style="max-width: 400px; max-height: 400px;">
                        <input type="hidden" name="existing_profile_pic" value="{{$user->u_profile_pic }}">
                    @else
                        <span>No profile picture available</span>
                    @endif                                  

                    @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="apply-now-button">Apply Now</button>
            </form>
        </div>
    </div>

    @if($successMessage)
    <div class="alert alert-success">
        {{ $successMessage }}
    </div>
    @endif

<script>
    const profilePictureInput = document.getElementById('profile_picture');
    const profilePicturePreview = document.getElementById('profile_picture_preview');

    profilePictureInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.onload = function (event) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                const maxWidth = 400; // Set the maximum width for the resized image
                const maxHeight = 400; // Set the maximum height for the resized image
                let width = img.width;
                let height = img.height;

                if (width > maxWidth || height > maxHeight) {
                    if (width > height) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    } else {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;
                context.drawImage(img, 0, 0, width, height);

                profilePicturePreview.setAttribute('src', canvas.toDataURL('image/jpeg'));
                profilePicturePreview.style.display = 'block';
            };

            img.src = event.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>
@endsection
