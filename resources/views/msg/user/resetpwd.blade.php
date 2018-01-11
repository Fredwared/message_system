@extends('msg.layouts.layout')
@section('content')
        <div class="loginbox clearfix twocolumns"> 
          <div class="loginpanel"> 
            <h2>请详细填写您的注册信息！</h2> 
              <div class="subcontent loginsub">         
                <form action="{{url('msg/user/resetpwd')}}" method="post" id="login"> 
                  {{csrf_field()}}
                  @foreach($errors->all() as $error)
                  <p>{{$error}}</p>
                  @endforeach
                  <p>{{$msg or ''}}</p>
                  <div class="loginform"> 
                    
                    <div class="clearer"></div> 
        
                    <div class="form-label">
                        <label for="password">旧密码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="password" name="old_password" id="password" size="15" value="" /> 
                      <br>
                     
                    </div> 
        
                     <div class="clearer"></div> 

                     <div class="form-label">
                        <label for="password">新密码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="password" name="password" id="password2" size="15" value="" /> 
                      <br>
                      
                    </div> 
        
                     <div class="clearer"></div> 
        
                     <div class="form-label">
                        <label for="password">再次确认新密码密码</label>
                    </div> 
                    <div class="form-input"> 
                      <input type="password" name="password_confirmation" id="password3" size="15" value="" /> 
                      <br>
                      
                    </div> 
        
                    <div class="clearer"></div> 

                   
                    <div class="clearer"></div> 
        
                    <div class="form-input"> 
                      <input type="submit" id="submit"  value="确定" /> 
                    </div> 
        
                    <div class="clearer"></div> 
                  </div> 
                </form> 
              </div> 
              
             </div> 
            <div class="signuppanel"> 
              <h2>密码格式</h2> 
              <div class="subcontent"> 
                <p>
                    
                    <b>密码和确认密码</b> <br> 
                    密码和确认密码必须相同，且至少6位<br>
                    
                </p>     
              </div> 
            </div> 
        </div> 
@endsection