@extends('msg.layouts.layout')
@section('content')
<div id="content">
            <br>
            <!-- 主贴 -->
            <table cellspacing="0" class="forumpost">
                <tbody><tr class="header">
                    <td class="picture left">
                        <img src="{{$image}}" height="35" width="35">
                    </td>
                    <td class="topic starter">
                        <div class="subject">标题：{{$msg['msg_title']}}</div>
                        <div class="author">
                            由 {{$writer}}                          发表于 {{date("y-m-d H:i:s", $msg['create_time'])}}                     </div>
                    </td>                   
                </tr>
                <tr>
                    <td class="left side"></td>
                    <td class="content"> 
                        <div class="posting">                           
                            内容：{{$msg['msg_content']}}                                                                   <div class="commands">
                               @if(session('userid') == $msg['writer'])
                                    <span>您无法回复自己的主题</span>
                                     @elseif(empty(session('user')))
                                    <span>请先登录再回复</span>
                                   @else
                                    <!-- <a href="/rmsg/replymsg/msgid/{$msgid}/">回复</a> -->
                                    <a href='{{url("msg/rmsg/$msg[id]/create")}}'>回复</a>
                                
                               
                                @endif
    </div>                      </div>
                        
                    </td>
                </tr>

            </tbody></table> 
            <!-- 回帖列表 -->
           @foreach($rmsg as $k=>$v)
            <table cellspacing="0" class="forumpost" style="margin-left: 50px;">
    <tbody><tr class="header">
        <td class="picture left">
            <img src="{{$reply_image[$k]}}" height="35" width="35">
        </td>
        <td class="topic">
            <div class="subject">回复: </div>
            <div class="author">由 {{$reply_from[$k]}} 发表于 {{date('Y-m-d H:i:s',$v['create_time'])}}</div>
        </td>
    </tr>
    
    <tr>
        <td class="left side">&nbsp;</td>
        <td class="content"> 
            <div class="posting"> 
                {{$v['rmsg_content']}}                                <br><br>                        
            </div>
                            
            <div class="commands">
                @if(session('userid') == $v['reply_from'])
                <a href='{{url("msg/rmsg/$v[id]/edit")}}'>编辑</a> | 
                <a href="javascript:;" onclick="del({{$v['id']}})">删除</a>
               @else
                <span>您不能编辑这条回帖</span>
               @endif
            </div>  
                </td>
    </tr>
    <script>
        function del(id){
            $.post('{{url("msg/rmsg/")}}'+'/'+id,{'_token':"{{csrf_token()}}",'_method':'DELETE'},function(data){
                if(data.status == 1){
                    alert('删除成功');
                    window.location.reload();
                }else{
                    alert('删除失败');
                }
            })
        }
    </script>
</tbody></table>  
    @endforeach
            <!-- 回帖列表 -->
        </div>
@endsection