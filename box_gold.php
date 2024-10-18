
<?php
// Đường dẫn tới API lấy dữ liệu giá vàng
$link = 'http://giavang.doji.vn/api/giavang/?api_key=258fbd2a72ce8481089d88c678e9fe4f';

// Tải dữ liệu XML từ API
$xml = simplexml_load_file($link);

// Chuyển đổi XML sang JSON
$xmlJSON = json_encode($xml);

// Giải mã JSON thành mảng PHP
$xmlArr = json_decode($xmlJSON, true);

// Lấy danh sách các dòng vàng từ mảng đã giải mã
$goldList = array_column($xmlArr['DGPlist']['Row'], '@attributes');


// Bắt đầu hiển thị bảng HTML với dữ liệu động
echo '<h3 class="mb-1">Giá vàng</h3>
    <div class="card card-body" id="box-gold">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th><b>Loại vàng</b></th>
                    <th><b>Mua vào</b></th>
                    <th><b>Bán ra</b></th>
                </tr>
            </thead>
            <tbody>';

// Vòng lặp qua danh sách vàng để hiển thị dữ liệu động
foreach ($goldList as $gold) {
    echo '<tr>';
    echo '<td>' . (isset($gold['Name']) ? $gold['Name'] : 'N/A') . '</td>'; // Loại vàng
    echo '<td>' . (isset($gold['Buy']) ? $gold['Buy'] : 'N/A') . '</td>';   // Giá mua vào
    echo '<td>' . (isset($gold['Sell']) ? $gold['Sell'] : 'N/A') . '</td>'; // Giá bán ra
    echo '</tr>';
}

echo '</tbody>
        </table>
    </div>';
?>

