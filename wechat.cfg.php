<?php
//存放配置信息
define('APPID', 'wxf0c69cd45759543a');
define('APPSECRET ', 'd80d9b5430d93e9d6dca8b14fd27fa66');




陈元元 16:42:46
<script type="text/javascript" language=JavaScript charset="UTF-8">
var len;
   function search(){
    
    var obj=document.getElementById('w');
    var pinyin=obj.value;
    
    $.get("{:U(ajax_get_title)}",{pinyin:pinyin},function(e){
        var str='';
       len=e.length;
        for (var i=0; i<len; i++) {
             var a=i+1;
        str+="<li id="+a+"><a>"+e[i].title+"</a></li>";
        }
        $("#xiala").html(str);
    },'json');
    if(pinyin==""){
        $('#xiala').css('display','none');
    }else{
        $('#xiala').css('display','block');

    }
   }

    var num=0;  
        function key(){
           
            document.onkeydown=function(event){
            var e = event || window.event || arguments.callee.caller.arguments[0];
            if(e && e.keyCode==40){ // 按 向下箭头 
                //要做的事情
                

                num=num+1;
                $("#"+num).css("background-color","red");
                $("#"+(num-1)).css("background-color","");
                if(num>len)
                {
                    num=0;
                }

             }
            if(e && e.keyCode==38){ // 按 上箭头 
                 //要做的事情
                 num=num-1;
                 $("#"+num).css("background-color","red");
                 $("#"+(num+1)).css("background-color","");
                 if(num==0)
                {
                    num=len+1;
                }
               }            
             if(e && e.keyCode==13){ // enter 键
                 //要做的事情
            }
        }; 
        }
</script>
陈元元 16:43:00
public function ajax_get_title(){
        $pinyin=I('get.pinyin');
         S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
            'expire'=>60)
        );
        
       
        $data = S("data$pinyin");

        if($data===false)
        {


                $pinyin=I('get.pinyin');
                if(preg_match('/[a-zA-Z]/',$pinyin)!=0)
                {if($pinyin!=''){
                $data=M('goods')->where("pinyin like '$pinyin%'")->select();
                foreach ($data as $key => $value) {
                    $data[$key]['title']=mb_substr($data[$key]['title'],0,20,'utf-8');
                }

                $this->ajaxReturn($data,'json');
                 S("data$pinyin", $data, 0);

            }
            }else{
                if($pinyin!='')
                {$data=M('goods')->where("title like '$pinyin%'")->select();
                foreach ($data as $key => $value) {
                    $data[$key]['title']=mb_substr($data[$key]['title'],0,20,'utf-8');
                }


                $this->ajaxReturn($data,'json');
                 S("data$pinyin", $data, 0);

            }
            }

    }
    $this->ajaxReturn($data,'json');

    }
