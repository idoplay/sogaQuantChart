
<?php
if(defined('IS_ALLOW_DEBUG') && IS_ALLOW_DEBUG){
    $this->load->library('Performance');
    Performance::get_instance()->log('debug.............');
    Performance::get_instance()->run_run();
}
?>