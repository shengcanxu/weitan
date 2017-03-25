@extends('layouts.app')

@section('content')
<div class="container">
    testing
    <input type="button" value="login" onclick="login()" />
</div>

    <script language="javascript">
        function login(){
            var pos = location.href.indexOf("?");
            var url ="http://localhost/weitan2/public/EnergyStore";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }
//            $.post(url,{
//                "id":1,
//                "error":true,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

            $.post(url,{
                'storedate':'2017-03-11',
                'type':'烟煤',
                'batchno':'L005',
                'number' : '123',
                '_token' : window.Laravel.csrfToken
            });
        }

    </script>
@endsection
