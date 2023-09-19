@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
   /* 布局样式 */
       

        h1 {
        font-size: 24px;
        margin-bottom: 20px;
        }

        .job-listing {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        }

        .job-listing h2 {
        font-size: 20px;
        margin-bottom: 10px;
        }

        .job-listing p {
        margin-bottom: 5px;
        }

        .search-filters {
        margin-bottom: 20px;
        }

        /* 搜索过滤器样式 */
        .filter-dropdown {
        display: inline-block;
        margin-right: 10px;
        }

        .filter-dropdown select {
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 3px;
        }

        /* 其他样式 */
        body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        main{
            margin: 20px;
        }

        .job-listing {
        position: relative;
        }

        .job-detail-link {
        position: absolute;
        top: 10px;
        right: 10px;
        display: inline-block;
        background-color: #f9f9f9;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        text-decoration: none;
        color: #333;
        }

        .job-detail-link::after {
        content: "›";
        margin-left: 5px;
        }

        .filter-dropdown {
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 3px;
        margin-right: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
    }

    /* Style for select elements inside filter-dropdown */
    .filter-dropdown select {
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 3px;
        width: 150px; /* Adjust the width as needed */
        
    }

    .job-listings {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Adjust the gap as needed */
}

.job-listing {
    flex: 1;
    min-width: calc(50% - 20px); /* Adjust the width and gap as needed */
    padding: 15px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
}

.job-listing i {
    margin-right: 5px; /* Adjust the spacing between the icon and text */
    color: #333; /* Adjust the icon color as needed */
}

.job-info {
    margin-left: 15px; /* Adjust the margin as needed */
}
    </style>
</head>
<body>

    <main>
    <section>
        
    <h2><strong>Search Jobs</strong></h2>
       
            <form action="{{ route('job.search') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="keywords" class="form-control" placeholder="Keywords" value="{{ session('keywords') }}" style="padding: 5px; margin-right: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">
                    <button type="submit" class="btn btn-dark" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); " >Search</button>
                </div>
                                    
                               
                                    <div class="filters">
                                    <select name="state" class="filter-dropdown">
                                        <option value="">Select State</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Melaka">Melaka</option>
                                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Penang</option>
                                        <option value="Perak">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Putrajaya">Putrajaya</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Selangor">Selangor</option>
                                        <option value="Terengganu">Terengganu</option>
                                    </select>
                                    

                                    
                                    <select name="experience" class="filter-dropdown">
                                        <option value="">Any Experience</option>
                                        <option value="2 - 5">2 - 5 years</option>
                                        <option value="5 - 7">5 - 7 years</option>
                                        <option value="7 - 10">7 - 10 years</option>
                                        <option value="1 - 2">1 - 2 years</option>
                                        <option value="10 - 15">10 - 15 years</option>
                                        <option value="0 - 1">0 - 1 year</option>
                                        <option value="15 - *">15+ years</option>
                                    </select>
                                    

                                 
                                    <select name="salary" class="filter-dropdown">
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
                                    

                                   
                                    <select name="role" class="filter-dropdown">
                                        <option value="">Select Role</option>
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
                                    
                                    <select id="jobType" name="jobType" class="filter-dropdown">
                                    <!-- options for job types -->
                                    <option value="">Any Type</option>
                                    <option value="Full-time" >Full-time</option>
                                    <option value="Part-time" >Part-time</option>
                                    <!-- 添加其他选项 -->
                                    </select>
                                </div>     
                                    
            </form>
        </section>

        <section>
            <br>
            <h2>Search Results</h2>
            <div class="job-listings">
                <!-- Display job listings here -->
                @if(count($jobs) > 0)
                @foreach($jobs as $job)
                    <div class="job-listing">
                    <h2><strong>{{ $job->jp_pos }}</strong></h2>
                    <p class="job-info"><i class="fas fa-building"></i> <strong>Company Name:</strong> {{$job->user->name}}</p>
                    <p class="job-info"><i class="fas fa-clock"></i> <strong>Full or Part:</strong> {{ $job->jp_fulltime_parttime }}</p>
                    <p class="job-info"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->jp_location }}</p>
                    <!-- Add icons to other fields as needed -->
                    <p class="job-info"><i class="fas fa-user"></i> <strong>Experience: </strong>{{ $job->jp_exp_time }}</p>
                    <p class="job-info"><i class="fas fa-dollar-sign"></i> <strong>Salary:</strong> {{ $job->jp_salary }}</p>
                    <p class="job-info"><i class="fas fa-briefcase"></i> <strong>Role:</strong> {{ $job->jp_pos }}</p>
                    <a href="{{ route('job.show', ['id' => $job->jp_id]) }}" class="job-detail-link" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">Detail</a>
                    </div>
                @endforeach
            @else
                <p>No jobs found.</p>
            @endif
            </div>
        </section>
    </main>

</body>
</html>
@endsection