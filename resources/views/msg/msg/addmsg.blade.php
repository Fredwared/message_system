@extends('msg.layouts.layout')
@section('content')
<div id="content">      

            <form action="{{url('msg/msg/store')}}" method="post" class="mform">
                {{csrf_field()}}
                <fieldset>
                    @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                    @endforeach
                    <p>{{$msg or ''}}</p>
                    <legend>您的新讨论话题</legend>
                    
                    <div style="text-align: center;">   
                    
                        <table align="center">                          
                            <tbody><tr>
                                <td>主题：</td>
                                <td>
                                    <input style="width: 400px;" name="title" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">正文：</td>
                                <td>
                                    <textarea name="content" style="width: 400px; height: 400px;"></textarea>
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