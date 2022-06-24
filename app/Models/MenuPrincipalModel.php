<?php

namespace App\Models;

/**
 * Description of MenuPrincipalModel
 *
 * @author Renato
 */
use CodeIgniter\Model;
use Exception;

class MenuPrincipalModel extends Model
{
    protected $table            = 'menu_principal';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'title',
        'url',
        'status',
        'id_parent',
    ];
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
    protected $useTimestamps    = true;
    protected $useSoftDeletes   = true;
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $beforeInsert     = [];
    protected $beforeUpdate     = [];

}