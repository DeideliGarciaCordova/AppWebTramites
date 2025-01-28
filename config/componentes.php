<?php
function st_itemmenu($v1,$v2,  $v3,$v4){    
    if ($v1==''){$url='#';}else{$url=$v1;}
    if ($v2==''){$img='fas fa-home';}else{$img=$v2;}
    $cadena='<li class="nav-item has-treeview">
                    <a href="'.$url.'" class="nav-link">
                        <i class="nav-icon '.$img.'"></i>
                        <p>
                            '.utf8_decode($v3) .'
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">'.$v4.'</ul>
                </li>';

    return $cadena;
}

function st_itemsubmenu($v1,$v2,$v3){
    if ($v1==''){$url='#';}else{$url=$v1;} 
    if ($v2==''){$img='far fa-circle';}else{$img=$v2;}
    $cadena='<li class="nav-item">
                <a href="'. URL .$url.'" class="nav-link">
                    <i class="'.$img.' nav-icon text-primary"></i>
                    <p>'.$v3 .'</p>
                </a>
            </li>';
    return $cadena;
}




?>
