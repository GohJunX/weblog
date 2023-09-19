@extends('layouts.appAdmin')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
   /* 布局样式 */
        .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 20px;
        }

        h1 {
        font-size: 24px;
        margin-bottom: 20px;
        }

        .job-listing {
        margin-bottom: 20px;
        padding: 15px;
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
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
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
            font-family: Arial, sans-serif;
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

        .job-listings {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Adjust the gap as needed */
        }

        .job-listing {
            flex: 1;
            min-width: calc(50% - 20px); /* Adjust the width and gap as needed */
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
        }
    </style>
</head>
<body>

    <main>
    <section>
        <h2>Search Jobs</h2>
            <form action="{{ route('admin.verify.search') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="keywords" class="form-control" placeholder="Keywords" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); " value="{{ session('keywords') }}">
                    <button type="submit" class="btn btn-dark" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">Search</button>
                </div>
     
                <div class="filters">
                    @if($companies !== null)
                        <div class="filter-dropdown">
                            <select name="company">
                                @foreach($companies as $companyId => $companyName)
                                    <option value="{{ $companyId }}">{{ $companyName }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
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
                    <h2><strong> {{ $job->jp_pos }}</strong></h2>
                    <p style="margin-left: 15px;"><i class="fas fa-building"></i> <strong>Company Name:</strong> {{$job->user->name}}</p>
                    <p style="margin-left: 15px;"><i class="fas fa-clock"></i> <strong>Full or Part:</strong> {{ $job->jp_fulltime_parttime }}</p>
                    <p style="margin-left: 15px;"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->jp_location }}</p>
                    <p style="margin-left: 15px;"><i class="fas fa-user"></i> <strong>Experience: </strong>{{ $job->jp_exp_time }}</p>
                    <p style="margin-left: 15px;"><i class="fas fa-dollar-sign"></i> <strong>Salary:</strong> {{ $job->jp_salary }}</p>
                    <p style="margin-left: 15px;"><i class="fas fa-briefcase"></i> <strong>Role:</strong> {{ $job->jp_pos }}</p>
                    @if($job->job_ver == 0)
                    <p style="margin-left: 15px;"><i class="fas fa-info-circle"></i> <strong>Verify status:</strong> Pending</p>
                    @elseif($job->job_ver == 1)
                    <p style="margin-left: 15px;"><i class="fas fa-check-circle"></i> <strong>Verify status:</strong> Verified</p>
                                    @endif
                    <a href="{{ route('admin.verifyJB.show', $job->jp_id) }}" class="job-detail-link" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); "> Detail</a>
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