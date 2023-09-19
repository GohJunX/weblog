    @extends('layouts.app')

    @section('content')
        <div class="container" >
            <div class="row justify-content-center" >
                <div class="col-md-8" >
                    <div class="card" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                        <div class="card-header">{{ __('Edit Profile') }}</div>

                        <div class="card-body" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                            <form method="POST" action="{{ route('jobSeeker.updateProfile') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group row" >
                                    <label for="profile_picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

                                    <div class="col-md-6"style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
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
                            
                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6" >
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('name', $user->name) }}" required autofocus style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="At least 8 character and require to fill in for edit" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->u_phone_number) }}" required oninput="validatePhoneInput(this)" minlength="10" maxlength="11" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">


                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6">
                                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">  
                                        <option value="">Select Gender</option>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender }}" {{ old('gender', $userGender) === $gender ? 'selected' : '' }}>{{ ucfirst($gender) }}</option>
                                        @endforeach
                                    </select>

                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}<span style="color:red">*</span></label>

                                    <div class="col-md-6">
                                        <select id="state" class="form-control @error('state') is-invalid @enderror" name="state" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                        <option value="Johor" {{ $user->u_state === 'Johor' ? 'selected' : '' }}>Johor</option>
                                        <option value="Kedah" {{ $user->u_state === 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                        <option value="Kelantan" {{ $user->u_state === 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                        <option value="Kuala Lumpur" {{ $user->u_state === 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
                                        <option value="Labuan" {{ $user->u_state === 'Labuan' ? 'selected' : '' }}>Labuan</option>
                                        <option value="Melaka" {{ $user->u_state === 'Melaka' ? 'selected' : '' }}>Melaka</option>
                                        <option value="Negeri Sembilan" {{ $user->u_state === 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                        <option value="Pahang" {{ $user->u_state === 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                        <option value="Perak" {{ $user->u_state === 'Perak' ? 'selected' : '' }}>Perak</option>
                                        <option value="Perlis" {{ $user->u_state === 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                        <option value="Penang" {{ $user->u_state === 'Penang' ? 'selected' : '' }}>Penang</option>
                                        <option value="Sabah" {{ $user->u_state === 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                        <option value="Sarawak" {{ $user->u_state === 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                        <option value="Selangor" {{ $user->u_state === 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                        <option value="Terengganu" {{ $user->u_state === 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                                        </select>

                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-bottom: 10px;">
                                    <label for="resume" class="col-md-4 col-form-label text-md-right">{{ __('Resume') }}</label>

                                    <div class="col-md-6">
                                        <input id="resume" type="file" class="form-control-file @error('resume') is-invalid @enderror" name="resume" accept=".pdf,.doc,.docx">
                                        <br>
                                        @if ($user->u_resume_file_path)
                                            <a href="{{ asset($user->u_resume_file_path) }}" target="_blank" class="mt-2">{{ __('Download Resume') }}</a>
                                        @endif

                                        @error('resume')
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