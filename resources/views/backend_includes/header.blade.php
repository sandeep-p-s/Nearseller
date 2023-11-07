<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nearsellers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="  crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"> --}}

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

{{-- @php
$roleid=session('roleid');
$roleIdsArray = explode(',', $roleid);
if (in_array('2', $roleIdsArray)) {
    $gallery_dets = $allsectdetails->shop_photo;
    $qrgallerydetsarray = json_decode($gallery_dets);
    $qrgallery = $qrgallerydetsarray->fileval;
    if (!empty($qrgallery)) {
        $firstImage = $qrgallery[0];
    } else {
        $firstImage='';
    }
}
if (in_array('9', $roleIdsArray)) {
    $gallery_dets = $allsectdetails->shop_photo;
    $qrgallerydetsarray = json_decode($gallery_dets);
    $qrgallery = $qrgallerydetsarray->fileval;
    if (!empty($qrgallery)) {
        $firstImage = $qrgallery[0];
    } else {
        $firstImage='';
    }
}
else {
    $firstImage='';
}
@endphp --}}
<style>
    .error{
        color: red;
    }
    .success-message {
        color: green;
    }
    #loading-image {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(197, 199, 206, 0.5);
        z-index: 9998;
        display: none;
    }

    table.table-bordered.dataTable tbody th, table.table-bordered.dataTable tbody td {
        overflow-wrap: anywhere;
    }

    .section_wrapper {
        max-width: 1700px;
        margin: auto;
        width: 100%;
        }

    .custom-modal-dialog {
        max-width: 100%;
        width: 100%;
        margin: 0;
    }

    .mySlides {display:none}
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:13px;width:13px;padding:0}

    .new_hr
    {
        margin-top: 8px;
        margin-bottom: 8px;

    }
    .video-container {
            position: relative;
            max-width: 320px; /* Adjust the width as needed */
        }

        .video-remove-button {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            cursor: pointer;
            padding: 5px;
        }

        video {
            width: 100%;
            height: auto;
        }
        .new_thumpnail {
            padding: 2px;
            height: 100px;
            width: 100px;
            margin: 1px;
        }
.new_image_response{
    background-size: cover;
    height: 140px;

    width: 95%;
    /* height: auto; */
    border-radius: 15px;
    box-shadow: 20px 20px 60px #bebebe, -20px -20px 60px #ffffff;
    object-fit: cover;
    border: 3px solid #928e8612;
}
.thumb-xl {
    height: 120px;
    width: 120px;
    font-size: 22px;
    font-weight: 700
}
.new_logo
{
    margin-top: 10px;
}

@font-face {
        font-family: 'Glyphicons Halflings';
        src: url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.eot);
        src: url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.eot?#iefix) format('embedded-opentype'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.woff2) format('woff2'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.woff) format('woff'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.ttf) format('truetype'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format('svg')
    }

    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }

@font-face {
        font-family: 'Glyphicons Halflings';
        src: url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.eot);
        src: url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.eot?#iefix) format('embedded-opentype'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.woff2) format('woff2'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.woff) format('woff'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.ttf) format('truetype'), url(https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format('svg')
    }

    .glyphicon {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale
    }



    .glyphicon-chevron-up:before {
        content: "\e113"
    }

    .glyphicon-chevron-down:before {
        content: "\e114"
    }

    .glyphicon-chevron-up:before {
        content: "\e113"
    }

    .glyphicon-chevron-down:before {
        content: "\e114"
    }


</style>

@php
    /* .page-content {
        background-image: {{ $firstImage ? 'url('.asset($firstImage).')' : 'url('.asset('path_to_default_image.jpg').')' }};
        background-repeat: no-repeat;
        background-size: cover;

    } */
@endphp


<body class="dark-sidenav">
    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <!-- LOGO -->
        <div class="brand">

                    <span>
                        {{-- @php
                            $roleid = session('roleid');
                            $roleIdsArray = explode(',', $roleid);
                            if (in_array('2', $roleIdsArray)) {
                        @endphp
                        <img src="{{ asset($allsectdetails->shoplogo ?: 'backend/assets/images/logo.png') }}" style="width: 100%; height: 100%;" alt="logo-large" class="logo-lg logo-light">

                        @php
                            } elseif (in_array('9', $roleIdsArray)) {
                        @endphp
                        <img src="{{ asset($allsectdetails->shoplogo ?: 'backend/assets/images/logo.png') }}" style="width: 100%; height: 100%;" alt="logo-large" class="logo-lg logo-light">

                        @php
                            } else {
                        @endphp
                                <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light">
                        @php
                            }
                        @endphp --}}

                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light new_logo">
                    </span>


            </a>
        </div>
        <!--end logo-->




