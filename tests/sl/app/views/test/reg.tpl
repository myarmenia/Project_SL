$workbook->send('excelTest.xls');
$worksheet1 =& $workbook->addWorksheet('worksheet');

//            $format_top =& $workbook->addFormat();
$header =& $workbook->addFormat();

//            $format_top->setTextRotation(90);

//            $header->setColor('black');
//            $header->setHAlign('center');
$worksheet1->setInputEncoding('utf-8');