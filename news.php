<?php
function hienThiRssFeed($rssUrl = 'https://vnexpress.net/rss/the-thao.rss', $limit = 6) 
{
    if (!($xml = simplexml_load_file($rssUrl))) return "Không thể tải RSS feed.";
    
    $output = '';
    $count = 0; // Biến đếm số lượng bài viết

    foreach ($xml->channel->item as $item) 
    {
        if ($count >= $limit) break; // Dừng khi đã hiển thị đủ số lượng bài viết mong muốn
        
        preg_match('/<img[^>]+src="([^">]+)"/', $item->description, $matches);
        $image = $matches[1] ?? 'images/default.jpg';
        $output .= '
            <div class="col-md-6 col-lg-4 p-3">
                <div class="entry mb-1 clearfix">
                    <div class="entry-image mb-3">
                        <a href="' . $image . '" data-lightbox="image" style="background: url(' . $image . ') no-repeat center; background-size: cover; height: 278px;"></a>
                    </div>
                    <div class="entry-title">
                        <h3><a href="' . $item->link . '" target="_blank">' . $item->title . '</a></h3>
                    </div>
                    <div class="entry-content">' . strip_tags($item->description) . '</div>
                    <div class="entry-meta no-separator nohover">
                        <ul>
                            <li><i class="icon-calendar2"></i> ' . date("d/m/Y H:i:s", strtotime($item->pubDate)) . '</li>
                            <li>vnexpress.net</li>
                        </ul>
                    </div>
                    <div class="entry-meta no-separator hover">
                        <ul><li><a href="' . $item->link . '" target="_blank">Xem &rarr;</a></li></ul>
                    </div>
                </div>
            </div>';
        
        $count++; // Tăng biến đếm
    }
    return $output;
}

echo hienThiRssFeed();
?>
