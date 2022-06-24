<?php

namespace App\Models;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table         = 'menu';
    protected $primaryKey    = 'id';
    
    
    /*JOIN*/
    public function subMenu() {
        $this
            ->select('m.title,sb.*')
//            ->select('m.title,sb.subtitle,sb.link')
            ->from('menu m', true)
            ->join('sub_menu sb','sb.menu_id = m.id', 'inner');
            return $this;
    }
}
