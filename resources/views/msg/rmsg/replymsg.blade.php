@extends('msg.layouts.layout')
@section('content')
<div id="content">      

            <form action="{{url('msg/rmsg/store')}}" method="post" class="mform">
                <input type="hidden" name="msg_id" value='{{$msg_id}}'>
            {{csrf_field()}}
                <fieldset>
                    <legend>回复楼主的帖子</legend>
                    
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
                                    <textarea name="rmsg_content" style="width: 400px; height: 400px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input value="发表帖子" type="submit">
                                </td>
                            </tr>
                        </tbody></table>

                    </div>
                </fieldset>

            </form>

        </div>
        @endsection