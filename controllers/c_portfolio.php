<?php
class portfolio_controller extends base_controller {
    public function view($project_id) {         
        # Code here to grab the project from the database using the $project_id
				echo "This is the portfolio page for Project:".$project_id;
    } 
}
?>
