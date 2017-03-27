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
            //var url ="http://localhost/weitan2/public/EnergyStore";
            //var url ="http://localhost/weitan2/public/EnergyStore/tagerror";
            //var url ="http://localhost/weitan2/public/helper/uploadimage";
            var url ="http://localhost/weitan2/public/EnergyStore/analysis";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }

//            $.get(url,{
//                type : '烟煤',
//                from : '2017-03-10',
//                to : '2017-03-13'
//            });

//            $.post(url,{
//                "id":1,
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                'storedate':'2017-03-11',
//                'type':'烟煤',
//                'batchno':'L005',
//                'number' : '123',
//                '_token' : window.Laravel.csrfToken
//            });

            $.get(url,{
               'energy_store_id' : 1
            });

//                $.post(url,{
//                    'energy_store_id' : 1, //入厂数据ID
//                    'device' : '分析仪', //设备
//                    'method' : '抽样测量法', //分析方法
//                    'dwfrl' : 50.179, //低位发热量
//                    'dwrlhtl': 0.0172, //单位热值含碳量
//                    'tyhl' : 0.98,//碳氧化率
//                    '_token' : window.Laravel.csrfToken
//                });
        }

    </script>
@endsection
