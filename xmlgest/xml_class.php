<?php

/////////////////////////////////////////////////////////////////////
//
//     this is the xml operation class of guestbook
//
//     last modify was on 2021-12-27
//
/////////////////////////////////////////////////////////////////////

class xml_opration{


    var $string;
    var $data;
    var $filename;
    var $xml;
    var $size;
    //var $string;
   // var $size;
    var $total;


    //define xml file's name
    //get the file and put it into string
    function __construct() {
        $this->filename = "guestbook.xml";
        $this->xml = file_get_contents($this->filename);
        $this->size = RECORD_DISPLAY_COUNT;
    }


    //get xml file and return count of array
    function xmlFormat(){
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        $this->total = intval(count($values)/7);
        //echo $this->total;
        //print_r($values);
    }


    //display records for appointed count
    function xmlPartFormat($page,$pagecount){
        if ($page == 1)
            $this->xml = preg_replace("/(.*)<subject id=\"".($this->total-RECORD_DISPLAY_COUNT)."\">.*$/isU", "\\1</root>", $this->xml);
        elseif($page == $pagecount)
            $this->xml = preg_replace("/(.*)(<subject id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*$)/isU", "<?xml version='1.0' encoding=\"gb2312\"?>\n<root>\\2", $this->xml);
        else{
            $this->xml = preg_replace("/(.*)(<subject id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*<subject id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1)-(RECORD_DISPLAY_COUNT-1))."\">.*<\/subject>).*$/isU", "<?xml version=\"1.0\"?>\n<root>\\2\n</root>", $this->xml);
        }
        /* var_dump($this->xml); */

        // to test above preg_replace function
        //and allow browser to see rss
        //BEGIN
        $fp = fopen (RSS_FILENAME, "w+");
        fwrite($fp, $this->xml);
        fclose ($fp);
        //END
        //
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        /* var_dump($values); */
        return $values;
    }


    //format some tags that can not red and write in xm file
    function formatXmlString($string){
        $trans = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;", "\"" => "&quot;", "'" => "&apos;");
        $this->string = strtr($string, $trans);
        return $this->string;
    }


    //insert xml file
    function insertXmlFile($id, $title, $author, $content, $picture){
        $this->xml = preg_replace("/^.*<root>/is", "", $this->xml);

        Header("Content-type:text/xml");
        $this->data = "<?xml version=\"1.0\"?>\n";
        $this->data.= "<root>\n";
        $this->data.= "<subject id=\"".$id."\">\n";
        $this->data.= "<title>".$title."</title>\n";
        $this->data.= "<author>".$author."</author>\n";
        $this->data.= "<content>".$content."</content>\n";
        $this->data.= "<time>".date("Y-m-d H:i:s")."</time>\n";
        $this->data.= "<picture>".$picture."</picture>\n";
        $this->data.= "</subject>";
        $this->data.=$this->xml;
    }


    //update xml file
    function updateXmlFile($id, $title, $author, $content){
        $this->data = preg_replace("/<subject id=\"".$id."\">.*<\/content>/isU",
                "<subject id=\"".$id."\">\n<title>".$title."</title>\n<author>".$author."</author>\n<content>".$content."</content>", $this->xml);
    }


    //delete xml file
    function deleteXmlFile($id){
        $this->data = preg_replace("/<subject id=\"".$id."\">.*<\/subject>.*(<subject id=\"".($id-1)."\">)/isU", "\\1", $this->xml);
    }


    //write in guestbook.xml
    function writeXmlFile(){
        $fp = fopen ($this->filename, "w+");
        fwrite($fp, $this->data);
        fclose ($fp);
    }


    //pagenite function
    //when record count exceed max display counts of a page ,it will be valid
    //and it return some global variables
    function page(){
        global $begin,$pagesize,$pagecount,$total,$pagestring,$page;
        if( isset($_GET['page']) ){
           $page = intval($_GET['page'] );
        }
        else
           $page = 1;

       $total = $this->total;
       $pagesize = $this->size;
       if ($total){
          if ($total<$pagesize)
             $pagecount=1;
          if ($total%$pagesize)
             $pagecount=(int)($total/$pagesize)+1;
          else $pagecount=$total/$pagesize;
        }
        else $pagecount=0;
        $pagestring="";
        $select="";
        if ($page==1)
           $pagestring.= "<i class='material-icons' style='font-size:28px;'>first_page </i><i class='material-icons' style='font-size:28px;'>skip_previous </i>";
        else
           $pagestring.="<a href=?page=1><i class='material-icons' style='font-size:28px;'>first_page </i></a><a href=?page=".($page-1)."><i class='material-icons' style='font-size:28px;'>skip_previous </i></a>";
        if ($page==$pagecount or $pagecount==0)
           $pagestring.= NEXT_PAGE.SPACER.LAST_PAGE;
        else
            $pagestring.="<a href=?page=".($page+1)."> <i class='material-icons' style='font-size:28px;'>skip_next </i> </a> <a href=?page=".($pagecount)."><i class='material-icons' style='font-size:28px;'>last_page </i></a>";
        $begin=$page*$pagesize;
     }
}

?>