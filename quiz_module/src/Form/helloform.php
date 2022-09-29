<?php 

namespace Drupal\quiz_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class helloform extends FormBase {
 public function getFormID(){
     return'drupalup_simple_form';
 }
 public function buildForm(array $form, FormStateInterface $form_state){
    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');    
    $ids = $nodeStorage->getQuery()  
    ->condition('status', 1)  
    ->condition('type', 'quiz_question')
    ->execute();
    $articles = $nodeStorage->loadMultiple($ids);
    //echo "<pre>";
    //print_r(next($articles));
    //die();
  $temp="akash";
  $new = \Drupal::service('quiz_module.hello_form_2')->helloformtt();
  print_r($new);
  die();
  $a=1;
  $b=2;
  $c=key($articles);
   for($i=0;$i<count($articles);$i++)
   {
    $option =[];
    for ($j=0;$j<count($articles[$c]->field_answer);$j++)
    {
        $option[$j] = $articles[$c]->field_answer[$j]->value;
        
    }

     $form[$a] = [
         '#type' => 'fieldset',
         '#collapsible' => true,
         '#title' => t($articles[$c]->field_question->value),
     ];
     
     $form[$a][$b] = [
        '#type' => 'radios',
        '#options' => $option,
    ];
  
  $a++;
  $b++;
  $c=next($articles)->nid->value;

}
    $form['submit']=[
        '#type' => 'submit',
        '#value' => $this->t('Calulate the total number'),
       ];
       return $form;
 }
 public function submitform(array &$form, FormStateInterface $form_state){
    druapl_set_message($form_state->getvalue('number_1') + $form_state->getvalue('number_2'));
 }
}
