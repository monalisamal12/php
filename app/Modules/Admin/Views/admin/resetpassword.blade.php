{{--/**--}}
{{--* Created by Monali Samal.--}}
{{--* User: Monali Samal <monalisamal@globussoft.in>--}}
{{--* Date: 2/22/2018--}}
{{--* Time: 3:50 PM--}}
{{--*/--}}



        <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content=""/>
    <title></title>
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/images/favicone.png"/>
    <link rel="icon" type="image/png" href="/assets/images/favicone.png"/>
    <link rel="stylesheet" href="/assets/css/Loginstyle.css">

    <style>
        .check {
            color: #999;
            font-size: 15px;
            position: relative;

        }

        .check pre {
            position: relative;
            padding-left: 30px;
            font-family: "Roboto", sans-serif;
        }

        .check pre:after {
            content: '';
            width: 18px;
            height: 18px;
            border: 2px solid #fff;
            position: absolute;
            left: 0;
            top: -2px;
            border-radius: 0%;
            box-sizing: border-box;
            -ms-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        .check input[type="checkbox"] {
            cursor: pointer;
            position: absolute;
            width: 50%;
            height: 100%;
            z-index: 1;
            opacity: 0;
            filter: alpha(opacity=0);
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
        }

        .check input[type="checkbox"]:checked + pre {
            /*       */
        }

        .check input[type="checkbox"]:checked + pre:before {
            content: '';
            width: 9px;
            height: 4px;
            position: absolute;
            border: 2px solid #fff;
            border-top-width: 2px;
            border-right-width: 2px;
            border-top-style: solid;
            border-right-style: solid;
            border-top-color: rgb(255, 255, 255);
            border-right-color: rgb(255, 255, 255);
            left: 4px;
            top: 3px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            border-top: none;
            border-right: none;
            background: transparent;

        }
        .alert.alert-danger {
            color: red;
        }
        .alert.alert-success {
            color:white;
        }

    </style>
</head>

<body>
<div class="login-page">
    <img src="/assets/images/logo.png" width="100%">
    <div class="form" style="margin-top: 10%;">

        </form>
        <form class="login-form acrylic" method="post">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <span style="background-color:transparent;color:white;font-size: 25px;">Reset Password</span>
            <input type="password" name="password" placeholder="Password" required><br>
            <a class="error">{{$errors->first('Password')}}</a><br>
            <input type="password" name="confirmpassword"  placeholder="confirmpassword"required><br>
            <a class="error">{{$errors->first('confirmpassword')}}</a><br>

            <div class="checkbox" style="text-align: left;color: #fff;margin-top: 4%;width: 50%;">
                <label class="check inline">
                    <input type="checkbox" name="optionenter" value="">
                    <pre style="color:#fff;font-size: 14px;">Remember Me</pre>
                </label>
            </div>
            <button id="SignIn" type="submit" value="submit" style="margin-top: 5%;">ResetPassword</button>

        </form>

        <form class="Forgot-form acrylic">

        </form>

    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<script>
    $('.message a').click(function () {
        $('form').animate({
            height: "toggle",
            opacity: "toggle"
        }, "slow");
    });


</script>


</body>

</html>