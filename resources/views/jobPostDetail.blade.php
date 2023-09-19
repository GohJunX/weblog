@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
  <style>
     #filters {
        margin-left:500px;
        margin-top:50px;
        max-width:500px;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

    h1 {
    text-align: center;
    margin-bottom: 20px;
    }

    .form-group {
    margin-bottom: 20px;
    
    }

    label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    }

    input[type="text"],
    textarea,
    select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    }

    button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    }

    button[type="submit"]:hover {
    background-color: #45a049;
    }

    .error-message {
    color: red;
    margin-top: 5px;
    }

    .success-message {
    color: green;
    margin-top: 5px;
    }
    .spacer{
        height: 20px;
    }
    .form-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
        }

 

  </style>
</head>
<body>

<form id="editJobForm" method="POST" action="{{ route('employerDetail.Edit', $jobPost->jp_id) }}" enctype="multipart/form-data"  >
    @csrf
    @method('PUT')

<div class="form-box" id="filters" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="form-group">
            <label for="jobDescription">Job Description:</label>
            <textarea id="jobDescription" name="jobDescription" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">{{ $jobPost->jp_des }}</textarea>
        </div>
        <div class="form-group">
        <label for="jobTitle">Job Position:</label>
        <select id="jobTitle" name="jobTitle" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">  
          <!-- options for job positions -->
          <option value="">All Positions</option>
          <option value="Software Engineer/Programmer" {{ $jobPost->jp_pos === 'Software Engineer/Programmer' ? 'selected' : '' }}>Software Engineer/Programmer</option>
          <option value="Senior Associate" {{ $jobPost->jp_pos === 'Senior Associate' ? 'selected' : '' }}>Senior Associate</option>
          <option value="Project Leader/Project Manager" {{ $jobPost->jp_pos === 'Project Leader/Project Manager' ? 'selected' : '' }}>Project Leader/Project Manager</option>
          <option value="Software Developer" {{ $jobPost->jp_pos === 'Software Developer' ? 'selected' : '' }}>Software Developer</option>
          <option value="Business Analyst" {{ $jobPost->jp_pos === 'Business Analyst' ? 'selected' : '' }}>Business Analyst</option>
          <option value="Manager" {{ $jobPost->jp_pos === 'Manager' ? 'selected' : '' }}>Manager</option>
          <option value="System Analyst/Tech Architect" {{ $jobPost->jp_pos === 'System Analyst/Tech Architect' ? 'selected' : '' }}>System Analyst/Tech Architect</option>
          <option value="Team Leader/Technical Leader" {{ $jobPost->jp_pos === 'Team Leader/Technical Leader' ? 'selected' : '' }}>Team Leader/Technical Leader</option>
          <option value="Associate" {{ $jobPost->jp_pos === 'Associate' ? 'selected' : '' }}>Associate</option>
          <option value="Other Software/Hardware/EDP" {{ $jobPost->jp_pos === 'Other Software/Hardware/EDP' ? 'selected' : '' }}>Other Software/Hardware/EDP</option>
          <option value="Accountant" {{ $jobPost->jp_pos === 'Accountant' ? 'selected' : '' }}>Accountant</option>
          <option value="Other Banking" {{ $jobPost->jp_pos === 'Other Banking' ? 'selected' : '' }}>Other Banking</option>
          <option value="Other Sales" {{ $jobPost->jp_pos === 'Other Sales' ? 'selected' : '' }}>Other Sales</option>
          <option value="Technical Support Engineer" {{ $jobPost->jp_pos === 'Technical Support Engineer' ? 'selected' : '' }}>Technical Support Engineer</option>
          <option value="Other Finance & Accounts" {{ $jobPost->jp_pos === 'Other Finance & Accounts' ? 'selected' : '' }}>Other Finance & Accounts</option>
          <option value="Business Development Manager" {{ $jobPost->jp_pos === 'Business Development Manager' ? 'selected' : '' }}>Business Development Manager</option>
          <option value="Other Roles" {{ $jobPost->jp_pos === 'Other Roles' ? 'selected' : '' }}>Other Roles</option>
          <option value="Financial/Business Analyst" {{ $jobPost->jp_pos === 'Financial/Business Analyst' ? 'selected' : '' }}>Financial/Business Analyst</option>
          <option value="Fresher" {{ $jobPost->jp_pos === 'Fresher' ? 'selected' : '' }}>Fresher</option>
          <option value="System Administrator" {{ $jobPost->jp_pos === 'System Administrator' ? 'selected' : '' }}>System Administrator</option>
          <option value="ERP/CRM - Functional Consultant" {{ $jobPost->jp_pos === 'ERP/CRM - Functional Consultant' ? 'selected' : '' }}>ERP/CRM - Functional Consultant</option>
          <option value="Software Test Engineer" {{ $jobPost->jp_pos === 'Software Test Engineer' ? 'selected' : '' }}>Software Test Engineer</option>
          <option value="Systems Engineer" {{ $jobPost->jp_pos === 'Systems Engineer' ? 'selected' : '' }}>Systems Engineer</option>
          <option value="Book Keeper/Accounts Assistant" {{ $jobPost->jp_pos === 'Book Keeper/Accounts Assistant' ? 'selected' : '' }}>Book Keeper/Accounts Assistant</option>
          <option value="Customer Service Executive (Voice)" {{ $jobPost->jp_pos === 'Customer Service Executive (Voice)' ? 'selected' : '' }}>Customer Service Executive (Voice)</option>
          <option value="Key Accounts Manager" {{ $jobPost->jp_pos === 'Key Accounts Manager' ? 'selected' : '' }}>Key Accounts Manager</option>
          <option value="Senior Manager" {{ $jobPost->jp_pos === 'Senior Manager' ? 'selected' : '' }}>Senior Manager</option>
          <option value="HR Executive/Recruiter" {{ $jobPost->jp_pos === 'HR Executive/Recruiter' ? 'selected' : '' }}>HR Executive/Recruiter</option>
          <option value="Marketing Manager" {{ $jobPost->jp_pos === 'Marketing Manager' ? 'selected' : '' }}>Marketing Manager</option>
          <option value="Network Administrator" {{ $jobPost->jp_pos === 'Network Administrator' ? 'selected' : '' }}>Network Administrator</option>
          <option value="ERP/CRM - Technical Consultant" {{ $jobPost->jp_pos === 'ERP/CRM - Technical Consultant' ? 'selected' : '' }}>ERP/CRM - Technical Consultant</option>
          <option value="Functional Consultant" {{ $jobPost->jp_pos === 'Functional Consultant' ? 'selected' : '' }}>Functional Consultant</option>
          <option value="Marketing" {{ $jobPost->jp_pos === 'Marketing' ? 'selected' : '' }}>Marketing</option>
          <option value="Other Human Resource" {{ $jobPost->jp_pos === 'Other Human Resource' ? 'selected' : '' }}>Other Human Resource</option>
          <option value="Sales Engineer" {{ $jobPost->jp_pos === 'Sales Engineer' ? 'selected' : '' }}>Sales Engineer</option>
          <option value="Security Analyst" {{ $jobPost->jp_pos === 'Security Analyst' ? 'selected' : '' }}>Security Analyst</option>
          <option value="Finance Manager" {{ $jobPost->jp_pos === 'Finance Manager' ? 'selected' : '' }}>Finance Manager</option>
          <option value="Other Customer Service/Call Center" {{ $jobPost->jp_pos === 'Other Customer Service/Call Center' ? 'selected' : '' }}>Other Customer Service/Call Center</option>
          <option value="Other Marketing" {{ $jobPost->jp_pos === 'Other Marketing' ? 'selected' : '' }}>Other Marketing</option>
          <option value="Channel Sales Manager" {{ $jobPost->jp_pos === 'Channel Sales Manager' ? 'selected' : '' }}>Channel Sales Manager</option>
          <option value="Database Administrator (DBA)" {{ $jobPost->jp_pos === 'Database Administrator (DBA)' ? 'selected' : '' }}>Database Administrator (DBA)</option>
          <option value="Purchase Officer/Co-ordinator/Executive" {{ $jobPost->jp_pos === 'Purchase Officer/Co-ordinator/Executive' ?'selected' : '' }}>Purchase Officer/Co-ordinator/Executive</option>
          <option value="Sales Coordinator" {{ $jobPost->jp_pos === 'Sales Coordinator' ? 'selected' : '' }}>Sales Coordinator</option>
          <option value="Sales Executive/Account Manager" {{ $jobPost->jp_pos === 'Sales Executive/Account Manager' ? 'selected' : '' }}>Sales Executive/Account Manager</option>
          <option value="Social Media Marketing" {{ $jobPost->jp_pos === 'Social Media Marketing' ? 'selected' : '' }}>Social Media Marketing</option>
          <option value="Database Architect/Designer" {{ $jobPost->jp_pos === 'Database Architect/Designer' ? 'selected' : '' }}>Database Architect/Designer</option>
          <option value="Market Research" {{ $jobPost->jp_pos === 'Market Research' ? 'selected' : '' }}>Market Research</option>
          <option value="Other Purchase/Supply Chain" {{ $jobPost->jp_pos === 'Other Purchase/Supply Chain' ? 'selected' : '' }}>Other Purchase/Supply Chain</option>
          <option value="Others" {{ $jobPost->jp_pos === 'Others' ? 'selected' : '' }}>Others</option>
          <option value="Recruitment - Head/Mgr" {{ $jobPost->jp_pos === 'Recruitment - Head/Mgr' ? 'selected' : '' }}>Recruitment - Head/Mgr</option>
          <option value="System Security" {{ $jobPost->jp_pos === 'System Security' ? 'selected' : '' }}>System Security</option>
          <option value="Technical Consultant" {{ $jobPost->jp_pos === 'Technical Consultant' ? 'selected' : '' }}>Technical Consultant</option>
          <option value="Administrative" {{ $jobPost->jp_pos === 'Administrative' ? 'selected' : '' }}>Administrative</option>
          <option value="Advertising - Executive" {{ $jobPost->jp_pos === 'Advertising - Executive' ? 'selected' : '' }}>Advertising - Executive</option>
          <option value="Corporate Sales" {{ $jobPost->jp_pos === 'Corporate Sales' ? 'selected' : '' }}>Corporate Sales</option>
          <option value="Customer Service Representative" {{ $jobPost->jp_pos === 'Customer Service Representative' ? 'selected' : '' }}>Customer Service Representative</option>
          <option value="ERP/CRM - Support Engineer" {{ $jobPost->jp_pos === 'ERP/CRM - Support Engineer' ? 'selected' : '' }}>ERP/CRM - Support Engineer</option>
          <option value="Graduate Trainee/Management Trainee" {{ $jobPost->jp_pos === 'Graduate Trainee/Management Trainee' ? 'selected' : '' }}>Graduate Trainee/Management Trainee</option>
          <option value="Graphic/Web Designer" {{ $jobPost->jp_pos === 'Graphic/Web Designer' ? 'selected' : '' }}>Graphic/Web Designer</option>
          <option value="Internal Auditor" {{ $jobPost->jp_pos === 'Internal Auditor' ? 'selected' : '' }}>Internal Auditor</option>
          <option value="Operations Manager" {{ $jobPost->jp_pos === 'Operations Manager' ? 'selected' : '' }}>Operations Manager</option>
          <option value="Payroll/Compensation - Head/Mgr" {{ $jobPost->jp_pos === 'Payroll/Compensation - Head/Mgr' ? 'selected' : '' }}>Payroll/Compensation - Head/Mgr</option>
          <option value="Pre Sales Consultant" {{ $jobPost->jp_pos === 'Pre Sales Consultant' ? 'selected' : '' }}>Pre Sales Consultant</option>
          <option value="Project Management" {{ $jobPost->jp_pos === 'Project Management' ? 'selected' : '' }}>Project Management</option>
          <option value="Supervisor/Team Lead" {{ $jobPost->jp_pos === 'Supervisor/Team Lead' ? 'selected' : '' }}>Supervisor/Team Lead</option>
          <option value="Telesales/Telemarketing Executive" {{ $jobPost->jp_pos === 'Telesales/Telemarketing Executive' ? 'selected' : '' }}>Telesales/Telemarketing Executive</option>
          <option value="Brand Manager" {{ $jobPost->jp_pos === 'Brand Manager' ? 'selected' : '' }}>Brand Manager</option>
          <option value="Database Administrator" {{ $jobPost->jp_pos === 'Database Administrator' ? 'selected' : '' }}>Database Administrator</option>
          <option value="Datawarehousing Consultants" {{ $jobPost->jp_pos === 'Datawarehousing Consultants' ? 'selected' : '' }}>Datawarehousing Consultants</option>
          <option value="Datawarehousing Technician" {{ $jobPost->jp_pos === 'Datawarehousing Technician' ? 'selected' : '' }}>Datawarehousing Technician</option>
          <option value="Direct Sales Agent/Commission Agent" {{ $jobPost->jp_pos === 'Direct Sales Agent/Commission Agent' ? 'selected' : '' }}>Direct Sales Agent/Commission Agent</option>
          <option value="HR Manager" {{ $jobPost->jp_pos === 'HR Manager' ? 'selected' : '' }}>HR Manager</option>
          <option value="Other Production/Engineering/R&D" {{ $jobPost->jp_pos === 'Other Production/Engineering/R&D' ? 'selected' : '' }}>Other Production/Engineering/R&D</option>
          <option value="Product Executive" {{ $jobPost->jp_pos === 'Product Executive' ? 'selected' : '' }}>Product Executive</option>
          <option value="Product Management" {{ $jobPost->jp_pos === 'Product Management' ? 'selected' : '' }}>Product Management</option>
          <option value="Project Co-ordinator" {{ $jobPost->jp_pos === 'Project Co-ordinator' ? 'selected' : '' }}>Project Co-ordinator</option>
          <option value="Regional Sales Manager" {{ $jobPost->jp_pos === 'Regional Sales Manager' ? 'selected' : '' }}>Regional Sales Manager</option>
          <option value="Social Media Executive" {{ $jobPost->jp_pos === 'Social Media Executive' ? 'selected' : '' }}>Social Media Executive</option>
          <option value="Telesales Consultant" {{ $jobPost->jp_pos === 'Telesales Consultant' ? 'selected' : '' }}>Telesales Consultant</option>
          <option value="Telesales Executive/Account Manager" {{ $jobPost->jp_pos === 'Telesales Executive/Account Manager' ? 'selected' : '' }}>Telesales Executive/Account Manager</option>
          <option value="VP/Head - Technology (IT)" {{ $jobPost->jp_pos === 'VP/Head - Technology (IT)' ? 'selected' : '' }}>VP/Head - Technology (IT)</option>
          <option value="Application Support" {{ $jobPost->jp_pos === 'Application Support' ? 'selected' : '' }}>Application Support</option>
          <option value="Business/Strategic Planning - Manager" {{ $jobPost->jp_pos === 'Business/StrategicPlanning - Manager' ? 'selected' : '' }}>Business/Strategic Planning - Manager</option>
          <option value="Chartered Accountant (CA)" {{ $jobPost->jp_pos === 'Chartered Accountant (CA)' ? 'selected' : '' }}>Chartered Accountant (CA)</option>
          <option value="Corp Communications - Manager/Executive" {{ $jobPost->jp_pos === 'Corp Communications - Manager/Executive' ? 'selected' : '' }}>Corp Communications - Manager/Executive</option>
          <option value="Credit Analysis/Approval" {{ $jobPost->jp_pos === 'Credit Analysis/Approval' ? 'selected' : '' }}>Credit Analysis/Approval</option>
          <option value="Electrical Engineer" {{ $jobPost->jp_pos === 'Electrical Engineer' ? 'selected' : '' }}>Electrical Engineer</option>
          <option value="Field Sales Executive" {{ $jobPost->jp_pos === 'Field Sales Executive' ? 'selected' : '' }}>Field Sales Executive</option>
          <option value="Financial Services Consultant" {{ $jobPost->jp_pos === 'Financial Services Consultant' ? 'selected' : '' }}>Financial Services Consultant</option>
          <option value="HR Business Partner" {{ $jobPost->jp_pos === 'HR Business Partner' ? 'selected' : '' }}>HR Business Partner</option>
          <option value="IT/Networking - Manager" {{ $jobPost->jp_pos === 'IT/Networking - Manager' ? 'selected' : '' }}>IT/Networking - Manager</option>
          <option value="Market Research - Manager" {{ $jobPost->jp_pos === 'Market Research - Manager' ? 'selected' : '' }}>Market Research - Manager</option>
          <option value="Mechanical Engineer" {{ $jobPost->jp_pos === 'Mechanical Engineer' ? 'selected' : '' }}>Mechanical Engineer</option>
          <option value="Quality Assurance - Manager" {{ $jobPost->jp_pos === 'Quality Assurance - Manager' ? 'selected' : '' }}>Quality Assurance - Manager</option>
          <option value="Regional Sales" {{ $jobPost->jp_pos === 'Regional Sales' ? 'selected' : '' }}>Regional Sales</option>
          <option value="Shares Services Executive" {{ $jobPost->jp_pos === 'Shares Services Executive' ? 'selected' : '' }}>Shares Services Executive</option>
          <option value="Team Leader" {{ $jobPost->jp_pos === 'Team Leader' ? 'selected' : '' }}>Team Leader</option>
          <option value="Technical Support" {{ $jobPost->jp_pos === 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
          <option value="Technology (IT)" {{ $jobPost->jp_pos === 'Technology (IT)' ? 'selected' : '' }}>Technology (IT)</option>
      </select>

    <label for="salary">Salary Range:</label>
    <select id="salary" name="salary" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
      <!-- options for salary ranges -->
      <option value="">Any Salary</option>
      <option value="Not Specified" {{ $jobPost->jp_salary === 'Not Specified' ? 'selected' : '' }}>Not Specified</option>
      <option value="6000~10000" {{ $jobPost->jp_salary === '6000~10000' ? 'selected' : '' }}>6000~10000</option>
      <option value="4000~6000" {{ $jobPost->jp_salary === '4000~6000' ? 'selected' : '' }}>4000~6000</option>
      <option value="10000~15000" {{ $jobPost->jp_salary === '10000~15000' ? 'selected' : '' }}>10000~15000</option>
      <option value="2000~4000" {{ $jobPost->jp_salary === '2000~4000' ? 'selected' : '' }}>2000~4000</option>
      <option value="100000~150000" {{ $jobPost->jp_salary === '100000~150000' ? 'selected' : '' }}>100000~150000</option>
      <option value="50000~100000" {{ $jobPost->jp_salary === '50000~100000' ? 'selected' : '' }}>50000~100000</option>
      <option value="150000~*" {{ $jobPost->jp_salary === '150000~*' ? 'selected' : '' }}>150000~*</option>
      <option value="25000~50000" {{ $jobPost->jp_salary === '25000~50000' ? 'selected' : '' }}>25000~50000</option>
      <option value="15000~25000" {{ $jobPost->jp_salary === '15000~25000' ? 'selected' : '' }}>15000~25000</option>
      <option value="1000~2000" {{ $jobPost->jp_salary === '1000~2000' ? 'selected' : '' }}>1000~2000</option>
      <!-- 添加其他选项 -->
    </select>

    <label for="experience">Job Experience:</label>
    <select id="experience" name="experience" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
      <!-- options for experience ranges -->
      <option value="">Any Experience</option>
      <option value="2 - 5" {{ $jobPost->jp_exp_time === '2 - 5' ? 'selected' : '' }}>2 - 5 years</option>
      <option value="5 - 7" {{ $jobPost->jp_exp_time === '5 - 7' ? 'selected' : '' }}>5 - 7 years</option>
      <option value="7 - 10" {{ $jobPost->jp_exp_time === '7 - 10' ? 'selected' : '' }}>7 - 10 years</option>
      <option value="1 - 2" {{ $jobPost->jp_exp_time === '1 - 2' ? 'selected' : '' }}>1 - 2 years</option>
      <option value="10 - 15" {{ $jobPost->jp_exp_time === '10 - 15' ? 'selected' : '' }}>10 - 15 years</option>
      <option value="0 - 1" {{ $jobPost->jp_exp_time === '0 - 1' ? 'selected' : '' }}>0 - 1 year</option>
      <option value="15 - *" {{ $jobPost->jp_exp_time === '15 - *' ? 'selected' : '' }}>15+ years</option>
      <!-- 添加其他选项 -->
    </select>

    <label for="jobType">Job Type:</label>
    <select id="jobType" name="jobType" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
      <!-- options for job types -->
      <option value="">Any Type</option>
      <option value="Full-time" {{ $jobPost->jp_fulltime_parttime === 'Full-time' ? 'selected' : '' }}>Full-time</option>
      <option value="Part-time" {{ $jobPost->jp_fulltime_parttime === 'Part-time' ? 'selected' : '' }}>Part-time</option>
      <!-- 添加其他选项 -->
    </select>

    <label for="jobLocation">Job Location:</label>
    <select id="jobLocation" name="jobLocation" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
      <!-- options for job locations -->
      <option value="">All Locations</option>
      <option value="Johor" {{ $jobPost->jp_location === 'Johor' ? 'selected' : '' }}>Johor</option>
      <option value="Kedah" {{ $jobPost->jp_location === 'Kedah' ? 'selected' : '' }}>Kedah</option>
      <option value="Kelantan" {{ $jobPost->jp_location === 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
      <option value="Kuala Lumpur" {{ $jobPost->jp_location === 'Kuala Lumpur' ? 'selected' : '' }}>Kuala Lumpur</option>
      <option value="Labuan" {{ $jobPost->jp_location === 'Labuan' ? 'selected' : '' }}>Labuan</option>
      <option value="Melaka" {{ $jobPost->jp_location === 'Melaka' ? 'selected' : '' }}>Melaka</option>
      <option value="Negeri Sembilan" {{ $jobPost->jp_location === 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
      <option value="Pahang" {{ $jobPost->jp_location === 'Pahang' ? 'selected' : '' }}>Pahang</option>
      <option value="Perak" {{ $jobPost->jp_location === 'Perak' ? 'selected' : '' }}>Perak</option>
      <option value="Perlis" {{ $jobPost->jp_location === 'Perlis' ? 'selected' : '' }}>Perlis</option>
      <option value="Penang" {{ $jobPost->jp_location === 'Penang' ? 'selected' : '' }}>Penang</option>
      <option value="Sabah" {{ $jobPost->jp_location === 'Sabah' ? 'selected' : '' }}>Sabah</option>
      <option value="Sarawak" {{ $jobPost->jp_location === 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
      <option value="Selangor" {{ $jobPost->jp_location === 'Selangor' ? 'selected' : '' }}>Selangor</option>
      <option value="Terengganu" {{ $jobPost->jp_location === 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
      <!-- 添加其他选项 -->
    </select>

   
    <label for="jobImages">Job Images:</label>
    <input type="file" id="jobImages" name="jobImages[]" multiple style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
    <div id="imagePreviewContainer" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">

    @if ($jobPost->jp_img)
        @foreach (explode(',', $jobPost->jp_img) as $imagePath)
            @if (file_exists(public_path(trim($imagePath))))
                <img src="{{ asset(trim($imagePath)) }}" alt="Job Image" width="100">
            @endif
        @endforeach
    @endif
    </div>

    @error('jobImages.*')
    <div class="error-message">{{ $message }}</div>
    @enderror


      <!-- Add the jobVideos field -->
      <label for="jobVideos">Job Videos:</label>
        <input type="file" id="jobVideos" name="jobVideos[]" multiple style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <div id="videoPreviewContainer" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">

        @if ($jobPost->jp_video)
            @foreach (explode(',', $jobPost->jp_video) as $videoPath)
                @if (file_exists(public_path(trim($videoPath))))
                    <video width="320" height="240" controls >
                        <source src="{{ asset(trim($videoPath)) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endforeach
        @endif
        </div>

@error('jobVideos.*')
<div class="error-message">{{ $message }}</div>
@enderror
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif  
    <div class="spacer"></div>
    <button type="submit">Edit Job</button>
    <button type="submit" class="delete-button" form="deleteForm" style="background-color:red;">Delete</button>
  </div>
</form>


<form action="{{ route('jobPosts.destroy', ['id' => $jobPost->jp_id]) }}" method="POST" enctype="multipart/form-data"  id="deleteForm">
    @csrf
    @method('POST')
 
</form>


<script>
    const jobImagesInput = document.getElementById('jobImages');
    const jobImagesPreview = document.getElementById('imagePreviewContainer');

    jobImagesInput.addEventListener('change', function (e) {
        jobImagesPreview.innerHTML = ''; // Clear previous preview

        const files = Array.from(e.target.files);

        files.forEach(function (file) {
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

                    const previewImage = document.createElement('img');
                    previewImage.src = canvas.toDataURL('image/jpeg');
                    previewImage.alt = 'Job Image';
                    previewImage.width = 100;

                    jobImagesPreview.appendChild(previewImage);
                };

                img.src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    });
</script>

<script>
    const jobVideosInput = document.getElementById('jobVideos');
    const jobVideosPreview = document.getElementById('videoPreviewContainer');

    jobVideosInput.addEventListener('change', function (e) {
        jobVideosPreview.innerHTML = ''; // Clear previous preview

        const files = Array.from(e.target.files);

        files.forEach(function (file) {
            const video = document.createElement('video');
            video.width = 320;
            video.height = 240;
            video.controls = true;

            const source = document.createElement('source');
            source.src = URL.createObjectURL(file);
            source.type = 'video/mp4';

            video.appendChild(source);
            jobVideosPreview.appendChild(video);
        });
    });
</script>
</body>
</html>

@endsection