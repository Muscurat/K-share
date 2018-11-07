<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show toasts</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel='stylesheet' type='text/css' />
<!--<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ asset('validator/css/bootstrapValidator.min.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('vendor/animate/animate.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('vendor/animsition/css/animsition.min.css') }}" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/input_style.css') }}" />
    <link href="{{ asset('css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/main.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/util.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/pop1.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/pop2.css') }}" rel='stylesheet' type='text/css' />

    <!--===============================================================================================-->
    <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"> </script>

    <style type="text/css">
        body {
            color: #404E67;
            background: #F5F7FA;
            font-family: 'Open Sans', sans-serif;
        }

        .search-box input {
            height: 40px;
            width: 400px;
            border-radius: 0px;
            padding-left: 35px;
            border-color: gray;
            box-shadow: none;
        }

        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 20px;
        }

        .container{

            margin-left: 20px;
            margin-right: 20px;

        }

        .table-wrapper {
            width: 1300px;
            margin-left: 0px auto;
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }
        .table-title h2 {
            margin: 6px 0 0;
            font-size: 22px;
        }
        .table-title .add-new {
            float: right;
            height: 37px;
            font-weight: bold;
            font-size: 18px;
            text-shadow: none;
            min-width: 150px;
            border-radius: 50px;
            line-height: 13px;
        }
        .table-title .add-new i {
            margin-right: 10px;
        }
        table.table {
            table-layout: fixed;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table th:last-child {
            width: 100px;
        }
        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }
        table.table td a.add {
            color: #27C46B;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }
        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }
        table.table .form-control {
            height: 32px;
            line-height: 32px;
            box-shadow: none;
            border-radius: 2px;
        }
        table.table .form-control.error {
            border-color: #f50000;
        }
        table.table td .add {
            display: none;
        }

        .invalid {
            color: red;
        }

        .valid{
            color: green;
        }

        .has-error .help-block {
            color: red;
        }

        .profile-img{
            margin-top: 0px;
            margin-right: 5px;
            float: left;
            background-size: auto 100%; /* Interchange this value depending on prefering width vs. height */
            width: 50px;
            height: 50px;
        }


    </style>

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Manage<span>Toasts</span></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
                <li><div class="profile-img img-circle" style="background: url({{ asset('Photos/ProfilePictures/'.Auth::user()->photoPath.'.png') }}) 50% 50% no-repeat;"></div></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                        <!-- The Profile picture inserted via div class below, with shaping provided by Bootstrap -->

                        {{Auth::user()->userName}} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a style="cursor: pointer;" href="http://192.168.43.169:8000/api/toast/logout">Log out</a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>

<div class="container" >
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4" ><h2 style="font-weight: bold; color: #6c757d;">Toasts <b>Details</b></h2></div>
                <div class="search-box col-sm-4">
                    <i class="glyphicon glyphicon-search" style="width: 50px;"></i>
                    <input type="text" id="searchTable" class="form-control"  placeholder="Search&hellip;">
                </div>
                <div class="col-sm-2" style="margin-left: 200px;padding-top: 0px;cursor: pointer;margin-bottom: 20px;">
                    <a id="addToast" data-toggle="modal" data-target="#showToast" style="margin-left: 85px;" class="btn btn-info" >
                        <span class="glyphicon glyphicon-plus"></span><span style="font-size: 17px;font-weight: bold;"> Add toast </span>
                    </a>
                </div>

            </div>
        </div>
        <table id="toastTable" class="table">
            <thead class="thead-light">
            <tr style="font-weight: bold;font-size: 17px;">
                <th>Specialty</th>
                <th>Title</th>
                <th>Creation date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($toasts as $toast)
                <tr class="myTr" id="{{$toast->id}}">
                    <td>{{ $toast->specialty }}</td>
                    <td>{{ $toast->title }}</td>
                    <td>{{ $toast->created_at }}</td>
                    <td>
                        <a class="edit" title="Edit" onclick="getToastInformation({{$toast->id}})" data-toggle="modal" data-target="#showToastUpdate">
                            <i class="material-icons">&#xE254;</i>
                        </a>
                        <a class="delete cd-popup-trigger" title="Delete" onclick="deleteToast({{$toast->id}})" style="cursor: pointer;"
                           data-toggle="modal" data-target="#confirmation">
                            <i class="material-icons">&#xE872;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

<!--formulaire pour ajouter un nouveau toast-->
<div id="showToast" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="cancelAdd">&times;</button>
                <h4 class="modal-title"><i class="fa fa-drivers-license-o" style="margin-right: 8px"></i> Toast</h4>

            </div>
            <div class="modal-body">

                <form class="contact100-form" id="toastForm">
                    <div class="wrap-input100 validate-input form-group">
                        <span class="label-input100">Domain :</span>
                        <input type="text" class="form-control" id="domain" name="domain" disabled />
                        <span class="focus-input100"></span>
                    </div>


                    <div class="wrap-input100 validate-input form-group">
                        <span class="label-input100">Specialty :</span>
                        <select class="form-control" style="cursor: pointer;" id="specialty"
                                name="specialty" />

                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group">
                        <span class="label-input100">Difficulty :</span>
                        <select class="form-control" style="cursor: pointer;" id="difficulty"
                                name="difficulty" />
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Title :</span>
                        <input type="text" class="form-control" name="title" id="title" style="margin-bottom: 10px;"/>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Toast :</span>
                        <textarea class="form-control" id="toast" name="toast" placeholder="Toast text..." rows="10" style="margin-bottom: 10px;"></textarea>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Keywords :</span>
                        <input type="text" class="form-control" id="keywords" name="keywords" style="margin-bottom: 10px;"/>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Link :</span>
                        <input type="text" class="form-control" name="link" id="link" style="margin-bottom: 10px;"/>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" id="commitToast">
                        <span>
                            Create
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>
<!-- formulaire pour modifier un toast -->
<div id="showToastUpdate" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" id="cancelUpdate">&times;</button>
                <h3 class="modal-title" style="font-size: 20px;font-weight: bold;"><i class="fa fa-edit" style="margin-right: 8px"></i>Toast information</h3>
            </div>

            <div class="modal-body">

                <form class="contact100-form" id="toastFormUpdate">
                    <div class="wrap-input100 validate-input form-group">
                        <span class="label-input100">Domain :</span>
                        <input type="text" class="form-control" id="domainUpdate" name="domainUpdate" disabled />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group">
                        <span class="label-input100">Specialty :</span>
                        <input type="text" class="form-control" id="specialtyUpdate" name="specialtyUpdate" disabled />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="btn-group" style="margin-bottom: 20px;">
                        <span class="label-input100">Difficulty :</span>
                        <label class="btn">
                            <input type="radio" id="low" name="difficultyUpdate" value="low" autocomplete="off" disabled> Low
                        </label>
                        <label class="btn">
                            <input type="radio" id="medium" name="difficultyUpdate" value="medium" autocomplete="off" disabled> Medium
                        </label>
                        <label class="btn" disabled="true">
                            <input type="radio" id="high" name="difficultyUpdate" value="high" autocomplete="off" disabled> High
                        </label>
                        <span class="label-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Title :</span>
                        <input type="text" class="form-control" name="titleUpdate" id="titleUpdate" style="margin-bottom: 10px;"/>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Toast :</span>
                        <textarea class="form-control" id="toastUpdate" name="toastUpdate" placeholder="Toast text..." rows="10" style="margin-bottom: 10px;"></textarea>
                        <span class="focus-input100"></span>
                    </div>

                    <input id="toastIdentifier" name="toastIdentifier" type="hidden" value="">

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Keywords :</span>
                        <input type="text" class="form-control" id="keywordsUpdate" name="keywordsUpdate" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input form-group" data-validate = "Message is required">
                        <span class="label-input100">Link :</span>
                        <input type="text" class="form-control" name="linkUpdate" id="linkUpdate" style="margin-bottom: 10px;" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" id="commitToastUpdate">
                        <span>
                            Update
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<div class="modal" data-backdrop="static" data-keyboard="false" role="dialog" id="confirmation">
    <div class="cd-popup-container">
        <p>Are you sure you want to delete this element?</p>
        <ul class="cd-buttons">
            <li style="cursor: pointer;"><a id="yes" data-dismiss="modal">Yes</a></li>
            <li style="cursor: pointer;"><a id="no" data-dismiss="modal">No</a></li>
        </ul>
        <a id ="closeConfirmation" data-dismiss="modal" class="cd-popup-close img-replace" style="cursor: pointer;">Close</a>
    </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->

<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"> </script>
<!--<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"> </script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('validator/js/bootstrapValidator.min.js') }}"></script>
<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"> </script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"> </script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"> </script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"> </script>
<!--===============================================================================================-->
<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"> </script>
<script src="{{ asset('js/main.js') }}"> </script>
<script src="{{ asset('js/pop1.js') }}"></script>
<script src="{{ asset('js/pop2.js') }}"></script>
<script  src="{{ asset('js/view.js') }}"></script>
<script src="{{ asset('js/tokenizer/tokenizer.js') }}"></script>

<!-- search filter -->
<script>

    var $rows = $('.myTr');
    $('#searchTable').keyup(function() {

        var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
            reg = RegExp(val, 'i'),text;

        $rows.show().filter(function() {
            text = $(this).text().replace(/\s+/g, ' ');
            return !reg.test(text);
        }).hide();
    });

</script>

<!-- add a new toast -->
<script>

    /*  $.ajaxSetup({
     headers: {
     'Authorization':'Bearer ' + $('meta[name="token"]').attr('content')
     }
     });*/

    $('#addToast').click(function(){

        $.ajax({
            url: 'http://192.168.43.169:8000/api/toast/create',
            type: 'GET',
            dataType: "json",

            success : function(data){
                //alert(data.id);
                $('#toastForm').find("input[type=text], textarea").val("");
                $('#keywords').tokenizer('empty');
                $('#domain').val(data.domain);
                var specialties = data.specialties;
                $.each(specialties, function(key,specialty){

                    $('#specialty').append($("<option />").val(specialty.id+'').text(specialty.specialty+''));

                });

            },

            error: function(xhr, status, error) {
                alert(error);
            }
        });

    });

    $('#commitToast').click(function(){

        var bootstrapValidator = $("#toastForm").data('bootstrapValidator');
        bootstrapValidator.validate();
        if(bootstrapValidator.isValid()){

            var list = $('#keywords').tokenizer('get');
            //console.log(list[0]);

            $.ajax({
                url: 'http://192.168.43.169:8000/api/toast/create',
                type: 'POST',
                dataType: "json",
                data:{
                    'specialty' : $('select[name=specialty]').val(),
                    'difficulty' : $('select[name=difficulty]').val(),
                    'toast' : $('#toast').val(),
                    'link' : $('#link').val(),
                    'keywords' : list,
                    'title' : $('#title').val()
                },

                success : function(data){
                    if(data.response == 'ok'){

                        location.href = "http://192.168.43.169:8000/api/toast";

                    }else{

                        alert('There is something wrong');

                    }
                },

                error: function(xhr, status, error) {
                    alert(error);
                }
            });

        }
    });

    $("#cancelAdd").click(function(){
        $('#toastForm').find("input[type=text], textarea").val("");
        $('#keywords').tokenizer('empty');
        $('#specialty')
            .find('option')
            .remove();
    });

</script>

<!-- inputs Validator -->
<script>

    $input = $('#keywords').tokenizer();
    $inputUpdate  = $('#keywordsUpdate').tokenizer();

    //bootstrap validator for create a new toast
    $(document).ready(function() {
        $('#toastForm').bootstrapValidator({

            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'The title must be more than 6 and less than 25 characters long'
                        }//,
                        /*regexp: {
                         regexp: /[^a-z0-9\s]/gi,
                         message: 'The title can only consist of alphabetical, number and underscore'
                         }*/
                    }
                },
                toast: {
                    validators: {
                        notEmpty: {
                            message: 'The toast is required and cannot be empty'
                        },
                        stringLength: {
                            min: 100,
                            max: 350,
                            message: 'The toast must be more than 100 and less than 350 characters long'
                        }
                    }
                },
                link: {
                    validators: {
                        notEmpty: {
                            message: 'The link is required and cannot be empty'
                        },
                        regexp: {
                            regexp:/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/,
                            message: 'The link must exist'
                        }
                    }
                }
            }

        });

        $('#toastFormUpdate').bootstrapValidator({

            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                titleUpdate: {
                    validators: {
                        notEmpty: {
                            message: 'The title is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'The title must be more than 6 and less than 20 characters long'
                        }/*,
                         regexp: {
                         regexp: /^[a-zA-Z0-9_]+$/,
                         message: 'The title can only consist of alphabetical, number and underscore'
                         }*/
                    }
                },
                toastUpdate: {
                    validators: {
                        notEmpty: {
                            message: 'The toast is required and cannot be empty'
                        },
                        stringLength: {
                            min: 100,
                            max: 350,
                            message: 'The toast must be more than 100 and less than 350 characters long'
                        }
                    }
                },
                linkUpdate: {
                    validators: {
                        notEmpty: {
                            message: 'The link is required and cannot be empty'
                        },
                        regexp: {
                            regexp:/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/,
                            message: 'The link must exist'
                        }
                    }
                }
            }

        });

    });

</script>

<!-- delete a toast -->
<script>


    function deleteToast(id){

        //$(this).parent().parent().css( "background", "#09c6df" );
        $( "#toastTable" ).find( "#"+id ).css( "background", "#09c6df" );
        window.toastID = id ;

    }


    $('#no,#closeConfirmation').click(function(){

        $( "#toastTable" ).find( "#"+toastID ).css( "background", "white" );
        $('#confirmation').removeClass('is-visible');

    });

    $('#yes').click(function(){

        //var list = $input.tokenizer('get');
        //console.log(list[0]);

        $.ajax({
            url: 'http://192.168.43.169:8000/api/toast/delete',
            type: 'DELETE',
            dataType: "json",
            data:{
                'id' : toastID
            },

            success : function(data){
                if(data.response == true){

                    $('#'+toastID).closest('tr').remove();
                    $('#confirmation').removeClass('is-visible');

                }else{

                    alert('there is something wrong ');

                }
            },

            error: function(xhr, status, error) {
                alert(error);
            }
        });
    });

</script>

<!-- update a toast -->
<script>

    function getToastInformation(id){

        $.ajax({
            url: 'http://192.168.43.169:8000/api/toast/update/'+id,
            type: 'GET',
            dataType: "json",

            success : function(data){

                //$('#toastFormUpdate').find("input[type=text], textarea").prop("disabled", true);
                var toastInformation = data.toastInformation;
                $('#keywordsUpdate').tokenizer('empty');

                $.each(toastInformation, function(key,information){

                    $('#domainUpdate').val(information.specialties.domains.domain);
                    $('#specialtyUpdate').val(information.specialties.specialty);
                    $('#linkUpdate').val(information.link);
                    $('#toastUpdate').val(information.text);
                    $('#titleUpdate').val(information.title);
                    $('#toastIdentifier').val(information.id);
                    $("#"+information.difficulty).prop("checked", true);

                    $.each(information.keywords, function(key,keyword) {

                        $("#keywordsUpdate").tokenizer('push', keyword.keyword);

                    });

                });
            },

            error: function(xhr, status, error) {
                alert(error);
            }
        });

    }

    $('#commitToastUpdate').click(function(){

        var bootstrapValidator = $("#toastFormUpdate").data('bootstrapValidator');
        bootstrapValidator.validate();
        if(bootstrapValidator.isValid()){

            var list = $('#keywordsUpdate').tokenizer('get');
            //console.log(list[0]);

            $.ajax({
                url: 'http://192.168.43.169:8000/api/toast/update/'+$('#toastIdentifier').val(),
                type: 'PUT',
                dataType: "json",
                data:{
                    'difficulty' : $('input[name=difficultyUpdate]:checked').val(),
                    'toast' : $('#toastUpdate').val(),
                    'link' : $('#linkUpdate').val(),
                    'keywords' : list,
                    'title' : $('#titleUpdate').val()
                },

                success : function(data){
                    if(data.response == 'ok'){

                        location.href = "http://192.168.43.169:8000/api/toast";
                    }else{

                        alert(data.response);

                    }
                },

                error: function(xhr, status, error) {
                    alert(error);
                }
            });

        }
    });

    $('#cancelUpdate').click(function(){
        $('#toastFormUpdate').find("input[type=text], textarea").val("");
        $('#keywordsUpdate').tokenizer('empty');
    });

</script>

</body>
</html>                            