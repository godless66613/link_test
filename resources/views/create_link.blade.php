<!DOCTYPE html>
<html lang="en">
<style>
    .error
    {
        color: red;
    }
</style>

<head>

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
    <div class="wrapper wrapper--w680">
        <div class="card card-1">
            <div class="card-heading"></div>
            <div class="card-body">
                <h2 class="title">Add new link</h2>
                <form method="POST" action="{{route('create_link')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="input-group">
                        <input class="input--style-1" type="text" placeholder="LINK" name="link">
                    </div>
                    {!! $errors->first('link', '<span class="error">:message</span>') !!}
                    <div class="input-group">
                        <input class="input--style-1" type="number" min="0" max="999" placeholder="TRANSFER LIMIT" name="transfer_limit">
                    </div>
                    {!! $errors->first('transfer_limit', '<span class="error">:message</span>') !!}
                    <div class="input-group">
                        <input class="input--style-1" type="number" min="1" max="24" placeholder="LIFETIME" name="lifetime">
                    </div>
                    {!! $errors->first('lifetime', '<span class="error">:message</span>') !!}
                    <div class="p-t-20">
                        <button class="btn btn--radius btn--green" type="submit">Submit</button>
                    </div>
                </form>
            </div>
            LINK LIST
            <ul>
                @foreach($links as $link)
                    <li><a href="{{route('show_link',$link->token)}}">{{$link->link}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Jquery JS-->
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Vendor JS-->
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/datepicker/moment.min.js"></script>
<script src="vendor/datepicker/daterangepicker.js"></script>

<!-- Main JS-->
<script src="js/global.js"></script>
<script>
    @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.success("{{ session('message') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif
</script>
</body>

</html>
<!-- end document-->
