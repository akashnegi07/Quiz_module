<?php 

namespace Drupal\quiz_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class helloform extends FormBase {

 public function getFormID(){
    return'drupalup_simple_form';
 }
 public function buildForm(array $form, FormStateInterface $form_state){
    global $temp;
    global $a;
    global $b;
    $a=1;
    $b=2;
    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');    
    $ids = $nodeStorage->getQuery()  
    ->condition('status', 1)  
    ->condition('type', 'quiz_question')
    ->execute();
    $articles = $nodeStorage->loadMultiple($ids);

 // $new = \Drupal::service('quiz_module.hello_form_2')->helloformtt();
  
  $c=key($articles);
   for($i=0;$i<count($articles);$i++)
   {
    $option =[];
    for ($j=0;$j<count($articles[$c]->field_answer);$j++)
    {
        $option[$j] = $articles[$c]->field_answer[$j]->value;
        
    }
     $form['select_fieldset_container'][$a] = [
         '#type' => 'fieldset',
        '#collapsible' => true,
         '#attributes' => ['id' => ['select_fieldset_container'][$a]],
         '#title' => t($articles[$c]->field_question->value),
     ];


     
     $form['select_fieldset_container'][$a][$b] = [
        '#type' => 'radios',
        'title' =>t('hello'),
        '#options' => $option,
        '#ajax' => [
            'callback' => '::instrumentDropdownCallback',
            'wrapper'  =>  ['select_fieldset_container'][$a],
            'event' => 'change',
        ],
    ];

   // $temp[$b]=$form_state->getValue($b);

    $a++;
    $b++;
  $c=next($articles)->nid->value;

}
$temp=$b;


    $form['submit']=[
        '#type' => 'submit',
        '#value' => $this->t('Calulate the total number'),
       ];
       return $form;
 }

 public function instrumentDropdownCallback(array $form, FormStateInterface $form_state) {
    print_r("hello");
    die();
    return $form['select_fieldset_container'][$a];
  }

 public function submitform(array &$form, FormStateInterface $form_state){
    echo"<pre>";
    global $temp;
    $new_option=[];
    $new;
    for($i=2;$i<=$temp-1;$i++)
    {
   $new_option[$i]=$form_state->getValue($i);
   
    }
    $new = \Drupal::service('quiz_module.hello_form_2')->helloformtt($new_option);

 }
}
