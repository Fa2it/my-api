<?php
/**
 * @author Felix Ashu Aba
 * @author-url https://www.fa2.it/about/
 */
 
function compareEquals( $expected, $realval ){
     if( strcmp($expected, $realval) == 0 ){
        echo " Test passed and OK";
     } else {
       echo "Test Failed";
     }
}
