/**
 * Created with JetBrains PhpStorm.
 * User: Giel
 * Date: 7-8-12
 * Time: 11:38
 * To change this template use File | Settings | File Templates.
 */

jQuery(function($){
    $('input[name="action[save]"]').click(function(e){
        e.preventDefault();
        // Make an Ajax-call to save the form:
        if(CKEDITOR)
        {
            for(var instanceName in CKEDITOR.instances)
            {
                CKEDITOR.instances[instanceName].updateElement();
            }
        }
        $('form').append('<input type="hidden" name="action[save]" class="temp_action" value="1" />');
        var data = $('form').serialize();
        $('form input.temp_action').remove();

        $.post($('form').attr('action'), data, function(){
            // Refresh opener & close window:
            window.opener.document.location.reload(true);
            window.close();
        });
    });
});