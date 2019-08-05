<?php

namespace App\Models;

use Lib\Base as Base;

/**
 * Description of log
 *
 * @author Thalisson
 */
class Logs extends Base\Model
{

    public function Index()
    {
        return;
    }

    public function delete()
    {
        if ($_SESSION['user']['login'] == 'developer') {
            $query = "TRUNCATE sistema_log";
            $this->query($query);
            $this->execute();
            header("Location: " . URL_ROOT . 'logs');
        } else {
            header("Location:" . URL_ROOT . 'error/?t=404');
        }
    }

}
