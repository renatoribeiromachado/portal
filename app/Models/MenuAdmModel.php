<?php

namespace App\Models;
use CodeIgniter\Model;

class MenuAdmModel extends Model
{
    protected $table = 'menu_adm_permission';

    public function getMenu()
    {
         $this->select('mp.level,m.id,m.page,msp.sub_page,msp.url')
            ->from('menu_adm_permission mp', true)
            ->join('menu_adm m','m.id = mp.page_id', 'inner')
            ->join('menu_adm_sub_page msp','msp.id = mp.sub_page_id', 'inner');
     
            return $this;
    } 
}
