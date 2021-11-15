<?
return function($type, $level, $state){
    switch ($type){
        case 'paragraph':
            $tag = 'p';
            break;
        case 'heading':
            $tag = 'h' . $level;
            break;
        case 'bullet_list':
            $tag = 'ul';
            break;
        case 'list_item':
            $tag = 'li';
            break;
    }
    if($state == 'open'){
        return '<' . $tag . '>';
    } elseif($state == 'close'){
        return '</' . $tag . '>';
    }
};