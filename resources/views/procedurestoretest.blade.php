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
            //var url ="http://localhost/weitan2/public/Procedure";
            //var url ="http://localhost/weitan2/public/Procedure/4/delete";
            //var url ="http://localhost/weitan2/public/Procedure/5/change";
            //var url ="http://localhost/weitan2/public/Procedure/1/tagerror";
            var url ="http://localhost/weitan2/public/Procedure/1/analysis";
            //var url ="http://localhost/weitan2/public/Procedure/1/analysis/1/tagerror";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }

//            $.get(url,{
//                page : 1,
//                type : '烟煤',
//                from : '2017-03-10',
//                to : '2017-03-13'
//            });

//            $.get(url,{
//                "id":3
//            });

//            $.post(url,{
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                'storedate':'2017-03-11',
//                'type':'烟煤',
//                'batchno':'L023',
//                'number' : 123,
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                'storedate':'2017-03-11',
//                'type':'无烟煤',
//                'batchno':'forchange',
//                'number' : '123',
//                '_token' : window.Laravel.csrfToken
//            });

//            $.get(url,{
//               'energy_store_id' : 1
//            });

//                $.post(url,{
//                    'device' : '分析仪', //设备
//                    'method' : '抽样测量法', //分析方法
//                    'data' : [{
//                        'pfyz': 0.405, //排放因子
//                    },{
//                        'pfyz': 0.407, //排放因子
//                    }],
//
//                    '_token' : window.Laravel.csrfToken
//                });

//            $.post(url,{
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });
        }

    </script>
@endsection
