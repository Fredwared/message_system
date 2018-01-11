@extends('msg.layouts.layout')
@section('content')
<div id="content">      
            <!-- 注意form标签的action属性 -->
          <!--  <form action="/home/msgs/editmsg/msgid/{$msg.id}/" method="post" class="mform"> -->
            
            <form action='{{url("msg/msg/$data[id]")}}' method="post" class="mform">
                {{csrf_field()}}
                @foreach($errors->all() as $error)
                  <p>{{$error}}</p>
                  @endforeach
                  <p>{{$msg or ''}}</p>
               <input type="hidden" name="_method" value="PUT">

                <fieldset>
                    <legend>您的新讨论话题</legend>
                    <div style="text-align: center;">   
                        <table align="center">                          
                            <tbody><tr>
                                <td>主题：</td>
                                <td>
                                    <input style="width: 400px;" value="{{$data['msg_title']}}" type="text" name="title">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">正文：</td>
                                <td>
                                    <textarea name="content" style="width: 400px; height: 400px;">{{$data['msg_content']}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input  value="更新留言" type="submit">
                                </td>
                            </tr>
                        </tbody></table>

                    </div>
                </fieldset>
            </form>
        </div>
        @endsection