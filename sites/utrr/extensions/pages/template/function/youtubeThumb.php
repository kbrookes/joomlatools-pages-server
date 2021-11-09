<?

/// GET Max Sized Thumbnail
return function($videoID, $size) {
    $url = 'https://i.ytimg.com/vi/' . $videoID . '/' . $size . 'default.jpg';
    return $url;
};