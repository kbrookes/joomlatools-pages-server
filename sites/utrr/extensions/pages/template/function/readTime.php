<?
return function($postContent){
    if(is_array($postContent)){
        $fullText = $postContent;
        foreach($fullText as $content){
            $paras = $content['content'];
            foreach($paras as $para){
                $paras .= $para['text'];
            }
        }
        $fullText = $paras;
    } else {
        $fullText = $postContent;
    }

    $word = str_word_count(strip_tags($fullText));
    $m = floor($word / 200);
    $s = floor($word % 200 / (200 / 100));
    $count = $m + ($s/100);
    $count = round($count < 1 ? 1 : $count );
    $est = $count . ' minute';

    return $est;
};