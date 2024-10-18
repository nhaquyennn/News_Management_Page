<?php
// Đường dẫn tới RSS feed của VnExpress
$rss = 'https://vnexpress.net/rss/the-thao.rss';

// Tải dữ liệu XML từ RSS feed
$xml = simplexml_load_file($rss);

// Kiểm tra nếu tải thành công
if ($xml === false) {
    echo "Không thể tải RSS feed.";
    exit;
}

// Bắt đầu hiển thị từng mục trong RSS feed
foreach ($xml->channel->item as $item) {
    // Lấy đường dẫn ảnh từ mô tả 
    preg_match('/<img[^>]+src="([^">]+)"/', $item->description, $matches);
    $image = $matches[1] ?? 'images/default.jpg';  // Nếu không có ảnh, dùng ảnh mặc định

    // Link tới bài viết gốc
    $link = $item->link;

    // Hiển thị theo cấu trúc HTML và class CSS 
    echo '<div class="col-md-6 col-lg-4 p-3">';
    echo '<div class="entry mb-1 clearfix">';
    
    // Phần ảnh với background từ RSS
    echo '<div class="entry-image mb-3">';
    echo '<a href="' . $image . '" data-lightbox="image" style="background: url(' . $image . ') no-repeat center center; background-size: cover; height: 278px;"></a>';
    echo '</div>';
    
    // Phần tiêu đề bài viết
    echo '<div class="entry-title">';
    echo '<h3><a href="' . $link . '" target="_blank">' . $item->title . '</a></h3>';
    echo '</div>';
    
    // Mô tả bài viết
    echo '<div class="entry-content">';
    echo strip_tags($item->description);  // Hiển thị mô tả, loại bỏ các thẻ HTML
    echo '</div>';
    
    // Thông tin meta như ngày đăng và nguồn
    echo '<div class="entry-meta no-separator nohover">';
    echo '<ul class="justify-content-between mx-0">';
    echo '<li><i class="icon-calendar2"></i> ' . date("d/m/Y H:i:s", strtotime($item->pubDate)) . '</li>';
    echo '<li>vnexpress.net</li>';
    echo '</ul>';
    echo '</div>';
    
    // Nút "Xem" dẫn đến bài viết gốc
    echo '<div class="entry-meta no-separator hover">';
    echo '<ul class="mx-0">';
    echo '<li><a href="' . $link . '" target="_blank">Xem &rarr;</a></li>';
    echo '</ul>';
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
}
?>
