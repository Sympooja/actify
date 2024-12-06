<?php

function getCategoryTag($category_name)
{
    $term_ids = get_terms([
        'fields' => 'ids',
        'taxonomy' => 'category',
        'name' => $category_name,
        'hide_empty' => false,
    ]);
    $term_color = get_field('color', 'term_' . $term_ids[0]);
    $term_class_color = 'bg-blue';

    switch ($term_color) {
        case 'green':
            $term_class_color = 'bg-green';
            break;
        case 'faded-aqua':
            $term_class_color = 'bg-faded-aqua';
            break;
        case 'aqua':
            $term_class_color = 'bg-aqua';
            break;
        case 'dark-navy':
            $term_class_color = 'bg-dark-navy';
            break;
        case 'faded-blue-two':
            $term_class_color = 'bg-faded-blue-two';
            break;
        case 'dark-blue-two':
            $term_class_color = 'bg-dark-blue-two';
            break;
        case 'light-blue':
            $term_class_color = 'bg-light-blue';
            break;
        case 'cyan':
            $term_class_color = 'bg-cyan';
            break;
        default:
            break;
    }
    return $term_class_color;
}

?>
