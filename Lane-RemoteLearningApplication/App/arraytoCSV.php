<?php
function writeCSVFile($students) {
    $filename = tempnam(sys_get_temp_dir(), "csv");
    $file = fopen($filename,"w");
    foreach ($students as $student) {
        foreach ($student as $fields) {
            fputcsv($file, $fields);
        }
    }
    fclose($file);
    return $filename;
}


function downloadCSVFile($filename) {
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment;Filename=_downloadCSVTest.csv");

    // send file to browser
    readfile($filename);
    unlink($filename);
}

function downloadCSVFileTest() {
    $students = array( array('Student1', 'One', 'L00000005'),
        array('Student2', 'Two', 'L00000006'),
        array('Student3', 'One', 'L00000007')
    );
    $filename = writeCSVFile($students);
    downloadCSVFile($filename);
}

downloadCSVFileTest();
?>