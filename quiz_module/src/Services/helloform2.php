<?php

namespace Drupal\quiz_module\Services;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\field\Entity\FieldStorageConfig;

class helloform2 {

    public function helloformtt ()  {
        $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');    
        $ids = $nodeStorage->getQuery()  
        ->condition('status', 1)  
        ->condition('type', 'quiz_logic')
        ->execute();
        $articles = $nodeStorage->loadMultiple($ids);
        $c=key($articles);
        echo "<pre>";
        print_r($articles[$c]->field_answer_one->value);
        print_r($articles[$c]->field_answer_->value);
        print_r($articles[$c]->field_answer_three->value);
        print_r($articles[$c]->field_answer_four->value);
        die();

    }

}
