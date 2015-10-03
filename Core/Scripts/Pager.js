$(function () {
    $('#main').on('click', '[data-pager] a', function () {
        var href = $(this).attr('href');
        if (!href) {
            return false;
        }
        var replaceTarget = $(this).closest('[data-pager]').attr('data-replace-target');
        //var searchOptions = $(this).closest('[data-blog-search]').attr('data-blog-search');

        $.ajax({
            url: href,
            type: 'GET',
            //data: $('.' + searchOptions).serialize()
        }).done(function (result) {
            $('#' + replaceTarget).html(result);
        });
        return false;
    });
});