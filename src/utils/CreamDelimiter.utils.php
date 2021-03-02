<?php
/**
 * This helper class will help by auto finding every 
 * occurrences of cream delimiter
 */
class CreamDelimiter {

    /**
     * Returns all the occurencies of cream delimiter
     */
    static function GetCreamDelimiters() {

    }

    /**
     * Will return a cream tag (if found in a cream Delimiter) based on the tag name
     * based on the Cream Structure System tag {@...@} 
     */
    static function GetTag($page_src, $cream_delimiter_tag) {
        $pattern = "<!--@((.|\n|\r)*?)@-->";
        $matches = array();
        preg_match($pattern, $page_src, $matches);
        // If no matches has been found, the file has been already
        // found as not valid
        if ($matches == null) return null;
        $intern = $matches[1];
        $single_tags = array();
        preg_match_all("/\[[^\]]*\]/", $intern, $single_tags);
        foreach ($single_tags[0] as $tag) {
            // Keeping only the Product Name tag
            $tag = str_replace(['[', ']'], '', $tag);
            $exploded = explode("=", $tag);
            // Generally the tag will contain ToppingName=foo
            if (strcmp($cream_delimiter_tag, $exploded[0]) == 0) {
                return $exploded[1];
            }
        }
        // Tag or delimiter not found
        return null;
    }
}