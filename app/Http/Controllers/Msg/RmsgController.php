<?php

namespace App\Http\Controllers\Msg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Msg\Msg;
use App\Http\Models\Msg\RMsg;
use Validator;
class RmsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getRmsgbyMsgId($id){
        return Rmsg::where('msg_id',$id)->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $msg = Msg::where('id',$id)->value('msg_title');
        return view("msg.rmsg.replymsg")->with('msg_title',$msg)->with('msg_id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rules = ['rmsg_content'=>'required|max:300'];
        $messages = ['rmsg_content.required'=>'回复内容不能为空','rmsg_content.max'=>'回复内容太长'];
        $check = Validator::make($input, $rules, $messages);
        if($check->passes()){
            $input['create_time'] = time();
            $input['status'] = 1;
            $input['reply_from'] = session('userid');
            $rmsg = new Rmsg;
            $re = $rmsg->create($input);
            if($re){
                return redirect("msg/msg/".$input['msg_id']);
            }else{
                return back()->with('msg','回复失败');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rmsg = Rmsg::where('id',$id)->get()->toArray();
        $msg_id = $rmsg[0]['msg_id'];
        $msg_title = Msg::where('id',$msg_id)->value('msg_title');
        return view("msg.rmsg.editrmsg")->with('rmsg',$rmsg[0])->with('msg_title', $msg_title)->with('msg_id',$msg_id);
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
        //dd($request->all());
        $input = $request->except('_token','_method','submit');
        $rules = ['content'=>'required|max:300'];
        $messages = ['content.required'=>'内容不能为空','content.max'=>'内容太长'];
        $check = Validator::make($input, $rules, $messages);
        if($check->passes()){
            $data['rmsg_content'] = $input['content'];
            $rmsg = new Rmsg;
            //dd($input['msg_id']);
            $re = $rmsg->where('id',$id)->update($data);
            if($re){
                return redirect("/msg/msg/".$input['msg_id']);
            }else{
                return back()->with('msg','回复更新失败');
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
        $re = Rmsg::where('id',$id)->delete();
        if($re){
            $status = ['status'=>1];
        }else{
            $status = ['status'=>0];
        }
        return $status;
    }
}
