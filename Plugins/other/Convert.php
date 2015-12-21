<?php
/**
 * Created by PhpStorm.
 * User: VarYan
 * Date: 08.12.2015
 * Time: 21:08
 */

namespace Plugins\Other;

class Convert
{
    /**
     * json method
     * @param stdClass/Array $data
     * @param string $status
     * @param string $message
     * @return json
     * */
    public static function json($data,$status = 'success',$message = ''){
        return json_encode(array(
            'response'  =>$data,
            'status'    =>$status,
            'message'   =>$message
        ),JSON_PRETTY_PRINT);
    }
    /**
     * xml method
     * @param array $data
     * @param string $info_tag (default value 'info')
     * @param boolean $numbering (default value true)
     * @return xml
     * */
    public function xml($data,$info_tag = 'info',$numbering = true){
        $xml = new \DOMDocument();

        $this->create_node($xml,$data,null,$info_tag,$numbering);

        $header = "Content-Type:text/xml";

        header($header);
        print $xml->saveXML();
    }
    /**
     * create_node method
     * @param \DOMDocument $xml
     * @param array $arr
     * @param null|string $node
     * @param string $info_tag
     * */
    private function create_node(\DOMDocument $xml,$arr, $node = null,$info_tag,$numbering){
        if (is_null($node))
        {
            $node = $xml->appendChild($xml->createElement( $info_tag ));
        }
        $i = 0;
        foreach($arr as $element => $value)
        {
            $element = is_numeric( $element ) ? ( ($numbering) ? 'node-'.$i : 'node') : $element;

            $child = $xml->createElement($element, (is_array($value) ? null : $value));
            $node->appendChild($child);

            if (is_array($value))
            {
                $this->create_node($xml, $value, $child, $info_tag,$numbering);
            }
            $i++;
        }
    }
}