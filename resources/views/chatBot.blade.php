@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<head>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


</head>
<style>
       body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }
    *{
        margin: 0;
        padding: 0;
    }
    ::webkit-scrollbar{
        width: 5px;
    }
    ::webkit-scrollbar-track{
        background: blue;
    }
    ::webkit-scrollbar-thumb{
        background: black;
    }
</style>

<body style="background: white; overflow: hidden;">
    
<div>
    <div class="container-fluid m-0 d-flex p-2">
        <div class="pl-2" style=" width: 40px; height: 50px; font-size: 180%;">
            <a href="/"><i class="fa fa-angle-double-left text-white mt-2"></i></a>
        </div>
        <div style="width: 50px; height:50px;">
            <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="100%" height="100%" style="border-radius:50px;">
        </div>
        <div class="text-black font-weight-bold ml-2 mt-2">
            ChatBot
        </div>
    </div>
   
    <div class="container-fluid p-2" style="max-height: 510px; overflow-y: auto;">
        <div id="content-box">
            <!-- Your content here -->
        </div>
    </div>

</div>

<div class="container-fluid w-100 px-3 py-2 d-flex flex-row" style="background: rgba(0, 0, 0, 0.8); position: fixed; bottom: 0; left: 0; right: 0; height: 62px;">
        <div class="mr-2 pl-2" style="background: #ffffff1c; flex: 1; border-radius: 5px;">
            <input id="input" class="text-white" type="text" name="input" style="background: none; width: 100%; height: 100%; border: 0; outline: none;">
        </div>
        <div id="button-submit" class="text-center" style="background: #4acfee; height: 100%; width: 50px; border-radius: 5px;">
            <i class="fa fa-paper-plane text-white" aria-hidden="true" style="line-height: 45px; cursor: pointer;"></i>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
const openAiApiKey = '{{ env("OPENAI_API_KEY") }}';
let isRequestInProgress = false;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': 'Bearer ' + openAiApiKey
    },
    xhrFields: {
        withCredentials: true
    }
});

function submitForm() {
    if (isRequestInProgress) {
        return; // Don't allow multiple requests
    }

    $value = $('#input').val();
    $('#content-box').append(`<div class="mb-2">
        <div class="float-right px-3 py-2" style="width:270px; background: #4acfee; border-radius: 10px; float: right; font-size: 85%">
            ` + $value + `
        </div>
        <div style="clear: both;"></div>
    </div>`);

    isRequestInProgress = true;

    $.ajax({
        type: "post",
        url: '{{ route('send') }}',
        data: {
            'input': $value
        },

        success: function (data) {
            $('#content-box').append(`<div class="d-flex mb-2">
                <div class="mr-2" style="width: 45px; height: 45px;">
                    <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="100%" height="100%" style="border-radius: 50px;">
                </div>

                <div class="text-white px-3 py-2" style="width: 270px; background: rgba(0, 0, 0, 0.8); border-radius: 10px; font-size: 80%;">
                    ` + data + `
                </div>
            </div>`);
            $value = $('#input').val('');
        },
        complete: function () {
            isRequestInProgress = false;
        }
    })
}

// Bind the submitForm function to the Enter key press event on the input field
$('#input').on('keyup', function (event) {
    if (event.keyCode === 13) { // Enter key code is 13
        submitForm();
    }
});

// Bind the submitForm function to the click event on the #button-submit element
$('#button-submit').on('click', function () {
    submitForm();
});
</script>
</body>
</html>  

@endsection
