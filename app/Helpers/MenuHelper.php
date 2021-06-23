<?php
namespace App\Helpers;
use DB;
use Str;
use Ramsey\Uuid\Uuid;
use App\Models\MasterMenu;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

class MenuHelper{
    
    public static function menu($parent = null,$hasil){
        $w = MasterMenu::where('parent',$parent)
                    ->orderBy('urutan')
                    ->get();
		$no = 1; 

        $path = request()->path();
        if(request()->path() == '/' || request()->path()=='home')
            $path = 'beranda';

		foreach($w as $h){

                $cek_anak = MasterMenu::where('master_menu.parent','=',$h->id)
                                ->where('flag_active',1)
                                ->count();
                                
                $active = (strpos($path,Str::slug($h->label))!==false ? 'current-menu-item' : '');
				// -- Jika hasilnya nya 0 dan tidak ada anak 
                if($parent == 0 and $cek_anak > 1)
                {
                    $hasil .= '<li class="menu-item-has-children '.($active).'">
                                <a href="javascript:void(0);">
                                    '.$h->label.'
                                </a>
                                    <ul class="sub-menu">';
                }
                elseif($cek_anak > 0)
                {
                    $hasil .= '<li class="menu-item '.($active ).'">
                                <a href="javascript:void(0);" >
                                    '.$h->label.'
                                </a>
                                    <ul class="sub-menu">';
                }
                else
                {
                    
                    if($h->page_type == 'page')
                    {
                        $hasil .= '<li class=" '.($active).'">
                                        <a href="'.url($h->link_page).'">'.$h->label.'</a> 
                                    </li> ';
                    }
                    elseif($h->page_type == 'custom')
                    {
                        $hasil .= '<li class=" '.($active).'"> 
                                        <a href="'.$h->link_custom.'">'.$h->label.'</a> 
                                    </li> ';
                    }
                    // else
                    // {
                    //     $hasil .= '<li> 
                    //                     <a href="#">'.$h->label.'</a> 
                    //                 </li> ';
                    // }
                    elseif($h->page_type == 'model_tabel')
                    {
                        $hasil .= '<li class="menu-item-has-children '.($active ).'">
                                <a href="javascript:void(0);" >
                                    '.$h->label.'
                                </a>
                                    <ul class="sub-menu">';
                                        $sublevel = DB::table($h->model_tabel)->get();
                                        foreach($sublevel as $id_sub => $val_sub)
                                        {
                                            $hasil .= '<li classs="menu-item"> 
                                                            <a href="'.url(Str::slug($h->label).'/'.$val_sub->id.'-'.Str::slug($val_sub->judul)).'">'.ucwords(strtolower($val_sub->judul)).'</a> 
                                                        </li> ';
                                        }
                        $hasil.='</ul>';
                        $hasil.='</li>';
                    }
							
						
				}

				$hasil = self::menu($h->id,$hasil);
                if($parent  == 0 and $cek_anak > 1)
                {
					$hasil .= '</ul></li>';
                }
                elseif($cek_anak > 0){
					$hasil .= '</ul></li>';
                }
                else
                {
					$hasil .= '</li>';
				}
		
				$no++; 
		}

		return $hasil;
    }
    
    
   
    public static function get_menu($items, $class = 'dd-list') {

        $html = "<ol class=\"".$class."\" id=\"menu-id\">";
        $no = 0;
        foreach($items as $key=>$value) {
            $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" style="margin-left:'.($value['parent'] * 5).'px">
                        <div class="dd-handle dd3-handle" style="background: #dd4b39;border: 1px solid #605ca8;border-radius: 0px;"></div>
                        <div class="dd3-content" style="background: #fff;border-radius: 1px;border: 1px solid #605ca8;"><span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                            <span class="span-right"><span id="link_show'.$value['id'].'"> <a style="font-weight: bold" href="'.$value['link_page'].'"> 
                                Action : &nbsp; 
                                <a class="add-button text-info"  label="" link="" type_page="" parent_menu_id="'.$value['id'].'" parent_menu="'.$value['label'].'" urutan="'.$value['urutan'].'"><i class="fa fa-plus-square"></i></a> 
                                &nbsp;
                                <a style="color: #f39c12" class="edit-button" id="'.$value['id'].'" label="'.$value['label'].'" link="'.($value['link_custom']!=null ? $value['link_custom'] : $value['link_page']).'" type_page="'.($value['link_custom']!=null ? 'custom' : 'page').'" parent_menu="'.$value['parent'].'"  urutan="'.$value['urutan'].'" ><i class="fa fa-pencil"></i></a> 
                                &nbsp;
                                <a style="color: red" class=" del-button" id="'.$value['id'].'"><i class="fa fa-trash"></i></a>
                            </span> 
                        </div>';
            if(array_key_exists('child', $value)) {
                $html .= self::get_menu($value['child'],'child');
            }
                $html .= "</li>";
        $no++;
        }
        $html .= "</ol>";
        return $html;
    }
}
?>