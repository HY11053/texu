<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRegsiterRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
    /**
     * 前台用户列表
     * @param
     *
     * @return
     */
    function Index()
    {
        $userlists=User::all();
        return view('admin.userlist',compact('userlists'));
    }
    /**
     * 前台用户添加
     * @param
     *
     * @return
     */
    function UserAdd(){
        echo '后台暂时不注册用户!，请从前台注册';
    }

    /**
     * 前台用户编辑
     * @param
     *
     * @return
     */

    function UserEdit($id)
    {
        $User=User::find($id);
        return view('admin.useredit',compact('User'));

    }

    /**
     * 前台会员用户编辑处理
     * @param
     *
     * @return
     */
    function PostUserEdit(UserRegsiterRequest $request,$id)
    {
        User::find($id)->update($request->all());
        return redirect(action('Admin\FrontUserController@Index'));
    }

    /**
     * 前台会员删除
     * @param
     *
     * @return
     */

    function UserDelete($id)
    {
        User::find($id)->delete();
        return redirect(action('Admin\FrontUserController@Index'));
    }
}
