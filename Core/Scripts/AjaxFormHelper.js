$(function() {
	$('.data-ajax-form').submit(function () {
        var replaceTarget = $(this).attr('data-replace-target');
        
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize()
        }).done(function (result) {
            $('#' + replaceTarget).html(result);
        });

        return false;
    });
});