<?php
// function to convert multi-dimensional array to xml
function array2XML($obj, $array)
{
    foreach ($array as $key => $value)
    {
        if(is_numeric($key))
            $key = 'item' . $key;
        if (is_array($value))
        {
            $node = $obj->addChild($key);
            array2XML($node, $value);
        }
        else
        {
            $obj->addChild($key, htmlspecialchars($value));
        }
    }
}
// save as xml file
function saveXML($xml)
{

    echo(($xml->asXML('test.xml')) ? 'Your XML file has been generated successfully!'
        : 'Error generating XML file!');
    if (file_exists('test.xml')){

        include ('downloadXML.php');
    }
    else{
        //error message on page
    }

}
// define php multi-dimensional array
$my_array = array (
    '0' => array (
        'id' => 'ABC123',
        'personal' => array (
            'name' =>'Aaron Harris',
            'gender' => 'Male',
            'age' => 31,
            'address' => array (
                'street' => '555 Random St',
                'city' => 'Eugene',
                'state' => 'OR',
                'zipcode' => '97405'
            )
        ),
        'profile' => array (
            'position' => 'Student',
            'department' => 'Programming'
        )
    ),
    '1' => array (
        'id' => 'ZYX321',
        'personal' => array (
            'name' => 'Mari Good',
            'gender' => 'Female',
            'age' => 25,
            'address' => array (
                'street' => '444 Another St',
                'city' => 'Eugene',
                'state' => 'OR',
                'zipcode' => '97402'
            )
        ),
        'profile' => array (
            'position' => 'Mad Scientist',
            'department' => 'Edumacation!'
        )
    )
);

// create new instance of simplexml
$xml = new SimpleXMLElement('<root/>');

// function callback
array2XML($xml, $my_array);

saveXML($xml);




?>