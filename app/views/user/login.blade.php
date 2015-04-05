@extends('user.layout.default')
@section('header')
<script>
    function loginForm1()
    {
        var form = $('#loginForm1');
        document.getElementById('submitButton').style.display = 'none';
        document.getElementById('falseButton').style.display = '';
        $.ajax({
            type : 'POST',
            url : form.attr('action'),
            data : form.serialize(),
            success : function(data){
                if(data['status'] == 'SUCCESS')
                    window.location ='../user/home';
                else
                {
                    $('#errorMsg').empty().append('Invalid login credentials.')
                    setTimeout(function(){$('#errorMsg').empty();},4000);
                    document.getElementById('submitButton').style.display = '';
                    document.getElementById('falseButton').style.display = 'none';
                }
            }
        });
    }

    $(document).keypress(function(e) {
        if(e.which == 13) {
            if(document.getElementById('username1').value.length != 0 || document.getElementById('password1').value.length != 0)
                loginForm1();
        }
    });

</script>
@stop

@section('content')
<div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #7F8C8D">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color: #34495E; margin-top: 140px; padding: 10px;  border-radius: 10px;">
        <div class="col-md-1"></div>
        <div class="col-md-10" style="margin-top: 20px;">
            <form id="loginForm1" method="POST" action="/userLogin">
                <!--<center><img src="images/skopic.png" style="width:250px; margin: 5px; margin-bottom: 40px;"></center> -->
                <div class="input-group">
                    <span class="input-group-addon" style="padding-right: 6px;
                    padding-left: 15px;">Username</span>
                    <input type="text" id="username1" name="username1" class="form-control" >
                </div>
                <div class="input-group" style="margin-top: 15px;">
                    <span class="input-group-addon" >Password</span>
                    <input type="password" id="password1" name="password1" class="form-control" >
                </div>
            </form>
            <button id="submitButton" name="submitButton" onclick="loginForm1()" type="button" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 30px;">
                Login
            </button>
             <button id="falseButton" class="btn btn-primary" disabled style="display: none; margin-top: 20px; margin-bottom: 30px;">Logging In... <span class="ion-refreshing"></span></button>
            <label style="margin-left: 30px; color: indianred;" id="errorMsg"></label>

        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="col-md-4"></div>
</div>
@stop