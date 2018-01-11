@extends('msg.layouts.layout')
@section('content')
        <div id="content">
            <div id="intro" class="generalbox box">
             
                
                <font size="+0" face="courier new">
                    欢迎大家来到我的留言板。<br>
                    您有什么问题或想法，请书写下您的笔墨。<br>                 
                    如果您有其他的想法......<br>
                    您可以在这里和大家一起交流和探讨。<br>
                    如果您还没有用户名，请<a href="{{url('/msg/user/register')}}">注册</a>一个用户名，体验更多精彩。<br>
                </font>
               
            </div>
        
            <div class="singlebutton forumaddnew">
            	
            	@if(session('user'))
                 <input type="submit" onclick="window.location.href='{{url("msg/msg/create")}}';" value="添加一个新讨论话题"/>
             	@else
             	<a href="{{url('msg/user/login')}}" style="font-size:20px; color:purple">请先登录才能发起新话题</a>
                @endif
            </div>

            <br>

            <table cellspacing="0" class="forumheaderlist">
                    
                <!-- 表头信息 -->
                <tbody><tr>
                    <th class="header topic" scope="col">留言</th>
                    <th class="header author" colspan="1">留言人</th>
                    <th class="header replies" scope="col">发表时间</th>
                    <th class="header lastpost" scope="col">操作</th>
                </tr>   
                
               @foreach($data as $k=>$v)
                <tr class="">
                    <td class="topic starter" width="40%"><a href='{{url("msg/msg/$v->id")}}'>{{$v->msg_title}}</a></td>
                    <td width="20%" style="line-height: 35px;">
                        <img class="userpicture" src="{{$userimage[$k]}}" height="35" width="35">
                        <span>{{$v->writer}}</span>
                    </td>
                    <td class="replies" width="20%">{{date('Y-m-d H:i:s', $v->create_time)}}</td>
                    <td class="lastpost" width="20%" style="text-align: center;">
                    	<!-- <span>{$Think.session.loginUser}</span><span>{$vo.username}</span> -->
                        @if(session('userid') == $v->writer)
                        	<a href='{{url("msg/msg/$v->id/edit")}}'>编辑</a>
                            <a href='javascript:;' id='deletemsg' onclick="del({{$v->id}})">删除</a>
                            <input type="hidden" name="" class="msgid" value="{{$v->id}}">
                    	@else
                    		<span>您不是发起会话的用户无法编辑</span>
                    	@endif

                    </td>
                </tr>  
                @endforeach

                </tbody>
            </table>
            <script>
                function del(id){
                    $.post('{{url("/msg/msg/")}}'+'/'+id,{'_token':"{{csrf_token()}}",'_method':'DELETE'},function(data){
                        if(data.status == 1){
                            alert("删除成功");
                           //header.location = "{{url('msg/msg')}}";
                            /*href.location = "{{url('msg/msg')}}";*/
                            window.location.reload();
                        }else{
                            alert("删除失败");
                            //header.location = "{{url('msg/msg')}}";
                            //window.location.reload();
                        }
                    });
                }
            
            </script>
            <!-- 显示分页码（开始） -->
            <div class="paging">
                {!! $data->links() !!}
            </div>
            <!-- 显示分页码（结束） -->

        </div>
        @endsection