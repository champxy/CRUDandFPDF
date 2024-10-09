<?php
include('datadevice.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เเบบฟอร์มบันทึกการตรวจสอบอุปกรณ์คอมพิวเตอร์</title>
    <link rel="icon" href="./logo11.jpg">
</head>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="navbar bg-base-100 flex justify-between items-center p-0 shadow-md">
    <div class="navbar-start flex items-center">
        <img src="img/logo12.jpg" class="w-60 ml-0" alt="">
    </div>
    <div class="navbar-end">
        </h1>
    </div>
</div>

<style>
    .button {
        background-color: #04AA6D;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .button2 {
        background-color: #008CBA;
        color: black;
    }

    /* ฟ้า */
    .button3 {
        background-color: #f44336;
        color: black;
    }

    /* เเดง */
    .button4 {
        background-color: #269900;
        color: black;
    }

    /* เขียว */
    .button5 {
        background-color: #ffbf00;
        color: black;
    }


    .print-icon {
        color: #FFD43B;
        /* สีของไอคอน */
        border: 2px solid #FFD43B;
        /* สีและขนาดของเส้นขอบ */
        border-radius: 8px;
        /* ความโค้งของขอบ */
        padding: 10px;
        /* ช่องว่างภายในรอบๆ ไอคอน */
        background-color: #333;
        /* พื้นหลังของไอคอน */
        font-size: 24px;
        /* ขนาดของไอคอน */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        /* เพิ่มเอฟเฟกต์การเปลี่ยนแปลง */
    }

    .print-icon:hover {
        transform: scale(1.1);
        /* ขยายขนาดเมื่อเอาเมาส์วาง */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        /* เพิ่มเงาเมื่อเอาเมาส์วาง */
    }
</style>


<body>
    <div class="">
        <div class="flex justify-end">
        <div class="ml-3 mb-5"><a href="#" class="btn btn-accent" onclick="my_insert.showModal()">เพิ่มข้อมูลเครื่อง</a></div>
        <div class="ml-3 mb-5"><a href="export.php" class="btn btn-accent">Export To Excel</a></div>
        </div>
        
        <div class="text-center"></div>

        <div class="table-responsive">
            <table id="example" class="display nowrap">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th>ชื่อเครื่อง</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>ชนิด</th>
                        <th>โรงงาน</th>
                        <th>สถานที่ใช้งาน</th>
                        <th>แผนก</th>
                        <th>ระบบปฎิบัติการ</th>                                      
                        <th>สถานะ</th>
                        <th>วันที่ซื้อ</th>
                        <th>Action</th>
                        <th></th>
                        <th>พิมพ์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row_device)) {
                        $i = 1;
                        foreach ($row_device as $row) {

                    ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['com_name'] ?></td>
                                <td><?= $row['owner_name'] ?></td>
                                <td><?= $row['typename'] ?></td>                             
                                <td><?= $row['factory'] ?></td>
                                <td><?= $row['location'] ?></td>
                                <td><?= $row['department'] ?></td>
                                <td><?= $row['os'] ?></td>                        

                                <td>
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo "
                                            <div class=''>
                                                <h4 class='text-green-700 font-semibold text-lg transition-transform transform hover:scale-105'>ใช้งาน</h4>
                                            </div>";
                                    } else {
                                        echo "
                                            <div class=''>
                                                <span class='text-red-700 font-semibold text-lg transition-transform transform hover:scale-105'>ไม่ใช้งาน</span>
                                            </div>";
                                    }
                                    ?>
                                </td>
                                <td class="date-cell"><?= $row['created_at'] ?></td>
                               
                                <td>
                                
                         
                                    <button class="btn btn-warning" onclick="showEditModal(
    <?= $row['id'] ?>, 
    '<?= htmlspecialchars($row['com_name'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['owner_name'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['type_id'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['typename'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['mainboard'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['cpu'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['os'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['ram'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['fullharddisk'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['drive1'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['space1'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['used1'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['free1'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['drive2'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['space2'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['used2'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['free2'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['drive3'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['space3'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['used3'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['free3'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['manufacturer_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['serie_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['size_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['gpu'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['antivirus'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['ip_addr'], ENT_QUOTES, 'UTF-8') ?>',                                             
    '<?= htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['department'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($row['factory'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') ?>',
    '<?= htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8') ?>'
)">แก้ไข</button>

                                </td>
                                <td>
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-error">ลบ</button>
                                    </form>
                                </td>
                                <td>
                                              
                                    <i class="fa-solid fa-print print-icon"
                                        onclick="printPDF(
            '<?= $row['id'] ?>', 
            '<?= htmlspecialchars($row['com_name'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['owner_name'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['type_id'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['typename'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['mainboard'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['cpu'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['os'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['ram'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['fullharddisk'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['drive1'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['space1'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['used1'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['free1'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['drive2'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['space2'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['used2'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['free2'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['drive3'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['space3'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['used3'], ENT_QUOTES, 'UTF-8') ?>',
              '<?= htmlspecialchars($row['free3'], ENT_QUOTES, 'UTF-8') ?>',
            '<?= htmlspecialchars($row['manufacturer_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['serie_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['size_monitor'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['gpu'], ENT_QUOTES, 'UTF-8') ?>',        
            '<?= htmlspecialchars($row['antivirus'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['ip_addr'], ENT_QUOTES, 'UTF-8') ?>',                                             
            '<?= htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['department'], ENT_QUOTES, 'UTF-8') ?>', 
            '<?= htmlspecialchars($row['factory'], ENT_QUOTES, 'UTF-8') ?>',
            '<?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?>',
            '<?= htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8') ?>',
            '<?= htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8') ?>'
       )">
                                    </i>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <dialog id="my_insert" class="modal modal-bottom sm:modal-middle w-full">
        <div class="modal-box w-11/12 max-w-5xl">

            <h3 class="text-lg font-bold mb-3"> เพิ่มข้อมูล</h3>
            <form action="" method="POST">
                <input type="hidden" name="action" value="add">
                
                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">ชนิดของเครื่อง:</span>
                    </label>
                    <select name="type_id" id="type-select" class="select select-bordered w-full mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกชนิดของเครื่อง</option>
                        <?php
                        foreach ($row_type as $row) {
                        ?>
                            <option value="<?= $row['id'] ?>"><?= $row['typename'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">โรงงาน:</span>
                    </label>
                    <select name="factory" id="factory-select" class="select select-bordered w-full mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกโรงงาน</option>
                        <option value="โรงงานน้ำตาลขอนแก่น">โรงงานน้ำตาลขอนแก่น</option>
                        <option value="โรงงานไฟฟ้าน้ำตาลขอนแก่น">โรงงานไฟฟ้าน้ำตาลขอนแก่น</option>

                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text">เเผนก:</span>
                    </label>
                    <select name="department" id="department-select" class="select select-bordered w-full mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกแผนก</option>
                        <?php
                        foreach ($row_department as $row) {
                        ?>
                            <option value="<?= $row['department_name'] ?>"><?= $row['department_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">สถานที่ใช้งาน:</span>
                    </label>
                    <select name="location" id="location-select" class="select select-bordered w-full mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกสถานที่ใช้งาน</option>
                        <?php
                        foreach ($row_location as $row) {
                        ?>
                            <option value="<?= $row['location_name'] ?>"><?= $row['location_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                            
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ชื่อผู้ใช้งาน :
                    <input type="text" name="owner_name" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ชื่อเครื่อง :
                    <input type="text" name="com_name" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    เมนบอร์ด :
                    <input type="text" name="mainboard" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ซีพียู :
                    <input type="text" name="cpu" class="grow" placeholder="" required autocomplete="off" />
                </label>                                                                                            
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    แรม :
                    <input type="text" name="ram" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                ฮาร์ดดิสก์ : ขนาดความจุ
                    <input type="text" name="fullharddisk" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <div class="card shadow-lg p-4">                                           
                    <div class="flex gap-2 mt-2">
                       
                    <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ:
                            <input type="text" name="drive1" class="input input-bordered w-full" placeholder="" required autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                    </div>
                    
                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ:
                            <input type="text" name="drive2" class="input input-bordered w-full" placeholder="" autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space2" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used2" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free2" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ:
                            <input type="text" name="drive3" class="input input-bordered w-full" placeholder="" autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                    </div>
                </div>
                <br>


                จอเเสดงผล :
                <div class="card shadow-lg p-4">
                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            ผู้ผลิต:
                            <input type="text" name="manufacturer_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            รุ่น:
                            <input type="text" name="serie_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="size_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                    </div>
                </div>
                <br>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    การ์ดจอ :
                    <input type="text" name="gpu" class="grow" placeholder="" required autocomplete="off" />
                </label>

                <label class="input input-bordered flex items-center gap-2 mt-2">
                    แอนตี้ไวรัส :
                    <input type="text" name="antivirus" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    IP Address :
                    <input type="text" name="ip_address" class="grow" placeholder="" required autocomplete="off" />
                </label>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text">ระบบปฏิบัติการ :</span>
                    </label>
                    <select name="os" id="os-select" class="select select-bordered w-full mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกระบบปฏิบัติการ</option>
                        <?php
                        foreach ($row_operating as $row) {
                        ?>
                            <option value="<?= $row['operating_name'] ?>"><?= $row['operating_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">สถานะการใช้งาน:</span>
                    </label>
                    <select name="status" id="status-select" class="select select-bordered mt-2 text-gray-500">
                        <option value="" disabled selected>เลือกสถานะ</option>
                        <option value="1">ใช้งาน</option>
                        <option value="2">ไม้ใช้งาน</option>
                    </select>
                </div>


                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">วันที่ซื้อ :</span>
                    </label>
                    <input type="date" name="buy_date" id="buy_date" class="input input-bordered  mt-2 text-gray-500">
                </div>



                <label class="mb-2">Note (หมายเหตุ)</label>
                <label class="textarea textarea-bordered flex items-center gap-2 mt-2">
                    <textarea name="note" class="grow" placeholder="หมายเหตุ"></textarea>
                </label>
                <div class="modal-action">
                    <button type="submit" class="btn btn-success">บันทึก</button>
            </form>
            <form method="dialog">
                <button class="btn btn-error">ปิด</button>
            </form>
        </div>
        </div>
    </dialog>

    <dialog id="my_edit" class="modal modal-bottom sm:modal-middle w-full">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="text-lg font-bold mb-3"> แก้ไขข้อมูล</h3>
            <form action="" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="edit_id" value="">
                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">ชนิดของเครื่อง:</span>
                    </label>
                    <select name="type_id" id="edit_type_id" class="select select-bordered w-full mt-2">
                        <option value="" disabled selected>เลือกชนิดของเครื่อง</option>
                        <?php
                        foreach ($row_type as $row) {
                        ?>
                            <option value="<?= $row['id'] ?>"><?= $row['typename'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">โรงงาน:</span>
                    </label>
                    <select name="factory" id="edit_factory" class="select select-bordered w-full mt-2">
                        <option value="" disabled selected>เลือกโรงงาน</option>
                        <option value="โรงงานน้ำตาลขอนแก่น">โรงงานน้ำตาลขอนแก่น</option>
                        <option value="โรงงานไฟฟ้าน้ำตาลขอนแก่น">โรงงานไฟฟ้าน้ำตาลขอนแก่น</option>

                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">เเผนก:</span>
                    </label>
                    <select name="department" id="edit_department" class="select select-bordered w-full mt-2">
                        <option value="" disabled selected>เลือกแผนก</option>
                        <?php
                        foreach ($row_department as $row) {
                        ?>
                            <option value="<?= $row['department_name'] ?>"><?= $row['department_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">สถานที่ใช้งาน:</span>
                    </label>

                    <select name="location" id="edit_location" class="select select-bordered w-full mt-2">
                        <option value="" disabled selected>เลือกสถานที่ใช้งาน</option>
                        <?php
                        foreach ($row_location as $row) {
                        ?>
                            <option value="<?= $row['location_name'] ?>"><?= $row['location_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>


                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ชื่อผู้ใช้งาน :
                    <input type="text" name="owner_name" id="edit_owner_name" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ชื่อเครื่อง :
                    <input type="text" name="com_name" id="edit_com_name" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    เมนบอร์ด :
                    <input type="text" name="mainboard" id="edit_mainboard" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    ซีพียู :
                    <input type="text" name="cpu" id="edit_cpu" class="grow" placeholder="" required autocomplete="off" />
                </label>

                <label class="input input-bordered flex items-center gap-2 mt-2">
                    แรม :
                    <input type="text" name="ram" id="edit_ram" class="grow" placeholder="" required autocomplete="off" />
                </label>
                <label class="input input-bordered flex items-center gap-2 mt-2">
                ฮาร์ดดิสก์ : ขนาดความจุ
                    <input type="text" name="fullharddisk" id="edit_fullharddisk" class="grow" placeholder="" required autocomplete="off" />
                </label>
                
                <br>
                <div class="card shadow-lg p-4">                             
                <div class="flex gap-2 mt-2">                     
                    <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ
                            <input type="text" name="drive1" id="edit_drive1" class="input input-bordered w-full" placeholder="" required autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space1" id="edit_space1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used1" id="edit_used1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free1" id="edit_free1" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                    </div>

                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ:
                            <input type="text" name="drive2" id="edit_drive2" class="input input-bordered w-full" placeholder="" autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space2" id="edit_space2" class="input input-bordered w-full" placeholder="" autocomplete="off" />

                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used2" id="edit_used2" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free2" id="edit_free2" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                    </div>
                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ไดร์ฟ:
                            <input type="text" name="drive3" id="edit_drive3" class="input input-bordered w-full" placeholder="" autocomplete="off" maxlength="1" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '')" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="space3" id="edit_space3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            ใช้งานเเล้ว:
                            <input type="text" name="used3" id="edit_used3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/4 whitespace-nowrap">
                            คงเหลือ:
                            <input type="text" name="free3" id="edit_free3" class="input input-bordered w-full" placeholder="" autocomplete="off" />
                        </label>
                    </div>
                </div>
                <br>

                จอเเสดงผล :
                <div class="card shadow-lg p-4">
                    <div class="flex gap-2 mt-2">
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            ผู้ผลิต:
                            <input type="text" name="manufacturer_monitor" id="edit_manufacturer_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            รุ่น:
                            <input type="text" name="serie_monitor" id="edit_serie_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                        <label class="flex items-center gap-2 w-1/3 whitespace-nowrap">
                            ขนาด:
                            <input type="text" name="size_monitor" id="edit_size_monitor" class="input input-bordered w-full" placeholder="" required autocomplete="off" />
                        </label>
                    </div>
                </div>
                <br>
                
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    การ์ดจอ :
                    <input type="text" name="gpu" id="edit_gpu" class="grow" placeholder="" required autocomplete="off" />
                </label>

                <label class="input input-bordered flex items-center gap-2 mt-2">
                    แอนตี้ไวรัส :
                    <input type="text" name="antivirus" id="edit_antivirus" class="grow" placeholder="" required autocomplete="off" />
                </label>
                
                <label class="input input-bordered flex items-center gap-2 mt-2">
                    IP Address :
                    <input type="text" name="ip_address" id="edit_ip_address" class="grow" placeholder="" required autocomplete="off" />
                </label>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">ระบบปฏิบัติการ :</span>
                    </label>
                    <select name="os" id="edit_os" class="select select-bordered w-full mt-2">
                        <option value="" disabled selected>เลือกระบบปฏิบัติการ</option>
                        <?php
                        foreach ($row_operating as $row) {
                        ?>
                            <option value="<?= $row['operating_name'] ?>"><?= $row['operating_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items-center whitespace-nowrap">
                        <span class="label-text
                        ">สถานะการใช้งาน:</span>
                    </label>
                    <select name="status" id="edit_status" class="select select-bordered mt-2">
                        <option value="" disabled selected>เลือกสถานะ</option>
                        <option value="1">ใช้งาน</option>
                        <option value="2">ไม้ใช้งาน</option>
                    </select>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <label class="flex items
                    -center whitespace-nowrap">
                        <span class="label-text
                        ">วันที่ซื้อ :</span>
                    </label>
                    <input type="date" name="buy_date" id="edit_buy_date" class="input input-bordered  mt-2">
                </div>
                <label class="mb-2">Note (หมายเหตุ)</label>
                <label class="textarea textarea-bordered flex items-center gap-2 mt-2">
                    <textarea name="note" id="edit_note" class="grow" placeholder="หมายเหตุ"></textarea>
                </label>
                <div class="modal-action">
                    <button type="submit" class="btn btn-success">บันทึก</button>
            </form>
            <form method="dialog">
                <button class="btn btn-error">ปิด</button>
            </form>
        </div>
        </div>
    </dialog>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({

            paging: true,
            pageLength: 10
        });
    });
</script>

<script>
    function updateSelectColor(selectElement) {
        if (selectElement.value === "") {
            selectElement.classList.add('text-gray-500');
            selectElement.classList.remove('text-black');
        } else {
            selectElement.classList.remove('text-gray-500');
            selectElement.classList.add('text-black');
        }
    }

    const selects = document.querySelectorAll('select');

    selects.forEach(select => {
        select.addEventListener('change', function() {
            updateSelectColor(this);
        });
    });
</script>


<script>
    function showEditModal(id, com_name, owner_name, type_id, type_name, mainboard, cpu, os, ram, fullharddisk, drive1, space1, used1,free1, drive2, space2, used2, free2, drive3, space3, used3, free3, manufacturer_monitor, serie_monitor, size_monitor, gpu, antivirus, ip_address, location, department, factory, status, buydate, note) {
        console.log('ID:', id);
        console.log('Computer Name:', com_name);
        console.log('Owner Name:', owner_name);
        console.log('Type ID:', type_id);
        console.log('Type Name:', type_name);
        console.log('Mainboard:', mainboard);
        console.log('CPU:', cpu);
        console.log('OS:', os);
        console.log('RAM:', ram);     
        console.log('Fullharddisk:', fullharddisk);    
        console.log('drive1:',drive1);
        console.log('Space1:',space1);
        console.log('Used1:',used1);
        console.log('Free1:',free1);
        console.log('drive2:',drive2);
        console.log('Space2:',space2);
        console.log('Used2:',used2);
        console.log('Free2:',free2);
        console.log('drive3:',drive3);
        console.log('Space3:',space3);
        console.log('Used3:',used3);
        console.log('Free3:',free3);
        console.log('Manufacturer_monitor:',manufacturer_monitor);
        console.log('Serie_monitor:', serie_monitor);
        console.log('Size_monitor:', size_monitor);
        console.log('GPU:', gpu);
        console.log('Antivirus:', antivirus);
        console.log('IP Address:', ip_address);
        console.log('Location:', location);
        console.log('Department:', department);
        console.log('Factory:', factory);
        console.log('Status:', status);
        console.log('Buy Date:', buydate);
        console.log('Note:', note);

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_com_name').value = com_name;
        document.getElementById('edit_owner_name').value = owner_name;
        document.getElementById('edit_type_id').value = type_id;
        document.getElementById('edit_mainboard').value = mainboard;
        document.getElementById('edit_cpu').value = cpu;
        document.getElementById('edit_os').value = os;
        document.getElementById('edit_ram').value = ram;
        document.getElementById('edit_fullharddisk').value = fullharddisk;
        document.getElementById('edit_drive1').value = drive1;
        document.getElementById('edit_space1').value = space1;
        document.getElementById('edit_used1').value = used1;
        document.getElementById('edit_free1').value = free1;
        document.getElementById('edit_drive2').value = drive2;
        document.getElementById('edit_space2').value = space2;
        document.getElementById('edit_used2').value = used2;
        document.getElementById('edit_free2').value = free2;
        document.getElementById('edit_drive3').value = drive3;
        document.getElementById('edit_space3').value = space3;
        document.getElementById('edit_used3').value = used3;
        document.getElementById('edit_free3').value = free3;   
        document.getElementById('edit_manufacturer_monitor').value = manufacturer_monitor;
        document.getElementById('edit_serie_monitor').value = serie_monitor;
        document.getElementById('edit_size_monitor').value = size_monitor;
        document.getElementById('edit_gpu').value = gpu;
        document.getElementById('edit_antivirus').value = antivirus;
        document.getElementById('edit_ip_address').value = ip_address;
        document.getElementById('edit_location').value = location;
        document.getElementById('edit_department').value = department;
        document.getElementById('edit_factory').value = factory;
        document.getElementById('edit_status').value = status;
        const dateOnly = buydate.split(' ')[0];
        document.getElementById('edit_buy_date').value = dateOnly;
        document.getElementById('edit_note').value = note;

        document.getElementById('my_edit').showModal();


    }
</script>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateCells = document.querySelectorAll('.date-cell');

        dateCells.forEach(cell => {
            const dateStr = cell.textContent;
            const dateObj = new Date(dateStr);

            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = dateObj.toLocaleDateString('th-TH', options);

            cell.textContent = formattedDate;
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputNames = ['space1', 'used1', 'free1', 'space2', 'used2', 'free2', 'space3', 'used3', 'free3', 'ram'];

        inputNames.forEach(name => {
            const input = document.querySelector(`input[name="${name}"]`);

            if (input) {
                input.addEventListener('blur', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    if (value) {
                        event.target.value = `${value} GB`; // Add 'GB' when focus leaves
                    }
                });

                input.addEventListener('focus', (event) => {
                    let value = event.target.value.replace(' GB', ''); // Remove 'GB' when input gains focus
                    event.target.value = value;
                });

                input.addEventListener('input', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    event.target.value = value; // Show only numbers
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Define input IDs instead of names
        const inputIDs = ['edit_space1', 'edit_used1', 'edit_free1', 'edit_space2', 'edit_used2', 'edit_free2', 'edit_space3', 'edit_used3', 'edit_free3', 'edit_ram',];

        inputIDs.forEach(id => {
            const input = document.getElementById(id);

            if (input) {
                input.addEventListener('blur', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    if (value) {
                        event.target.value = `${value} GB`; // Add 'GB' when focus leaves
                    }
                });

                input.addEventListener('focus', (event) => {
                    let value = event.target.value.replace(' GB', ''); // Remove 'GB' when input gains focus
                    event.target.value = value;
                });

                input.addEventListener('input', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    event.target.value = value; // Show only numbers
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const inputNames = ['size_monitor'];

        inputNames.forEach(name => {
            const input = document.querySelector(`input[name="${name}"]`);

            if (input) {
                input.addEventListener('blur', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    if (value) {
                        event.target.value = `${value} นิ้ว`; // Add 'GB' when focus leaves
                    }
                });

                input.addEventListener('focus', (event) => {
                    let value = event.target.value.replace(' นิ้ว', ''); // Remove 'GB' when input gains focus
                    event.target.value = value;
                });

                input.addEventListener('input', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    event.target.value = value; // Show only numbers
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Define input IDs instead of names
        const inputIDs = ['edit_size_monitor'];

        inputIDs.forEach(id => {
            const input = document.getElementById(id);

            if (input) {
                input.addEventListener('blur', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    if (value) {
                        event.target.value = `${value} นิ้ว`; // Add 'GB' when focus leaves
                    }
                });

                input.addEventListener('focus', (event) => {
                    let value = event.target.value.replace(' นิ้ว', ''); // Remove 'GB' when input gains focus
                    event.target.value = value;
                });

                input.addEventListener('input', (event) => {
                    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
                    event.target.value = value; // Show only numbers
                });
            }
        });
    });
</script>
<script>
    function printPDF(id, com_name, owner_name, type_id, typename, mainboard, cpu, os, ram, fullharddisk, drive1, space1, used1,free1, drive2, space2, used2, free2, drive3, space3, used3, free3, manufacturer_monitor, serie_monitor, size_monitor, gpu, antivirus, ip_addr, location, department, factory, status, created_at, note) {
        console.log('ID:', id);
        console.log('Computer Name:', com_name);
        console.log('Owner Name:', owner_name);
        console.log('Type ID:', type_id);
        console.log('Type Name:', typename);
        console.log('Mainboard:', mainboard);
        console.log('CPU:', cpu);
        console.log('OS:', os);
        console.log('RAM:', ram);
        console.log('Fullharddisk:', fullharddisk);   
        console.log('Drive1:', drive1);
        console.log('Space1:', space1);
        console.log('Used1:', used1);
        console.log('Free1:', free1);
        console.log('Drive2:', drive2);
        console.log('Space2:', space2);
        console.log('Used2:', used2);
        console.log('Free2:', free2);
        console.log('Drive3:', drive3);
        console.log('Space3:', space3);
        console.log('Used3:', used3);
        console.log('Free3:', free3);
        console.log('Manufacturer_monitor:', manufacturer_monitor);
        console.log('Serie_monitor:', serie_monitor);
        console.log('Size_monitor:', size_monitor);
        console.log('GPU:', gpu);
        console.log('Antivirus:', antivirus);
        console.log('IP Address:', ip_addr);
        console.log('Location:', location);
        console.log('Department:', department);
        console.log('Factory:', factory);
        console.log('Status:', status);
        console.log('Created At:', created_at);
        console.log('Note:', note);
        
        const data = {
        id: id,
        com_name: com_name,
        owner_name: owner_name,
        type_id: type_id,
        typename: typename,
        mainboard: mainboard,
        cpu: cpu,
        os: os,
        ram: ram,
        fullharddisk: fullharddisk,         
        drive1: drive1, 
        space1: space1,
        used1: used1,
        free1: free1,
        drive2: drive2, 
        space2: space2,
        used2: used2,
        free2: free2,
        drive3: drive3, 
        space3: space3,
        used3: used3,
        free3: free3,
        manufacturer_monitor: manufacturer_monitor,
        serie_monitor: serie_monitor,
        size_monitor: size_monitor,
        gpu: gpu,
        antivirus: antivirus,
        ip_addr: ip_addr,
        location: location,
        department: department,
        factory: factory,
        status: status,
        created_at: created_at,
        note: note
    };

    const params = new URLSearchParams(data).toString();
    const url = `generate_pdf.php?${params}`;

    window.open(url, '_blank'); 
}
</script>
</html>
