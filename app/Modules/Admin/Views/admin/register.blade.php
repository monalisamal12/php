
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif
<html>
<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<meta charset="UTF-8">
<style>
    table{
        border-collapse:collapse;
        width: 100%;
    }
    table,th,td{

        border: 2px solid black;

    }
    th {
        background-color: #64af32;
        color: white;
    }
</style>
<center>
    <br><h1 style="color: #31b0d5">Regd page </h1>
    <form action="/admin/register" method="post"><br><br>
        {{ csrf_field() }}
        <td>
            <tr>
                <td>Full_Name:</td>
            </tr>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="text" name="firstname" placeholder="Enter Your firstname" align="center"value="{!! old('firstname') !!}">
            <span class="error">{{$errors->first('firstname')}}</span><br>

        <td>LastName:</td>
        <input type="text" name="lastname" placeholder="Enter Your lastname" align="center"value="{!! old('lastname') !!}">
        <span class="error">{{$errors->first('lastname')}}</span><br>

       
        <td>Email:</td>
        <input type="text" name="email" placeholder="Enter Your Email" value="{!! old('email') !!}"required>
        <span class="error">{{$errors->first('email')}}</span><br>

        <td>DOB:</td>

        <input type="text" name="DOB" placeholder="Enter Your DOB" align="center"value="{!! old('DOB') !!}">
        <span class="error">{{$errors->first('DOB')}}</span><br>

        <td>address</td>
        <input type="text" name="address" placeholder="Enter Your address" align="center"value="{!! old('address') !!}">
        <span class="error">{{$errors->first('address')}}</span><br>

        <td>Password</td>
        <input type="password" name="password"   placeholder="Enter Your Password" value="{!! old('password') !!}">
        <span class="error">{{$errors->first('password')}}</span><br>

        <button type="submit"  style="color: #286090" class="btn btn-success ">SIGNUP</button><br><br>
        </td>
     
        <a href="{{env('APP_URL')}}//"style="color: #31b0d5">Back to home page</a><br><br>

    </form>
</center>

</body>
</html>






