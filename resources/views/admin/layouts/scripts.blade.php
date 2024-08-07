<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('dashboard_assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('dashboard_assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
{{-- @vite('resources/js/app.js') --}}
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('9d1cf373a746f7003b66', {
        cluster: 'eu'
    });
    const SwalModal = (title, type, url) => {
        swal.fire({
            title: title,
            icon: type,
            confirmButtonText: '{{ __('dash.ok') }}',
            confirmButtonColor: '#00a39a',
        }).then(function() {
            if (url)
                window.location = url;
        });
    };
    const userId = {{ auth()->user()->id }};

    $('#alert-btn').on('click', function() {
        var notifications = $('#kt_header_notification_menu_toggle').find('.menu');
        var notificationsCountElem = $('#kt_header_notification_menu_toggle').find('.badge');
        var notificationsCount = parseInt(notificationsCountElem.attr('data-count'));
        if (notificationsCount > 0) {
            notificationsCountElem.attr('data-count', 0);
            notificationsCountElem.text(0);
            $.ajax({
                url: "{{ route('dashboard.notifications.read') }}",
                type: 'GET',
                data: {
                    'number_user': userId,
                },
            });
        }
    });





    var channel = pusher.subscribe(`real-notification-${userId}`);
    channel.bind("App\\Events\\RealNotification", function(data) {
        var notifications = $('#kt_header_notification_menu_toggle').find('.menu');
        var notificationsCountElem = $('#kt_header_notification_menu_toggle').find('.badge');
        var notificationsCount = parseInt(notificationsCountElem.attr('data-count'));
        notificationsCountElem.attr('data-count', notificationsCount + 1);
        notificationsCountElem.text(notificationsCount + 1);
        if (data.is_active == 1) {
            notifications.prepend(`
                <div>
                    <div class="menu-item px-5 py-4" style="cursor: default">
                        <div>
                            {{ __('dash.offer_status_changed_to_active') }}
                            {{ __('dash.number') }} : ${data.unique_code}
                        </div>
                        <div class="separator my-2"></div>

                    </div>
                </div>
            `);
        } else {
            notifications.prepend(`
                <div>
                    <div class="menu-item px-5 py-4" style="cursor: default">
                        <div>
                            {{ __('dash.offer_status_changed_to_inactive') }}
                            {{ __('dash.number') }} : ${data.unique_code}
                        </div>
                        <div class="separator my-2"></div>
                    </div>
                </div>
            `);
        }
        console.log("wiwiww", data);
    });
</script>
@stack('script')
