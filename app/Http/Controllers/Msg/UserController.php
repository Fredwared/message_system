<?php

namespace App\Http\Controllers\Msg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Msg\User;
use Crypt;
use Validator;
use Captcha;
class UserController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('get')){
    		return view('msg.user.login');
    	}else if($request->isMethod('post')){
    		$rules = ['username'=>'required|min:6','password'=>'required|min:6'];
    		$messages = ['username.min'=>'用户名长度不够','password.min'=>'密码长度不够'];
    		$input = $request->except('_token','login');
    		$check = Validator::make($input, $rules, $messages);
    		if($check->passes()){
    			$user = User::where('username',$input['username'])->get()->toArray();
                
    			$db_pwd = $user[0]['password'];
    			if($input['password'] == Crypt::decrypt($db_pwd)){
                   // $data = ['user'=>$user[0]['username'],'userid'=>$user[0]['id']];
                    //$request->session()->put('usersignedin',$data);
                    session(['user'=>$user[0]['username'],'userid'=>$user[0]['id']]);
                    //dd($request->session()->all());
                    
    				return redirect('/msg/msg');
    			}else{
    				return back()->with('msg','登录失败');
    			}
    		}else{
    			return back()->withErrors($check);
    		}
    		
    	}
    	
    }
    public function register(Request $request){
    	if($request->isMethod('get')){
    		return view('msg.user.register');
    	}else if($request->isMethod('post')){
    		$input = $request->all();
    		$rules = ['username'=>'required|min:6','password'=>'confirmed|min:6','email'=>'required|email|unique:user,email','captcha'=>'required|captcha'];
    		$messages = ['username.min'=>'用户名长度不够','password.confirmed'=>'密码确认错误','password.min'=>'密码长度不够','email.email'=>'邮箱格式不对','email.unique'=>'邮箱已被注册','captcha.required'=>'验证码不能为空','captcha.captcha'=>'验证码错误'];
    		$check = Validator::make($input, $rules, $messages);
    		if($check->passes()){
    			$data = $request->except('_token','register','captcha','password2','password_confirmation');
    			$data['password'] = Crypt::encrypt($data['password']);
    			$user = new User;
    			$re = $user->create($data);
    			if($re){
    				return redirect('msg/user/login')->with('msg','注册成功请登录');
    			}else{
    				return back()->with('msg','注册失败请重新注册');
    			}
    		}else{
    			return back()->withErrors($check);
    		}
    	
    		//dd($data);
    	}
    	
    }
    public function resetpwd(Request $request){
        if($request->isMethod('get')){
            return view('msg.user.resetpwd');
        }else if($request->isMethod('post')){
          $input = $request->all();
          //dd($input);
            $rules = ['old_password'=>'required|min:6','password'=>'confirmed|min:6'];
            $messages = ['old_password.min'=>'旧密码长度不够','password.confirmed'=>'密码确认错误','password.min'=>'新密码长度不够'];
            $check = Validator::make($input, $rules, $messages);
            if($check->passes()){
                $data = $request->except('_token','password_confirmation');
                $user = User::where('username',$request->session()->get('user'))->get()->toArray();
                $db_pwd = $user[0]['password'];
                if($data['old_password'] === Crypt::decrypt($db_pwd)){
                    $tmp['password'] = Crypt::encrypt($data['password']);
                    $re = User::where('username',$request->session()->get('user'))->update($tmp);
                    if($re){
                        return redirect('msg/msg');
                    }else{
                        return back()->with('msg','修改失败');
                    }
                }
                
            }else{
                return back()->withErrors($check);
            } 
        }
    	
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('msg/msg');
    }

    public function captcha(){
        return Captcha::create();
    }
}
