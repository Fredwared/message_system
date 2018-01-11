<?php

namespace App\Http\Controllers\Msg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Msg\Msg;
use App\Http\models\Msg\Rmsg;
use App\Http\models\Msg\User;
use Validator;
class MsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Msg::where('status',1)->orderBy('create_time','desc')->paginate(1);
        foreach($data as $v){
           $user[] = User::where('id',$v['writer'])->value('image');
        }
        //dd(session('user'));
        return view('msg.msg.index')->with('data', $data)->with('userimage',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('msg.msg.addmsg');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token','submit');
        $rules = ['title'=>'required|max:50','content'=>'required'];
        $messages = ['title.required'=>'标题不能为空','content.required'=>'内容不能为空'];
        $check = Validator::make($input, $rules, $messages);
        if($check->passes()){
            $data1['msg_title'] = $input['title'];
            $data1['msg_content'] = $input['content'];
            $data1['create_time'] = time();
            $data1['status'] = 1;
            $data1['writer'] = session('userid');
            $msg = new Msg;
            $re = $msg->create($data1);
            if($re){
                return redirect('msg/msg');
            }else{
                return back()->with('msg','添加失败');
            }
        }else{
            return back()->withErrors($check);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rmsg = Rmsg::where('msg_id',$id)->get()->toArray();
        //dd($rmsg);
        $msg = Msg::where('id',$id)->get()->toArray();
        $writer = User::where('id',$msg[0]['writer'])->value('username');
        $image = User::where('id',$msg[0]['writer'])->value('image');
        //$reply_from = User::where('id',$rmsg[0]['reply_from'])->value('username');
        foreach($rmsg as $k=>$v){
            $reply_from[$k] = User::where('id',$v['reply_from'])->value('username');
            $reply_image[] = User::where('id',$v['reply_from'])->value('image');
        }
        //dd($reply_from);
        $reply_image = isset($reply_image)?$reply_image:'';
        return view("msg.msg.viewmsg",compact('rmsg','reply_from'))->with('msg',$msg[0])->with('writer',$writer)->with('image',$image)->with('reply_image',$reply_image);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $data = Msg::where('id',$id)->get()->toArray();
        $info = $data[0];
        return view('msg.msg.editmsg')->with('data',$info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $raw = $request->all();
        $info = $request->except('_token','_method');
        $rules = ['title'=>'required|max:50','content'=>'required'];
        $messages = ['title.required'=>'标题不能为空','title.max'=>'标题太长','content.required'=>'内容不能为空'];
        $check = Validator::make($info,$rules,$messages);
        if($check->passes()){
            $data['msg_title'] = $info['title'];
            $data['msg_content'] = $info['content'];
            $re = Msg::where('id',$id)->update($data);
            if($re){
                return redirect('msg/msg');
            }else{
                return back()->with('msg','更新失败或数据与原数据相同');
            }
        }else{
            return back()->withErrors($check);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = new Msg;
        $re = Msg::destroy($id);
        if($re){
            $status = ['status'=>1];
        }else{
            $status = ['status'=>0];
        }
        return $status;
    }
}
