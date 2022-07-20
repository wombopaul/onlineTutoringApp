(function ($) {
    "use strict";
    $(function(){
        $('.viewMeetingLink').on('click', function(e){
            e.preventDefault();
            const modal = $('.viewMeetingLinkModal');
            modal.find('textarea[name=join_url]').val($(this).data('item').join_url)
            modal.find('input[name=join_url_copy]').val($(this).data('item').join_url)
            let join_url = $(this).data('item').join_url;
            $('.joinNow').attr("href", join_url)
            modal.modal('show')
        })
    })

    $(document).on('click', ".copyZoomUrl", function () {
        var copyText = document.getElementById("join_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.success('Copied URL');
    })
})(jQuery)
