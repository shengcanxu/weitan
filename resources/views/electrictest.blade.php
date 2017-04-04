@extends('layouts.app')

@section('content')
<div class="container">
    testing
    <input type="button" value="login" onclick="login()" />

    <form action="http://localhost/weitan2/public/helper/uploadimage" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" name="image" />
        <input name="test" type="text" />
        <input type="submit" />
    </form>
</div>

    <script language="javascript">
        function login(){
            var pos = location.href.indexOf("?");
            //var url ="http://localhost/weitan2/public/Electricinner";
            //var url ="http://localhost/weitan2/public/Electricinner/1/delete";
            //var url ="http://localhost/weitan2/public/Electricinner/1/change";
            //var url ="http://localhost/weitan2/public/Electricinner/1/tagerror";
            //var url ="http://localhost/weitan2/public/Electricouter";
            //var url ="http://localhost/weitan2/public/Electricouter/1/delete";
            //var url ="http://localhost/weitan2/public/Electricouter/1/change";
            //var url ="http://localhost/weitan2/public/Electricouter/1/tagerror";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }

//            $.post(url,{
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

            $.post(url,{
                'month':'2017-03-01',
                'producetype':'纸浆制造',
                'devicename':'电表1',
                'lastnumber' : 38,
                'currentnumber' : 102,
                'times' : 3.0,
                '_token' : window.Laravel.csrfToken
            });


            //外部证明

//            $.post(url,{
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                'month':'2017-03-01',
//                'datasource':'发票',
//                'temperature' : 38,
//                'pressure' : 102,
//                'heatquality' : 78.9,
//                'enthalpy' : 0,
//                'heatusage' : 200,
//                '_token' : window.Laravel.csrfToken
//            });


        }

    </script>
@endsection
