(function ($) {
    "use strict";
    $(document).on('click','.createLiveLink', function () {
        let topic = $('.topic').val()
        let start_date = $('.date').val()
        let start_time = $('.start_time').val()
        let duration = $('.duration').val()
        let getZoomLinkRoute = $('.getZoomLinkRoute').val()

        toastr.options.positionClass = 'toast-bottom-right';
        if(topic == ''){
            toastr.error('Live class topic is required.')
            return
        }else if(start_date == ''){
            toastr.error('Live class date is required.')
            return
        } else if(duration == '') {
            toastr.error('Duration is required.')
            return
        }

        toastr.info('Please wait a second...')

        $.ajax({
            type: "POST",
            url: getZoomLinkRoute,
            data: {
                "topic": topic ,
                "start_date": start_date,
                "start_time": start_time,
                "duration": duration,
                '_token': $('meta[name="csrf-token"]').attr('content') },
            datatype: "json",
            success: function (response) {
                $('.join_url').val(response.data)
                toastr.success('Link created successfully.')
            }
        });

    });
})(jQuery)
