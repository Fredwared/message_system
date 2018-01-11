@extends('msg.layouts.layout')
@section('content')
        <div class="loginbox clearfix twocolumns"> 
          <div class="loginpanel"> 
            <h2>请详细填写您的注册信息！</h2> 
              <div class="subcontent loginsub">         
                <form action="{{url('msg/user/register')}}" method="post" id="login"> 
                  {{csrf_field()}}
                  @foreach($errors->all() as $error)
                  <p>{{$error}}</p>
                  @endforeach
                  <p>{{$msg or ''}}</p>
                  <div class="loginform"> 
                    <div class="form-label">
                        <label for="username">用户名</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="text" name="username" id="username" size="15" value="" />
                      <br>
                      <span id="userTip" class="errorTip"></span> 
                    </div> 
        
                    <div class="clearer"></div> 
        
                    <div class="form-label">
                        <label for="password">密码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="password" name="password" id="password" size="15" value="" /> 
                      <br>
                      <span id="pswdTip" class="errorTip"></span>
                    </div> 
        
                     <div class="clearer"></div> 
        
                     <div class="form-label">
                        <label for="password">确认密码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="password" name="password_confirmation" id="password2" size="15" value="" /> 
                      <br>
                      <span id="pswd2Tip" class="errorTip"></span>
                    </div> 

                     <div class="form-label">
                        <label for="password">邮箱</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="email" name="email"  size="15" value="" /> 
                      <br>
                      <span id="emailTip" class="errorTip"></span>
                    </div> 
        
                    <div class="clearer"></div> 
        
                     <div class="form-label">
                        <label for="password">选择头像</label>
                    </div> 
                    <div style="margin-left: 235px"> 
                        <img src="/images/0.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/0.gif">                       <img src="/images/1.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/1.gif">                       <img src="/images/2.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/2.gif">                       <img src="/images/3.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/3.gif">                       <img src="/images/4.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/4.gif">                       <img src="/images/5.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/5.gif">                       <img src="/images/6.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/6.gif">                       <img src="/images/7.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/7.gif">                       <img src="/images/8.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/8.gif">                       <img src="/images/9.gif" width="30px" height="30px">
                        <input type="radio" name="image" id="image" value="/images/9.gif">                    </div> 
                    
                    <div class="clearer"></div> 
        
                     <div class="form-label">
                        <label for="captcha">验证码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="text" name="captcha" id="captcha" size="15" value="" />
                      <img src="{{url('msg/user/captcha')}}" id="captchaImg" style="cursor: pointer; width: 120px; height: 40px;position:relative;top:10px" onclick="changeCaptcha()">
                      <br>
                      <span id="captchaTip" class="errorTip"></span>
                    </div> 
                    <script>
                      function changeCaptcha(){
                        $("#captchaImg").attr('src','{{url("msg/user/captcha")}}'+'?'+Math.random());
                      }
                    </script>
                    <div class="clearer"></div> 
        
                    <div class="form-input"> 
                      <input type="submit" id="submit" name="register" value="注册" /> 
                    </div> 
        
                    <div class="clearer"></div> 
                  </div> 
                </form> 
              </div> 
              
             </div> 
            <div class="signuppanel"> 
              <h2>注册帮助</h2> 
              <div class="subcontent"> 
                <p>
                    <b>1 用户名</b> <br> 
                    用户名必须是字母、数字或下划线，且必须以字母开头（至少6位）<br>
                    <b>2 密码和确认密码</b> <br> 
                    密码和确认密码必须相同，且至少6位<br>
                    <b>3 验证码</b> <br> 
                    验证码不区分大小写<br>
                </p>     
              </div> 
            </div> 
        </div> 
@endsection