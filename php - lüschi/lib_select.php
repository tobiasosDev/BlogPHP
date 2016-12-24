<?php
    function displayEintraege(){
        foreach (select_entries($mysqli, 20) as $eintrag){
            echo'
        <div>
            <p>' . $eintrag[1] . '</p><p>' . $eintrag[2] . '</p><p>' . $eintrag[0] .'</p>
        </div>';
        }
    }
?>