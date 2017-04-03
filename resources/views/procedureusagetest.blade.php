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
            //var url ="http://localhost/weitan2/public/ProcedureUsage";
            //var url ="http://localhost/weitan2/public/ProcedureUsage/1/delete";
            //var url ="http://localhost/weitan2/public/ProcedureUsage/1/change";
            //var url ="http://localhost/weitan2/public/ProcedureUsage/2/tagerror";
            //var url ="http://localhost/weitan2/public/ProcedureUsage/2/analysis";
            var url ="http://localhost/weitan2/public/ProcedureUsage/1/analysis/1/tagerror";
            //var url = "http://localhost/weitan2/public/ProcedureUsage/calculateCO2";
            //var url = "http://localhost/weitan2/public/ProcedureUsage/calculateCO2/2017-01-11";
            //var url ="http://localhost/weitan2/public/ProcedureUsage/CO2output";
            if(pos > 0){
                url = url + location.href.substr(pos);
            }

//            $.get(url,{
//                page : 1,
//                type : '石灰石',
//                from : '2017-01-01',
//                to : '2017-03-13'
//            });

//            $.post(url,{
//                'usagedate':'2017-03-11',
//                'store_id':1,
//                'number' : 2,
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                "error":1,
//                "message":"错误描述",
//                '_token' : window.Laravel.csrfToken
//            });

//            $.post(url,{
//                'usagedate':'2017-03-11',
//                'store_id' : 1,
//                'number' : '1',
//                '_token' : window.Laravel.csrfToken
//            });

//            $.get(url,{
//               'energy_store_id' : 1
//            });

//                $.post(url,{
//                    'device' : '分析仪', //设备
//                    'method' : '抽样测量法', //分析方法
//                    'data' : [{
//                        'pfyz': 0.468, //排放因子
//                    },{
//                        'pfyz': 0.466, //排放因子
//                    }],
//
//                    '_token' : window.Laravel.csrfToken
//                });

            $.post(url,{
                "error":1,
                "message":"错误描述",
                '_token' : window.Laravel.csrfToken
            });
        }

    </script>
@endsection
