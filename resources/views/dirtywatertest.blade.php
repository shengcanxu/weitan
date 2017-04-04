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
            //var url ="http://localhost/weitan2/public/Dirtywater";
            //var url ="http://localhost/weitan2/public/Dirtywater/1/delete";
            //var url ="http://localhost/weitan2/public/Dirtywater/1/change";
            var url ="http://localhost/weitan2/public/Dirtywater/1/tagerror";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }

            $.post(url,{
                "error":1,
                "message":"错误描述",
                '_token' : window.Laravel.csrfToken
            });

//            $.post(url,{
//                'date':'2017-03-01',
//                'mount' : 38,
//                'incod' : 102,
//                'outcod' : 78.9,
//                'kgcod' : 20,
//                'kgch4' : 300,
//                'jwxzyz' :0.5,
//                '_token' : window.Laravel.csrfToken
//            });



        }

    </script>
@endsection
