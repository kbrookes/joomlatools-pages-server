<?
return function($text, $marks){
    if(!empty($marks)){
        foreach($marks as $mark){
            $elm = $mark['type'];
            switch ($elm){
                case 'bold':
                    $elm = 'strong';
                    break;
                case 'italic':
                    $elm = 'em';
                    break;
                case 'strike':
                    $elm = $elm;
                    break;
                case 'underline':
                    $elm = 'u';
                    break;
            }
            return '<' . $elm . '>' . $text . '</' . $elm . '>';
        }
    } else {
        return $text;
    }
};