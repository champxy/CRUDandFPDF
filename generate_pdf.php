<?php
require('fpdf/fpdf.php');
$com_name = iconv('UTF-8', 'TIS-620', $_GET['com_name']);
$owner_name = iconv('UTF-8', 'TIS-620', $_GET['owner_name']);
$type_id = $_GET['type_id'];
$typename = iconv('UTF-8', 'TIS-620', $_GET['typename']);
$mainboard = iconv('UTF-8', 'TIS-620', $_GET['mainboard']);
$cpu = iconv('UTF-8', 'TIS-620', $_GET['cpu']);
$os = iconv('UTF-8', 'TIS-620', $_GET['os']);
$ram = iconv('UTF-8', 'TIS-620', $_GET['ram']);
$fullharddisk = iconv('UTF-8', 'TIS-620', $_GET['fullharddisk']);
$drive1 = iconv('UTF-8', 'TIS-620', $_GET['drive1']);
$space1 = iconv('UTF-8', 'TIS-620', $_GET['space1']);
$used1 = iconv('UTF-8', 'TIS-620', $_GET['used1']);
$free1 = iconv('UTF-8', 'TIS-620', $_GET['free1']);
$drive2 = iconv('UTF-8', 'TIS-620', $_GET['drive2']);
$space2 = iconv('UTF-8', 'TIS-620', $_GET['space2']);
$used2 = iconv('UTF-8', 'TIS-620', $_GET['used2']);
$free2 = iconv('UTF-8', 'TIS-620', $_GET['free2']);
$drive3 = iconv('UTF-8', 'TIS-620', $_GET['drive3']);
$space3 = iconv('UTF-8', 'TIS-620', $_GET['space3']);
$used3 = iconv('UTF-8', 'TIS-620', $_GET['used3']);
$free3 = iconv('UTF-8', 'TIS-620', $_GET['free3']);
$manufacturer_monitor = iconv('UTF-8', 'TIS-620', $_GET['manufacturer_monitor']);
$serie_monitor = iconv('UTF-8', 'TIS-620', $_GET['serie_monitor']);
$size_monitor = iconv('UTF-8', 'TIS-620', $_GET['size_monitor']);
$gpu = iconv('UTF-8', 'TIS-620', $_GET['gpu']);
$antivirus = iconv('UTF-8', 'TIS-620', $_GET['antivirus']);
$ip_addr = iconv('UTF-8', 'TIS-620', $_GET['ip_addr']);
$location = iconv('UTF-8', 'TIS-620', $_GET['location']);
$department = iconv('UTF-8', 'TIS-620', $_GET['department']);
$factory = iconv('UTF-8', 'TIS-620', $_GET['factory']);
$status = iconv('UTF-8', 'TIS-620', $_GET['status']);
$created_at = $_GET['created_at'];  // Typically, dates are not encoded, so this might not need conversion.
$note = iconv('UTF-8', 'TIS-620', $_GET['note']);




class PDFGenerator
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->pdf->AddFont('THSarabunNew', 'B', 'THSarabunNew Bold.php');
        $this->pdf->SetFont('THSarabunNew', '', 16);
        $this->drawBorder();
        $this->addLogo();
        $this->endcontent();
        $this->formatDateThai();
    }

    public function addCheckbox($x, $y, $size = 10, $checked = false)
    {
        // วาดสี่เหลี่ยมเพื่อเป็น checkbox
        $this->pdf->Rect($x, $y, $size, $size);

        // หากต้องการทำเครื่องหมายให้วาดเครื่องหมายถูก
        if ($checked) {
            // ตั้งฟอนต์เป็น ZapfDingbats
            $this->pdf->SetFont('ZapfDingbats', '', 12);

            // ใช้รหัส ASCII สำหรับเครื่องหมายถูก
            $checkedSymbol = chr(51); // รหัส ASCII สำหรับเครื่องหมายถูกใน ZapfDingbats

            $this->pdf->SetXY($x + 2, $y + 2); // ตั้งตำแหน่ง
            $this->pdf->Cell($size - 4, $size - 4, $checkedSymbol, 0, 0, 'C');
        }
    }

    public function drawBorder()
    {
        $this->pdf->Rect(20, 10, 170, 270); // ตีกรอบรอบกระดาษ

        $this->pdf->Line(20, 35, 190, 35); // เส้นแบ่งส่วนหัวข้อ     // $this->pdf->Line(55, 10, 55, 35);
        $this->pdf->Line(55, 10, 55, 35);
    }

    public function addLogo()
    {
        $logoFile = 'img/logopdf.png'; // แก้ไขให้ตรงกับตำแหน่งไฟล์โลโก้ของคุณ
        $this->pdf->Image($logoFile, 22, 15, 32); // x, y, width
    }

    public function addTitle($title)
    {
        $this->pdf->SetFont('THSarabunNew', 'B', 16); // ใช้ฟอนต์ตัวหนา
        $this->pdf->SetXY(15, 18);
        $this->pdf->Cell(0, 10, $title, 0, 1, 'C');

        $this->pdf->SetFont('THSarabunNew', '', 14); // ใช้ฟอนต์ตัวธรรมดา
        $this->pdf->SetXY(155, 10);
        $this->pdf->Cell(0, 10, 'No. WSP-FP-IT01-03', 0, 1, 'L');
        $this->pdf->SetXY(155, 18);
        $this->pdf->Cell(0, 10, 'Dev. 0 - 03/02/63', 0, 1, 'L');
        $this->pdf->SetXY(155, 26);
        $this->pdf->Cell(0, 10, 'Page 1/1', 0, 1, 'L');
    }

    public function addContent($content)
    {
        // กำหนดตำแหน่งเริ่มต้นของข้อความให้อยู่ล่างเส้นที่วาด
        $this->pdf->SetXY(22, 50); // กำหนดจุดเริ่มต้นที่อยู่ต่ำกว่าเส้น (y=55)

        // กำหนดขอบกระดาษ
        $this->pdf->SetMargins(20, 10, 20);

        // เพิ่มฟอนต์
        $this->pdf->AddFont('THSarabunNew', '', 'THSarabunNew.php');
        $this->pdf->SetFont('THSarabunNew', '', 14);

        // แสดงเนื้อหา
        $this->pdf->MultiCell(175, 9, $content);
    }

    public function outputPDF($filename = 'document.pdf')
    {
        $this->pdf->Output('I', $filename);
    }

    public function formatDateThai()
    {
        // แปลง string เป็น DateTime object
        $date_print=date("Y-m-d");
        $date = new DateTime($date_print);

        // ดึงข้อมูลวัน, เดือน, และปี
        $day = $date->format('j'); // วัน (1-31)
        $month = $date->format('n'); // เดือน (1-12)
        $year = $date->format('Y'); // ปี

        // แปลงปีเป็นพุทธศักราช
        $yearThai = $year + 543;

        // ชื่อเดือนภาษาไทย
        $monthsThai = [
            1 => 'มกราคม',
            2 => 'กุมภาพันธ์',
            3 => 'มีนาคม',
            4 => 'เมษายน',
            5 => 'พฤษภาคม',
            6 => 'มิถุนายน',
            7 => 'กรกฎาคม',
            8 => 'สิงหาคม',
            9 => 'กันยายน',
            10 => 'ตุลาคม',
            11 => 'พฤศจิกายน',
            12 => 'ธันวาคม'
        ];

        // สร้างข้อความวันที่
        $formattedDate = $day . ' ' . $monthsThai[$month] . ' ' . $yearThai;
        $this->pdf->SetFont('THSarabunNew', '', 14);
        $this->pdf->SetXY(20, 40);
        $this->pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', "วันที่ : $formattedDate "), 0, 1, 'C');
        return $formattedDate;
    }


    public function formatDateThaidoc($dateTime)
{
    // แปลง string เป็น DateTime object จากค่า $dateTime ที่ส่งเข้ามา
    $date = new DateTime($dateTime);

    // ดึงข้อมูลวัน, เดือน, และปี
    $day = $date->format('j'); // วัน (1-31)
    $month = $date->format('n'); // เดือน (1-12)
    $year = $date->format('Y'); // ปี

    // แปลงปีเป็นพุทธศักราช
    $yearThai = $year + 543;

    // ชื่อเดือนภาษาไทย
    $monthsThai = [
        1 => 'มกราคม',
        2 => 'กุมภาพันธ์',
        3 => 'มีนาคม',
        4 => 'เมษายน',
        5 => 'พฤษภาคม',
        6 => 'มิถุนายน',
        7 => 'กรกฎาคม',
        8 => 'สิงหาคม',
        9 => 'กันยายน',
        10 => 'ตุลาคม',
        11 => 'พฤศจิกายน',
        12 => 'ธันวาคม'
    ];

    $formattedDate = $day . ' ' . $monthsThai[$month] . ' ' . $yearThai;
    return $formattedDate;
}

    public function endcontent()
    {
        $this->pdf->SetFont('THSarabunNew', '', 14);
        $this->pdf->SetXY(20, 240);
        // $this->pdf->Cell(0, 10, iconv('UTF-8', 'TIS-620', "ผู้บันทึก : ________________________"), 0, 1, 'C');
        $this->pdf->SetMargins(20, 10, 20);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "                     ข้าพเจ้าผู้ครอบครองเครื่องคอมพิวเตอร์ได้อ่าน นโยบายและการควบคุมการใช้ซอฟแวร์ที่ถูกลิขสิทธิ์ เรียบร้อยแล้ว"));
        $this->pdf->SetXY(20, 245);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "และยินดีปฏิบัติตามกฏระเบียบอย่างเคร่งครัด"));
        $this->pdf->SetXY(25, 253);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "ลงชื่อ ..............................................................."));
        $this->pdf->SetXY(32, 260);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "(...............................................................)"));
        $this->pdf->SetXY(37, 266);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "ผู้ครอบครองเครื่องคอมพิวเตอร์"));
        $this->pdf->SetXY(110, 253);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "ลงชื่อ (...............................................................)"));
        $this->pdf->SetXY(135, 260);
        $this->pdf->Cell(170, 10, iconv('UTF-8', 'TIS-620', "  ผู้สำรวจ"));
    }
}

// การสร้าง PDF พร้อมข้อมูลที่ได้รับ
$pdf = new PDFGenerator();
$pdf->addTitle(iconv('UTF-8', 'TIS-620', 'แบบฟอร์มบันทึกการตรวจสอบอุปกรณ์คอมพิวเตอร์'));


// เพิ่มเนื้อหาลงใน PDF

if ($type_id == 1) {
    $content = iconv('UTF-8', 'TIS-620', "ประเภท : ".$pdf->addCheckbox(37, 53, 5)."       PC".$pdf->addCheckbox(53 , 53, 5,true)."           Notebook ".$pdf->addCheckbox(79, 53, 5)."          All in one ".$pdf->addCheckbox(105, 53, 5)."          Server \n");
} else if ($type_id == 2) {
    $content = iconv('UTF-8', 'TIS-620', "ประเภท : ".$pdf->addCheckbox(37, 53, 5,true)."       PC".$pdf->addCheckbox(53, 53, 5)."           Notebook ".$pdf->addCheckbox(79, 53, 5)."          All in one ".$pdf->addCheckbox(105, 53, 5)."          Server \n");
} else if ($type_id == 5) {
    $content = iconv('UTF-8', 'TIS-620', "ประเภท : ".$pdf->addCheckbox(37, 53, 5)."       PC".$pdf->addCheckbox(53, 53, 5)."           Notebook ".$pdf->addCheckbox(79, 53, 5,true)."          All in one ".$pdf->addCheckbox(105, 53, 5)."          Server \n");
}else if ($type_id == 6) {
    $content = iconv('UTF-8', 'TIS-620', "ประเภท : ".$pdf->addCheckbox(37, 53, 5)."       PC".$pdf->addCheckbox(53, 53, 5)."           Notebook ".$pdf->addCheckbox(79, 53, 5)."          All in one ".$pdf->addCheckbox(105, 53, 5,true)."          Server \n");
}
$content .=  iconv('UTF-8', 'TIS-620', "ชื่อเครื่อง(Computer Name) : ") . $com_name ."\n";           
$content .=  iconv('UTF-8', 'TIS-620', "ชื่อผู้ใช้งาน(User Name) : ") . $owner_name ."\n";
$content .= iconv('UTF-8', 'TIS-620', "เมนบอร์ด(Mainboard) : ") . $mainboard ."\n";
$content .= iconv('UTF-8', 'TIS-620', "ซีพียู(CPU) : ") . $cpu."\n";
$content .= iconv('UTF-8', 'TIS-620', "ระบบปฏิบัติการ(Operating System) : $os\n");
$content .= iconv('UTF-8', 'TIS-620', "แรม(RAM) : $ram\n");
$content .= iconv('UTF-8', 'TIS-620', "ฮาร์ดดิสก์ (Harddisk) : ขนาดความจุ $fullharddisk\n");
if(isset($drive1) && empty($drive2) && empty($drive3)){
    // If block - มี $drive1 แต่ไม่มี $drive2 และ $drive3
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive1  :  ขนาดความจุรวม $space1  ใช้งานแล้ว $used1 คงเหลือ $free1\n");
}elseif(isset($drive1) && isset($drive2) && empty($drive3)){
    // Elseif block - มี $drive1 และ $drive2 แต่ไม่มี $drive3 หรือ $drive3 ว่าง
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive1  :  ขนาดความจุรวม $space1  ใช้งานแล้ว $used1 คงเหลือ $free1\n");
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive2  :  ขนาดความจุรวม $space2  ใช้งานแล้ว $used2 คงเหลือ $free2\n");
}elseif(isset($drive1) && isset($drive2) && !empty($drive3)){
    // Elseif block - มี $drive1, $drive2 และ $drive3
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive1  :  ขนาดความจุรวม $space1  ใช้งานแล้ว $used1 คงเหลือ $free1\n");
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive2  :  ขนาดความจุรวม $space2  ใช้งานแล้ว $used2 คงเหลือ $free2\n");
    $content .= iconv('UTF-8', 'TIS-620', "         ไดร์ฟ   $drive3  :  ขนาดความจุรวม $space3  ใช้งานแล้ว $used3 คงเหลือ $free3\n");
}


    
    

$content .= iconv('UTF-8', 'TIS-620', "การ์ดจอ(GPU) : ") . $gpu ."\n";
$content .= iconv('UTF-8', 'TIS-620', "จอแสดงผล : ผู้ผลิต ".$_GET['manufacturer_monitor']."    รุ่น ".$_GET['serie_monitor']."    ขนาด ".$_GET['size_monitor']."     \n");
$content .= iconv('UTF-8', 'TIS-620', "เเอนตี้ไวรัส(Antivirus) : ") . $antivirus. "\n";
$content .= iconv('UTF-8', 'TIS-620', "Ip Address : ") .$ip_addr . "\n";
$content .= iconv('UTF-8', 'TIS-620', "สถานที่ใช้งาน : ") . $location . "\n";
$content .= iconv('UTF-8', 'TIS-620', "แผนก : ") . $department . "\n";
$content .= iconv('UTF-8', 'TIS-620', "โรงงาน : ") . $factory . "\n";
if ($status == "1") {
    $content .= iconv('UTF-8', 'TIS-620', "สถานะ : ใช้งานปกติ\n");
} else if ($status == "2") {
    $content .= iconv('UTF-8', 'TIS-620', "สถานะ : ไม่ได้ใช้งาน\n");
}

$datebuy = $pdf->formatDateThaidoc($created_at);
$content .= iconv('UTF-8', 'TIS-620', "วันที่ซื้อ : ") . iconv('UTF-8', 'TIS-620', $datebuy) . "\n";
if ($note != "") {
    $content .= iconv('UTF-8', 'TIS-620', "หมายเหตุ : ") . $note. "\n";
} else {
    $content .= iconv('UTF-8', 'TIS-620', "หมายเหตุ : -\n");
}

// เพิ่มเนื้อหาใน PDF
$pdf->addContent($content);
// ส่งออก PDF
$filename = 'report_' . $com_name . '.pdf';
$pdf->outputPDF($filename);
