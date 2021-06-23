<?php

namespace App\Http\Controllers\Pengaturan;

use Validator;
use DataTables;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\MasterMenu;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.menu.index');
    }

    public function simpan(Request $request)
    {
        if($request->id != ''){
            $menu = MasterMenu::where('id',$request->id)->first();
			$menu->parent = $request->parent_menu;
            $menu->flag_active = 1;
            $menu->urutan = $request->urutan;
            $menu->label = $request->label;
            $menu->page_type = $request->type_page;

            if($request->type_page=='page')
            {
                $menu->link_custom = null;
                $menu->model_tabel = null;
                $menu->link_page = $request->link;
            }
            elseif($request->type_page=='custom')
            {
                $menu->link_page = null;
                $menu->link_custom = $request->link;
                $menu->model_tabel = null;
            }
            elseif($request->type_page=='model_tabel')
            {
                $menu->link_page = null;
                $menu->link_custom = null;
                $menu->model_tabel = $request->link;
            }
			$menu->save();

			$arr['type']  = 'edit';
			$arr['label'] = $request->label;
			$arr['link']  = $request->link;
			$arr['urutan']  = $request->urutan;
            $arr['parent_menu']  = $request->parent_menu;
            if($menu->link_page)
                $arr['type_page']='page';
            
            elseif($menu->link_custom)
                $arr['type_page']='custom';
            
            $arr['id']    = $request->id;
            
		}else{
			
			$menu = new MasterMenu;
            $menu->parent = $request->parent_menu;
            $menu->flag_active = 1;
            $menu->urutan = $request->urutan;
            $menu->label = $request->label;
            $menu->page_type = $request->type_page;
            
            if($request->type_page=='page')
            {
                $link = $menu->link_page = $request->link;

            }
            elseif($request->type_page=='custom')
            {
                $link = $menu->link_custom = $request->link;

            }
            elseif($request->type_page=='model_tabel')
            {
                $link = $menu->model_tabel = $request->link;;
            } 
            $menu->save();
            
			$id = $menu->id;

            $parent = '';
            if($menu->parent!=0)
                $parent = '<ol class="child" id="menu-id">';

			$parent .= '<li class="dd-item dd3-item" data-id="'.$id.'" style="margin-left:'.($menu->parent * 5).'px">
							<div class="dd-handle dd3-handle" style="background: #dd4b39;border: 1px solid #605ca8;border-radius: 0px;"></div>
							<div class="dd3-content" style="background: #9575cd4d;border-radius: 1px;border: 1px solid #605ca8;"><span id="label_show'.$id.'">'.$request->label.'</span>
                                <span class="span-right"><span id="link_show'.$menu->id.'"> <a style="font-weight: bold" href="'.$link.'"> 
                                Action : &nbsp; 
                                    <a class="add-button text-info"  label="" link="" type_page="" parent_menu_id="'.$menu->id.'" parent_menu="'.$menu->label.'" urutan="'.$menu->urutan.'"><i class="fa fa-plus-square"></i></a> 
                                    &nbsp;
                                    <a style="color: #f39c12" class="edit-button" id="'.$id.'" label="'.$request->label.'" link="'.$link.'" type_page="'.($menu->link_custom !=null ? 'custom' : 'page').'" parent_menu="'.$menu->parent.'" urutan="'.$menu->urutan.'" ><i class="fa fa-pencil"></i></a> 
									<a class="del-button" id="'.$id.'"><i class="fa fa-trash"></i></a>
								</span> 
                            </div>
                        </li>';

            if($menu->parent!=0)
                $parent .= '</ol>';

            $arr['menu'] = $parent;

			$arr['type'] = 'add';
		}
		// return json_encode($arr);
		return $arr;
    }

    


    public function data($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json($data);
    }

    public function hapus(Request $request)
    {
        $this->recursiveDelete($request->id);
    }

    function recursiveDelete($id) {
		$query 	= MasterMenu::where('parent', $id)->get();
		// $query2 = $this->db->select('count(*) as total')->where('parent', $id)->get('master_menu')->result();
		if ($query->count() != 0) {
			foreach($query as $current){
				$this->recursiveDelete($current->id);
			}
        }
        $get = MasterMenu::where('id', $id)->first()->delete();
	}

}