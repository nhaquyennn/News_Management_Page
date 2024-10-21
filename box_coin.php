<?php
// Đường dẫn tới API lấy giá coin từ Binance
$link = 'https://api.binance.com/api/v3/ticker/24hr';

// Lấy dữ liệu JSON từ API
$coinDataJSON = file_get_contents($link);

// Chuyển đổi JSON thành mảng PHP
$coinData = json_decode($coinDataJSON, true);

// Bắt đầu hiển thị bảng HTML với dữ liệu động
echo '<h3 class="mb-1">Giá coin</h3>
    <div class="card card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Price (USD)</b></th>
                    <th><b>Change (24h)</b></th>
                </tr>
            </thead>
            <tbody>';
                // Duyệt qua từng đồng coin và hiển thị dữ liệu
                foreach ($coinData as $coin) {
                    // Chỉ lấy các coin phổ biến như BTC, ETH, XRP...
                    if (in_array($coin['symbol'], ['BTCUSDT', 'ETHUSDT', 'XRPUSDT', 'LTCUSDT', 'BCHUSDT'])) {
                        $change_24h = $coin['priceChangePercent'];  // Lấy phần trăm thay đổi trong 24h
                        $change_color = $change_24h >= 0 ? 'green' : 'red';  // Xác định màu sắc dựa trên thay đổi

                        // Hiển thị dữ liệu cho mỗi coin
                        echo '<tr>';
                        echo '<td>' . strtoupper(str_replace('USDT', '', $coin['symbol'])) . '</td>'; // Tên coin
                        echo '<td>$' . number_format($coin['lastPrice'], 2) . '</td>';  // Giá hiện tại
                        echo '<td style="color:' . $change_color . ';">' . number_format($change_24h, 2) . '%</td>';  // Thay đổi phần trăm trong 24h
                        echo '</tr>';
                    }
                }
echo '      </tbody>
        </table>
    </div>';
?>
