<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*************
* FUNCTIONS *
*************
* EmailHTMLHeader()    - HTML Code needed by Apple Mail to process forms
* EmailHTMLFooter()    - HTML Code needed by Apple Mail to process forms
*/
if ( ! function_exists('EmailHTMLHeader')){
    function EmailHTMLHeader(){
        $html = "<html><head>"
            ."<meta http-equiv=\"Content-Type\" content=\"text/html charset=utf-8\">"
            ."<base></head>"
            ."<body style=\"word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;\">"
            ."<base>"
            ."<div class=\"Apple-Mail-URLShareUserContentTopClass\"><br></div>"
            ."<div class=\"Apple-Mail-URLShareWrapperClass\" style=\"position: relative !important;\">"
            ."<blockquote type=\"cite\" style=\"border-left-style: none; color: inherit; padding: inherit; margin: inherit;\">";
        return($html);
    }
}
if ( ! function_exists('EmailHTMLFooter')){
    function EmailHTMLFooter(){
        $html = "</blockquote></div><br><br>"
            ."<div apple-content-edited=\"true\">"
            ."<div><a href=\"mailto:shiande.dm@gmail.com\">shiande.dm@gmail.com</a></div>"
            ."<div ><br></div><br class=\"Apple-interchange-newline\"></div>"
            ."<br></body></html>";  
        return($html);
    }
}  