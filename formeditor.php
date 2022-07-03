<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div id="wrapper">
    <div class="content">
        <div class="">
            <div class="">
            <div class="">
            <div class="row">
                    <div class="col-md-12">
                        <div class="panel_s mbot5">
                            <div class="panel-body padding-10">
                                <?= $breadcrumb ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="col-md-12">
                                <div class="top-lead-menu" style="margin-top: 8px;">
                                    <h4 style="margin-left:14px; display:inline;"><?= $heading ?></h4>
                                    <hr> 
                                </div>
                            
                            <div id="selectmsgdiv">
                                <span style="color:green;" class="" id="questionmsg"></span>
                                <select id="addquestionselect" onchange="addquestion(this);" class="form-control" style="width:20%; float:right;">
                                    <option value=''>select type</option>
                                    <option value="radio">radio</option>
                                    <option value="checkbox">checkbox</option>
                                    <option value="input">input</option>
                                    <option value="textarea">textarea</option>
                                </select>
                            </div>
                        
                        <div class="form-group newquestionbox" id="newradio" style="display:none;">
                            <form>
                                <label style="float:right;"><?= _l('question_type_radio') ?></label><br>
                                <label style=""><?= _l('quesiton_title') ?></label>
                                <input class="form-control titlequestion" type="text" id="newradio_title" placeholder="question title" />
                                <br>
                                <label style=><?= _l('options') ?></label><br>
                                <div>
                                    <input style="display:inline-block; width:90%;" class="form-control" type="text" name="newradio_radio1" id="newradio_radio1" />
                                    <span class="btn btn-success" onclick="addanotherradio(this)">+</span>
                                </div>
                            </form>
                            <button onclick="savequestion(this)" style="margin-top:10px" class="btn btn-info"><?= _l('save') ?></button>
                        </div>

                        
                        <div class="form-group newquestionbox" id="newcheckbox" style="display:none;">
                            <label style="float:right;"><?= _l('question_type_checkbox') ?></label><br>
                            <label style=""><?= _l('quesiton_title') ?></label>
                            
                            <input class="form-control titlequestion" type="text" id="newcheckbox_title" placeholder="question title" />
                            <br>
                            <label style=><?= _l('options') ?></label><br>
                            <div>
                                <input style="display:inline-block; width:90%;" class="form-control" type="text" name="newcheckbox_checkbox1" id="newcheckbox_checkbox1" />
                                <span style="" class="btn btn-success" onclick="addanothercheckbox(this)">+</span>
                            </div>
                            <button onclick="savequestion(this)" style="margin-top:10px" class="btn btn-info"><?= _l('save') ?></button>
                        </div>

                        
                        <div class="form-group newquestionbox" id="newinput" style="display:none;">
                            <label style="float:right;"><?= _l('question_type_input') ?></label>
                            <label style=""><?= _l('quesiton_title') ?></label>
                            <input class="form-control titlequestion" type="text" id="newinpu_title" placeholder="question title" />
                            <button onclick="savequestion(this)" style="margin-top:10px" class="btn btn-info"><?= _l('save') ?></button>   
                        </div>

                        
                        <div class="form-group newquestionbox" id="newtextarea" style="display:none;">
                            <label style="float:right;"><?= _l('question_type_textarea') ?></label><br>
                            <label style=""><?= _l('quesiton_title') ?></label>
                            <input class="form-control titlequestion" type="text" id="newtextarea_title" placeholder="question title" />
                            
                            <button onclick="savequestion(this)" style="margin-top:10px" class="btn btn-info"><?= _l('save') ?></button>
                        </div>

                        <div style="margin-top:80px;" id="insertinto" class="breadcrumb"></div>
                        <hr>
                        <div class="" id="inserted">


                            <?php foreach($qs as $a){
                             
                                $qt = explode('qtype=', $a['question'])[1];
                                $qtype = explode('andandquestionis==', $qt)[0];

                                $ques = explode('andandquestionis==', $a['question'])[1];
                                $ques = explode('andandoptionsare==', $ques)[0];
                                
                                if(trim($qtype) == 'radio' || trim($qtype) == 'checkbox'){
                                    $options = explode('andandnextoptionsis==', $a['question']);

                              
                                    if (str_contains($options[0], 'andandoptionsare==')) { 
                                                
                                        $options[0] = explode('andandoptionsare==', $options[0])[1];
                                    }
    
                                    $options[sizeof($options)-1] = trim($options[sizeof($options)-1]);
                                }
                               

                                
                                ?>
                                <div qtype="<?= trim($qtype) == 'radio' ?>" class="breadcrumb" dataid="<?= $a['id']; ?>" style="background: #e7e7e7;">
                                    <label data-toggle="modal" data-target="#exampleModalresult" onclick="getresultofthissurvey(<?= $a['id'] ?>, this);" style="float:left; cursor:pointer; color:blue;"><?= _l('result') ?></label>
                                    <label style="float:right;"><?= _l('question_type_'.$qtype) ?></label><hr>
                                    <label><?= _l('title') ?></label>
                                    <input qtype="<?= trim($qtype); ?>" type="text" id="insertedtitle" value="<?= $ques; ?>" class="form-control" />
                                    <?php   if(trim($qtype) == 'radio' || trim($qtype) == 'checkbox'){ ?>
                                            <div>
                                                <label style="margin-top:10px;"><?= _l('options') ?></label>
                                                <?php foreach($options as $o){
                                                    if(strlen($o) != 0){
                                                    ?>
                                                    <input style="margin-top:5px;" type="text" id="<?= trim($qtype);?>insertedoptions_" value="<?= $o ?>" class="form-control options" />
                                                    
                                                    <?php
                                                    }
                                                } ?>
                                            </div>
                                    <?php } ?>
                                    <button style="margin-top: 5px;" onclick="updatethisquestion(this);" class="btn btn-success"><?= _l('update') ?></button>
                                    <button style="margin-top: 5px; float:right;" onclick="deletethisquestion(this);" class="btn btn-danger"><?= _l('delete') ?></button>
                                
                                </div>
                               
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
        </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>


   function addquestion(v){

        if($(v).val() == 'radio'){

            $('#insertinto').html($('#newradio').html());
            $('#questionmsg').html("");

        }
        if($(v).val() == 'checkbox'){
            
            $('#insertinto').html($('#newcheckbox').html());
            $('#questionmsg').html("");
        }
        if($(v).val() == 'input'){
            
            $('#insertinto').html($('#newinput').html());
            $('#questionmsg').html("");
        }
        if($(v).val() == 'textarea'){
            
            $('#insertinto').html($('#newtextarea').html());
            $('#questionmsg').html("");
        }
        if($(v).val() == '' || $(v).val() == null || $(v).val() == undefined){

            $('#insertinto').html("");
        }
   }

   function addanothercheckbox(v){
    
        $(v).parent().append('<input type="text" name="newcheckbox_checkbox" id="newcheckbox_checkbox" class="form-control" style="margin-top:10px; display:inline-block; width:90%;" /><span style="margin-left:3px;" class="btn btn-danger" onclick="removethisradio(this)">x</span>')
        
        setidsofnewcheckboxes();
    }
    
    function removethischeckbox(v){

        $(v).prev().remove();
        $(v).remove();

        setidsofnewcheckboxes();
    }

    
   function setidsofnewcheckboxes(){

        $('[id^="newcheckbox_checkbox"]').each(function(){

            $(this).attr('id', 'newcheckbox_checkbox'+$(this).index());
        });
    }


   function addanotherradio(v){

        
        $(v).parent().append('<input type="text" name="newradio_radio" id="newradio_radio" class="form-control" style="margin-top:10px; display:inline-block; width:90%;" /><span style="margin-left:3px;" class="btn btn-danger" onclick="removethisradio(this)">x</span>')
        
        setidsofnewradios();
    }

   function removethisradio(v){

        $(v).prev().remove();
        $(v).remove();

        setidsofnewradios();
   }

   function setidsofnewradios(){

            $('[id^="newradio_radio"]').each(function(){

                $(this).attr('id', 'newradio_radio'+$(this).index());
            });
   }

   function savequestion(v){

        if($('#addquestionselect').val() == 'radio'){

            qtype = 'radio';
           
            question = $(v).parent().find('.titlequestion').val();
            opts = ' andandoptionsare== ';
            $(v).parents('#insertinto').find('[id^="newradio_radio"]').each(function(){

                opts = opts+$(this).val()+' andandnextoptionsis== ';
            });

           
        }

        if($('#addquestionselect').val() == 'checkbox'){

                qtype = 'checkbox';

                question = $(v).parent().find('.titlequestion').val();
                opts = ' andandoptionsare== ';
                $(v).parents('#insertinto').find('[id^="newcheckbox_checkbox"]').each(function(){

                    opts = opts+$(this).val()+' andandnextoptionsis== ';
                });


            }

            if($('#addquestionselect').val() == 'input'){

                qtype = 'input';

                question = $(v).parent().find('.titlequestion').val();
                opts = '';
                


            }

            if($('#addquestionselect').val() == 'textarea'){

                qtype = 'textarea';

                question = $(v).parent().find('.titlequestion').val();
                opts = '';



            }
        

        $.ajax({

            url: window.location.href.split('survey')[0]+'addsurvey',
            method: 'POST',
            data: {opts: 'qtype='+qtype+' '+' andandquestionis=='+question+' '+opts, sid:window.location.href.split('sub=')[1]},
            success(d){
                
                if(d != false){

                    $('#insertinto').clone().appendTo('#inserted');
                    id = $('#inserted').find('.breadcrumb:last').attr('id');
                    $('#inserted').find('.breadcrumb:last').attr('id', id+'_'+d);
                    $('#inserted').find('.breadcrumb:last').find('.btn-info').attr('onclick', 'updatethisquestion(this)');
                    $('#inserted').find('.breadcrumb:last').find('.btn-danger').remove()
                    $('#inserted').find('.breadcrumb:last').find('.btn-success').remove()
                    $('#inserted').find('.breadcrumb:last').attr('dataid', id);
                    $('#inserted').find('.breadcrumb:last').find('.btn-info').text('update');
                    $('#inserted').find('.breadcrumb:last').append('<button style="margin-top:10px; float:right;" class="btn btn-danger" onclick="deletethisquestion(this);">delete</button>');
                    $('#addquestionselect').val('');
                    $('#addquestionselect').trigger('change');
                    $('#questionmsg').html("<?= _l('question_successfully_created') ?>");
                    //$('#questionmsg').addClass('alert alert-success')
                }
            }
        });
        
   }

   function updatethisquestion(v){



    qtype = $(v).parent().find('#insertedtitle').attr('qtype');
    question = $(v).parent().find('#insertedtitle').val();
    opts = ' andandoptionsare== ';
            $(v).parent().find('.options').each(function(){

                opts = opts+$(this).val()+' andandnextoptionsis== ';
            });

                $.ajax({

                            url: window.location.href.split('survey')[0]+'updatesurvey',
                            method: 'POST',
                            data: {opts: 'qtype='+qtype+' '+' andandquestionis=='+question+' '+opts, id:$(v).parent().attr('dataid')},
                            success(d){
                                
                                // if(d != false){

                                //     $('#insertinto').clone().appendTo('#inserted');
                                //     id = $('#inserted').find('.breadcrumb:last').attr('id');
                                //     $('#inserted').find('.breadcrumb:last').attr('id', id+'_'+d);
                                    
                                // }
                            }
                    });
   }

   function deletethisquestion(v){

                $.ajax({

                        url: window.location.href.split('survey')[0]+'deletesurvey',
                        method: 'POST',
                        data: {id:$(v).parent().attr('dataid')},
                        success(d){
                            
                            if(d == true){
                                $(v).parent().remove();
                            }
                        }
            });

   }



</script>
