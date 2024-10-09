<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
include('connection.php');

function addDevice($conn, $data)
{
    $createdAt = date("Y-m-d H:i:s");
    $stmt = $conn->prepare('INSERT INTO device (type_id, owner_name, com_name, mainboard, cpu, os, ram, fullharddisk, drive1, space1, used1,free1, drive2, space2, used2, free2, drive3, space3, used3, free3, manufacturer_monitor, serie_monitor,size_monitor, gpu, antivirus, ip_addr, location, department, note, created_at, updated_at, status, factory) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('issssssssssssssssssssssssssssssss', $data['type_id'], $data['owner_name'], $data['com_name'], $data['mainboard'], $data['cpu'], $data['os'], $data['ram'], $data['fullharddisk'], $data['drive1'], $data['space1'], $data['used1'], $data['free1'], $data['drive2'], $data['space2'], $data['used2'], $data['free2'], $data['drive3'], $data['space3'], $data['used3'], $data['free3'], $data['manufacturer_monitor'], $data['serie_monitor'], $data['size_monitor'], $data['gpu'],  $data['antivirus'], $data['ip_address'], $data['location'], $data['department'], $data['note'], $data['buy_date'], $createdAt, $data['status'], $data['factory']);
    $stmt->execute();
}


function deleteDevice($conn, $id)
{
    $stmt = $conn->prepare('DELETE FROM device WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

function updateDevice($conn, $data)
{
    $createdAt = date("Y-m-d H:i:s");
    $stmt = $conn->prepare('UPDATE device SET type_id = ?, owner_name = ? ,com_name = ?, mainboard = ?, cpu = ?, os = ?, ram = ?, fullharddisk = ?, drive1 = ? ,space1 = ?, used1 = ?, free1 = ?, drive2 = ? ,space2 = ?, used2 = ?, free2 = ?, drive3 = ? ,space3 = ?, used3 = ?, free3 = ?, manufacturer_monitor = ?, serie_monitor = ?, size_monitor = ?,  gpu = ?, antivirus = ?, ip_addr = ?, location = ?, department = ?, note = ?, created_at = ?, updated_at = ?, status = ?, factory = ? WHERE id = ?');
    $stmt->bind_param('issssssssssssssssssssssssssssssssi', $data['type_id'], $data['owner_name'], $data['com_name'], $data['mainboard'], $data['cpu'], $data['os'], $data['ram'], $data['fullharddisk'], $data['drive1'], $data['space1'], $data['used1'], $data['free1'], $data['drive2'], $data['space2'], $data['used2'], $data['free2'], $data['drive3'], $data['space3'], $data['used3'], $data['free3'], $data['manufacturer_monitor'], $data['serie_monitor'], $data['size_monitor'], $data['gpu'], $data['antivirus'], $data['ip_address'], $data['location'], $data['department'], $data['note'], $data['buy_date'], $createdAt, $data['status'], $data['factory'], $data['id']);
    $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {                                                                          
        switch ($_POST['action']) {
            case 'add':
                addDevice($conn, $_POST);
                // var_dump($_POST);
                break;
            case 'delete':
                deleteDevice($conn, $_POST['id']);
                break;
            case 'edit':
                updateDevice($conn, $_POST);
                break;
        }
    }
}
$typed = $conn->prepare('SELECT * FROM type_device');
$typed->execute();
$row_type = $typed->get_result();

$device = $conn->prepare('SELECT device.*,type_device.typename FROM device,type_device WHERE device.type_id=type_device.id ORDER BY id DESC');
$device->execute();
$row_device = $device->get_result();

$operating = $conn->prepare('SELECT * FROM operating');
$operating->execute();
$row_operating = $operating->get_result();

$department = $conn->prepare('SELECT * FROM department');
$department->execute();
$row_department = $department->get_result();

$location = $conn->prepare('SELECT * FROM location');
$location->execute();
$row_location = $location->get_result();
