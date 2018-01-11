@extends('msg.layouts.layout')
@section('content')
<div id="content">      

            <form action='{{url("msg/rmsg/$rmsg[id]")}}' method="post" class="mform">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="msg_id" value="{{$msg_id}}">
                <fieldset>
                    @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                    <p>{{$msg or ''}}</p>
                    <legend>修改我的回帖</legend>
                    
                    <div style="text-align: center;">   
                    
                        <table align="center">                          
                            <tbody><tr>
                                <td>主题：</td>
                                <td>
                                    <input style="width: 400px;" disabled="disabled" value="回复：{{$msg_title}}" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">正文：</td>
                                <td>
                                    <textarea name="content" style="width: 400px; height: 400px;">{{$rmsg['rmsg_content']}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input name="submit" value="发表帖子" type="submit">
                                </td>
                            </tr>
                        </tbody></table>

                    </div>
                </fieldset>

            </form>

        </div>
        @endsection