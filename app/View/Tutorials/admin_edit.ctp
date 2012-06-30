<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
 <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas({fullPanel : true}) });
  //]]>
</script>
<div class="tutorials form">
    <h2><?php echo __('Add Tutorial'); ?></h2>
    <?php
        echo $this->Form->create('Tutorial', $twitterBootstrapCreateOptions);
        echo $this->Form->hidden('id');
        echo $this->Form->input('subject_id', array('empty' => true));       
        echo $this->Form->input('name');       
        echo $this->Form->input('content', array('type' => 'textarea', 'style' => 'width:600px; height:300px;'));       
       
    
        echo $this->Form->end($twitterBootstrapEndOptions);
    ?>
</div>
