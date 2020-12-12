<?php
    /*
    -----------------------------------------------------------------------------
    ETextTag.class.php
    Contains all the tags that cream can currently render
    @todo: add more tag types
    -----------------------------------------------------------------------------
    */
    abstract class ETextTag {
        const P = 0;
        const H1 = 1;
        const H2 = 2;
        const H3 = 3;
        const H4 = 4;
        const H5 = 6;
        const H6 = 7;
        const SPAN = 8;
    }
?>