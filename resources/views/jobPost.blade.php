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

<form id="postJobForm" method="POST" action="{{ route('employerCreate') }}" enctype="multipart/form-data">
@csrf
@method('POST')
<div class="form-box" id="filters" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
  
      <div class="form-group">
                <label for="jobDescription">Job Description:</label>
                <textarea id="jobDescription" name="jobDescription" required style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);"></textarea>
      </div>
      @error('jobDescription')
          <div class="error-message">{{ $message }}</div>
        @enderror
        
      <label for="jobTitle">Job Position:</label>
        <select id="jobTitle" name="jobTitle" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom:10px;">
          
          <option value="">All Positions</option>
          <option value="Software Engineer/Programmer">Software Engineer/Programmer</option>
          <option value="Senior Associate">Senior Associate</option>
          <option value="Project Leader/Project Manager">Project Leader/Project Manager</option>
          <option value="Software Developer">Software Developer</option>
          <option value="Business Analyst">Business Analyst</option>
          <option value="Manager">Manager</option>
          <option value="System Analyst/Tech Architect">System Analyst/Tech Architect</option>
          <option value="Team Leader/Technical Leader">Team Leader/Technical Leader</option>
          <option value="Associate">Associate</option>
          <option value="Other Software/Hardware/EDP">Other Software/Hardware/EDP</option>
          <option value="Accountant">Accountant</option>
          <option value="Other Banking">Other Banking</option>
          <option value="Other Sales">Other Sales</option>
          <option value="Technical Support Engineer">Technical Support Engineer</option>
          <option value="Other Finance & Accounts">Other Finance & Accounts</option>
          <option value="Business Development Manager">Business Development Manager</option>
          <option value="Other Roles">Other Roles</option>
          <option value="Financial/Business Analyst">Financial/Business Analyst</option>
          <option value="Fresher">Fresher</option>
          <option value="System Administrator">System Administrator</option>
          <option value="ERP/CRM - Functional Consultant">ERP/CRM - Functional Consultant</option>
          <option value="Software Test Engineer">Software Test Engineer</option>
          <option value="Systems Engineer">Systems Engineer</option>
          <option value="Book Keeper/Accounts Assistant">Book Keeper/Accounts Assistant</option>
          <option value="Customer Service Executive (Voice)">Customer Service Executive (Voice)</option>
          <option value="Key Accounts Manager">Key Accounts Manager</option>
          <option value="Senior Manager">Senior Manager</option>
          <option value="HR Executive/Recruiter">HR Executive/Recruiter</option>
          <option value="Marketing Manager">Marketing Manager</option>
          <option value="Network Administrator">Network Administrator</option>
          <option value="ERP/CRM - Technical Consultant">ERP/CRM - Technical Consultant</option>
          <option value="Functional Consultant">Functional Consultant</option>
          <option value="Marketing">Marketing</option>
          <option value="Other Human Resource">Other Human Resource</option>
          <option value="Sales Engineer">Sales Engineer</option>
          <option value="Security Analyst">Security Analyst</option>
          <option value="Finance Manager">Finance Manager</option>
          <option value="Other Customer Service/Call Center">Other Customer Service/Call Center</option>
          <option value="Other Marketing">Other Marketing</option>
          <option value="Channel Sales Manager">Channel Sales Manager</option>
          <option value="Database Administrator (DBA)">Database Administrator (DBA)</option>
          <option value="Purchase Officer/Co-ordinator/Executive">Purchase Officer/Co-ordinator/Executive</option>
          <option value="Sales Coordinator">Sales Coordinator</option>
          <option value="Sales Executive/Account Manager">Sales Executive/Account Manager</option>
          <option value="Social Media Marketing">Social Media Marketing</option>
          <option value="Database Architect/Designer">Database Architect/Designer</option>
          <option value="Market Research">Market Research</option>
          <option value="Other Purchase/Supply Chain">Other Purchase/Supply Chain</option>
          <option value="Others">Others</option>
          <option value="Recruitment - Head/Mgr">Recruitment - Head/Mgr</option>
          <option value="System Security">System Security</option>
          <option value="Technical Consultant">Technical Consultant</option>
          <option value="Administrative">Administrative</option>
          <option value="Advertising - Executive">Advertising - Executive</option>
          <option value="Corporate Sales">Corporate Sales</option>
          <option value="Customer Service Representative">Customer Service Representative</option>
          <option value="ERP/CRM - Support Engineer">ERP/CRM - Support Engineer</option>
          <option value="Graduate Trainee/Management Trainee">Graduate Trainee/Management Trainee</option>
          <option value="Graphic/Web Designer">Graphic/Web Designer</option>
          <option value="Internal Auditor">Internal Auditor</option>
          <option value="Operations Manager">Operations Manager</option>
          <option value="Payroll/Compensation - Head/Mgr">Payroll/Compensation - Head/Mgr</option>
          <option value="Pre Sales Consultant">Pre Sales Consultant</option>
          <option value="Project Management">Project Management</option>
          <option value="Supervisor/Team Lead">Supervisor/Team Lead</option>
          <option value="Telesales/Telemarketing Executive">Telesales/Telemarketing Executive</option>
          <option value="Brand Manager">Brand Manager</option>
          <option value="Database Administrator">Database Administrator</option>
          <option value="Datawarehousing Consultants">Datawarehousing Consultants</option>
          <option value="Datawarehousing Technician">Datawarehousing Technician</option>
          <option value="Direct Sales Agent/Commission Agent">Direct Sales Agent/Commission Agent</option>
          <option value="HR Manager">HR Manager</option>
          <option value="Other Production/Engineering/R&D">Other Production/Engineering/R&D</option>
          <option value="Product Executive">Product Executive</option>
          <option value="Product Management">Product Management</option>
          <option value="Project Co-ordinator">Project Co-ordinator</option>
          <option value="Regional Sales Manager">Regional Sales Manager</option>
          <option value="Social Media Executive">Social Media Executive</option>
          <option value="Telesales Consultant">Telesales Consultant</option>
          <option value="Telesales Executive/Account Manager">Telesales Executive/Account Manager</option>
          <option value="VP/Head - Technology (IT)">VP/Head - Technology (IT)</option>
          <option value="Application Support">Application Support</option>
          <option value="Business/Strategic Planning - Manager">Business/Strategic Planning - Manager</option>
          <option value="Chartered Accountant (CA)">Chartered Accountant (CA)</option>
          <option value="Corp Communications - Manager/Executive">Corp Communications - Manager/Executive</option>
          <option value="Credit Analysis/Approval">Credit Analysis/Approval</option>
          <option value="Electrical Engineer">Electrical Engineer</option>
          <option value="Field Sales Executive">Field Sales Executive</option>
          <option value="Financial Services Consultant">Financial Services Consultant</option>
          <option value="HR Business Partner">HR Business Partner</option>
          <option value="IT/Networking - Manager">IT/Networking - Manager</option>
          <option value="Market Research - Manager">Market Research - Manager</option>
          <option value="Mechanical Engineer">Mechanical Engineer</option>
          <option value="Quality Assurance - Manager">Quality Assurance - Manager</option>
          <option value="Regional Sales">Regional Sales</option>
          <option value="Shares Services Executive">Shares Services Executive</option>
          <option value="Team Leader">Team Leader</option>
          <option value="Technical Support">Technical Support</option>
          <option value="Technology (IT)">Technology (IT)</option>
        </select>
        @error('jobTitle')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="salary">Salary Range:</label>
        <select id="salary" name="salary" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
          <option value="">Any Salary</option>
          <option value="Not Specified">Not Specified</option>
          <option value="6000~10000">6000~10000</option>
          <option value="4000~6000">4000~6000</option>
          <option value="10000~15000">10000~15000</option>
          <option value="2000~4000">2000~4000</option>
          <option value="100000~150000">100000~150000</option>
          <option value="50000~100000">50000~100000</option>
          <option value="150000~*">150000~*</option>
          <option value="25000~50000">25000~50000</option>
          <option value="15000~25000">15000~25000</option>
          <option value="1000~2000">1000~2000</option>
        </select>

        <label for="experience">Job Experience:</label>
        <select id="experience" name="experience" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
          <option value="">Any Experience</option>
          <option value="2 - 5">2 - 5 years</option>
          <option value="5 - 7">5 - 7 years</option>
          <option value="7 - 10">7 - 10 years</option>
          <option value="1 - 2">1 - 2 years</option>
          <option value="10 - 15">10 - 15 years</option>
          <option value="0 - 1">0 - 1 year</option>
          <option value="15 - *">15+ years</option>
        </select>

        <label for="jobType">Job Type:</label>
        <select id="jobType" name="jobType" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
          <option value="">Any Type</option>
          <option value="Full-time">Full-time</option>
          <option value="Part-time">Part-time</option>
        </select>

        <label for="jobLocation">Job Location:</label>
        <select id="jobLocation" name="jobLocation" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
          <option value="">All Locations</option>
          <option value="Johor">Johor</option>
          <option value="Kedah">Kedah</option>
          <option value="Kelantan">Kelantan</option>
          <option value="Kuala Lumpur">Kuala Lumpur</option>
          <option value="Labuan">Labuan</option>
          <option value="Melaka">Melaka</option>
          <option value="Negeri Sembilan">Negeri Sembilan</option>
          <option value="Pahang">Pahang</option>
          <option value="Perak">Perak</option>
          <option value="Perlis">Perlis</option>
          <option value="Penang">Penang</option>
          <option value="Sabah">Sabah</option>
          <option value="Sarawak">Sarawak</option>
          <option value="Selangor">Selangor</option>
          <option value="Terengganu">Terengganu</option>
        </select>


        <label for="jobImages">Job Images:</label>
        <input type="file" id="jobImages" name="jobImages[]" multiple style="margin-bottom:10px;">
        @error('jobImages.*')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <div id="imagePreviewContainer"></div>
     
        <label for="jobVideos">Job Videos:</label>
        <input type="file" id="jobVideos" name="jobVideos[]" multiple style="margin-bottom:10px;">
        <div id="videoPreviewContainer"></div>
        @error('jobVideos.*')
          <div class="error-message">{{ $message }}</div>
        @enderror
      

        <div class="spacer"></div>
        <button type="submit">Post Job</button>

 
</div>

</form>

</body>
<script>
  // Image preview
  document.getElementById('jobImages').addEventListener('change', function(e) {
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
  document.getElementById('jobVideos').addEventListener('change', function(e) {
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
</html>

@endsection