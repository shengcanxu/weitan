@extends('layouts.app')

@section('content')
<div class="container">
    testing
    <input type="button" value="login" onclick="login()" />
</div>

    <script language="javascript">
        function login(){
            var pos = location.href.indexOf("?");
            var url ="http://localhost/weitan2/public/login";
            if(pos > 0){
                url = url + param;    
            }
            $.post(url,{phone:"18565129949",password:"123456",_token:window.Laravel.csrfToken});
        }

    </script>
@endsection
