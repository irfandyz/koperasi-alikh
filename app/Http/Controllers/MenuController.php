<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\Tag;
class MenuController extends Controller
{
    public function manageMenu(){
        $tag = Tag::get();
        $menu = Menu::orderBy('sequence', 'asc')->get();
        $sub = Submenu::get();
        return view('admin.manageMenu.view',compact('tag','menu','sub'));
    }
    public function addSubmenu(request $request){
        $request->validate([
            'id'=>'required',
            'subName'=>'required',
            'subUrl'=>'required|unique:submenus,subUrl',
        ]);
        $submenu  = Submenu::where('menu_id',$request->id)->max('sequence');
        Submenu::create([
            'menu_id'=>$request->id,
            'subName'=>$request->subName,
            'subUrl'=>$request->subUrl,
            'sequence'=>$submenu+1,
        ]);
        return redirect()->back()->with('message','Submenu berhasil ditambah');
    }
    public function editSubmenu(request $request){
        $submenu  = Submenu::find($request->id);
        if($submenu->subUrl == $request->subUrl){
            $request->validate([
                'id'=>'required',
                'subName'=>'required',
                'subUrl'=>'required',
            ]);
        }else{
            $request->validate([
                'id'=>'required',
                'subName'=>'required',
                'subUrl'=>'required|unique:submenus,subUrl',
            ]);
        }
        Submenu::where('id',$request->id)->update([
            'subName'=>$request->subName,
            'subUrl'=>$request->subUrl,
        ]);
        return redirect()->back()->with('message','Submenu berhasil diubah');
    }
    public function deleteSubmenu($id){
        Submenu::find($id)->delete();
        return redirect()->back()->with('message','Submenu berhasil dihapus');
    }
    public function addMenu(request $request){
        if($request->type == 'on'){
            $request->validate([
                'tag'=>'required',
                'menuName'=>'required',
                'icon'=>'required',
                'type'=>'required',
                'menuUrl'=>'required|unique:submenus,subUrl|unique:menus,menuUrl',
            ]);
        }else{
            $request->validate([
                'tag'=>'required',
                'menuName'=>'required',
                'icon'=>'required',
                'type'=>'required',
            ]);
        }
        $menu  = Menu::where('tag_id',$request->tag)->max('sequence');
        Menu::create([
            'tag_id'=>$request->tag,
            'menuName'=>$request->menuName,
            'menuIcon'=>$request->icon,
            'sequence'=>$menu+1??'1',
            'main'=>$request->type,
            'menuUrl'=>$request->type=='on'?$request->menuUrl:null
        ]);
        return redirect()->back()->with('message','Menu berhasil ditambah');
    }
}
