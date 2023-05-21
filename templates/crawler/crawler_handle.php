<?php
// header('Content-Type: application/json');
session_start();
$return_msg = "";
// 将最大执行时间设置为 300 秒
ini_set('max_execution_time', 300);

if (isset($_POST["wb_name"]) && isset($_POST["pageURL"]) && isset($_SESSION["user"])) {

    $wb_name = $_POST["wb_name"];
    $pageURL = $_POST["pageURL"];
    $addBgm = $_POST["addBgm"];

    // 调用Python脚本
    if ($_SESSION["user"]["permission"] == "owner") {
        list($output, $exitCode) = callPythonScriptToDB($wb_name, $pageURL, $addBgm);
        $return_msg = $output;
    } else if ($_SESSION["user"]["permission"] == "user") {
        list($output, $exitCode) = callPythonScriptToDocx($wb_name, $pageURL);
        $return_msg = $output;
    }
} else {
    $return_msg = "你沒有輸入網址或沒有登入";
}

// 调用Python脚本
function callPythonScriptToDB($wb_name, $pageURL, $addBgm)
{
    // Python脚本文件路径
    $pythonScript = '../../scripts/crawler/crawler.py';
    // 要调用的Python函数名和参数
    $functionName = 'crawlerToDB';
    $arguments = "\"$pythonScript\" \"$functionName\" \"$pageURL\" \"$wb_name\" \"$addBgm\"";
    // 构建Python脚本的命令
    $command = "python $arguments";

    // 执行命令并获取输出
    // $output = shell_exec($command);
    $output = array();
    $exitCode = null;

    exec($command, $output, $exitCode);
    $outputString = implode('. ', $output);

    // 返回Python脚本的输出
    return array($outputString, $exitCode);
}
function callPythonScriptToDocx($wb_name, $pageURL)
{
    // Python脚本文件路径
    $pythonScript = '../../scripts/crawler/crawler.py';
    // 要调用的Python函数名和参数
    $functionName = 'crawlerToDocx';
    $arguments = "\"$pythonScript\" \"$functionName\" \"$pageURL\" \"$wb_name\"";
    // 构建Python脚本的命令
    $command = "python $arguments";

    // 执行命令并获取输出
    $output = array();
    $exitCode = null;

    exec($command, $output, $exitCode);

    if (!empty($output) && strpos(end($output), "static\\novel") !== false) { //strpos()函数返回的是匹配字符串的位置，而不是布尔值
        $docxFilePath = end($output); // Python 脚本返回的是 DOCX 文件的路径
    } else if (!empty($output) && strpos(end($output), "static\\novel") === false) {
        array_push($output, "Download Failed.");
        $outputString = implode('. ', $output);
        return array($outputString, $exitCode);
    } else {
        // 处理数组为空的情况
        return array("No corresponding file.", $exitCode);
    }

    // 检查 DOCX 文件是否存在
    if (file_exists($docxFilePath)) {
        // 设置文件头信息
        header('Content-Description: File Transfer'); //指定响应的内容类型为二进制流，这样浏览器会将文件视为下载文件而不是直接打开
        header('Content-Type: application/octet-stream'); //指定响应的内容类型为二进制流，这样浏览器会将文件视为下载文件而不是直接打开
        header('Content-Disposition: attachment; filename="' . basename($docxFilePath) . '"'); //basename($docxFilePath) 获取了文件路径中的文件名部分
        header('Expires: 0'); //basename($docxFilePath) 获取了文件路径中的文件名部分
        header('Cache-Control: must-revalidate'); //要求浏览器在使用缓存之前验证文件的有效性
        header('Pragma: public'); //兼容旧版本 HTTP 协议的头字段，指示响应可被公开缓存
        header('Content-Length: ' . filesize($docxFilePath)); //指定响应内容的长度，即文件的大小

        // 读取并输出文件内容
        readfile($docxFilePath);

        // 删除临时文件
        unlink($docxFilePath);
        if (count($output) > 0) {
            array_pop($output); // 移除最后一个元素
        }
        array_push($output, "Download Successfully.");
        $outputString = implode('. ', $output);
        return array($outputString, $exitCode);
    } else {
        array_push($output, "DOCX file doesn\'t exist.");
        $outputString = implode('. ', $output);
        return array($outputString, $exitCode);
    }
}
$url = "../crawler.php";

if ($return_msg != "") {
    $_SESSION["show_message"] = $return_msg;
}

// 构建结果数组
// $result = array(
//     'status' => $exitCode === 0 ? 'finished' : 'error',
//     'output' => $outputString
// );

// // 将结果转换为 JSON 字符串
// $jsonResult = json_encode($result);

// // 输出 JSON 字符串
// echo $jsonResult;

// // 停止脚本的执行
// exit();
?>

<script>
    window.location.href = '<?= $url ?>';
</script>

<?php exit(); ?>