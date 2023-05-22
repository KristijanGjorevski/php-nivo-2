<?php

$xml_str = "
<professors>
    <professor>
        <name>
            <first>Kristijan</first>
            <lastname>Gjorevski</lastname>
        </name>
        <age>33</age>
        <curse>php nivo 2</curse>
        <casovi>10 casa od kurs</casovi>
    </professor>
    <professor>
        <name>
            <first>Alojz</first>
            <lastname>Rop</lastname>
        </name>
        <age>33</age>
        <curse>php nivo 2</curse>
        <casovi>10 casa od kurs</casovi>
    </professor>
</professors>
";

// echo $xml_str;


$x_mlobj = simplexml_load_string($xml_str);

$sxe = new SimpleXMLElement($x_mlobj);

echo '<pre>';
// print_r($xml_obj);
echo '</pre>';

// echo $xml_obj->curse;


foreach($xml_obj->professor as $professor) {
    echo '<li>'. $professor->name->first . ' ' .$professor->name->lastname. '</li>';
    
}


// echo '<pre>';
//     print_r($professor->name->first);
// echo '</pre>';
?>