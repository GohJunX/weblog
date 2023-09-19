@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body" >
                        <form method="POST" action="{{ route('employer.updateProfile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row" >
                                <label for="profile_picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                                    <input id="profile_picture" type="file" class="form-control-file @error('profile_picture') is-invalid @enderror" name="profile_picture" >

                                    @error('profile_picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @if ($user->u_profile_pic && file_exists(public_path($user->u_profile_pic)))
                                        <img src="{{ asset($user->u_profile_pic) }}" alt="Profile Picture" class="mt-2" id="profile_picture_preview" style="max-width: 400px; max-height: 400px;">
                                    @else
                                        <span>No profile picture available</span>
                                    @endif
                                </div>
                            </div>
                             
                            <div class="form-group row">
                                <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}<span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name', $user->name) }}" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="At least 8 character and require to fill in for edit" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_description" class="col-md-4 col-form-label text-md-right">{{ __('Company Description') }} <span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <textarea id="company_description" class="form-control @error('company_description') is-invalid @enderror" name="company_description" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">{{ $user->u_desc }}</textarea>

                                    @error('company_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_location" class="col-md-4 col-form-label text-md-right">{{ __('Company Location') }}<span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="company_location" type="text" class="form-control @error('company_location') is-invalid @enderror" name="company_location" value="{{ old('company_location', $user->u_location) }}" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">

                                    @error('company_location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}<span style="color:red">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}<span style="color:red">*</span></label>

                                <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->u_phone_number) }}" required oninput="validatePhoneInput(this)" minlength="10" maxlength="11" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
       
    <script>
function validatePhoneInput(input) {
    const value = input.value;
    const length = value.length;
    
    if (length < 10 || length > 11) {
        input.setCustomValidity("Phone number must be 10 or 11 characters.");
    } else {
        input.setCustomValidity("");
    }
}
</script>
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