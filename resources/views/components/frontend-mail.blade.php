@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <style>
        .notyf__toast {
            max-width: 36em !important;
        }

        .notyf__ripple {
            height: 60em !important;
            width: 60em !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            function getMails() {
                fetch('{{ route('frontend-mail', ['id' => session()->get('frontend-mail-id')]) }}')
                .then(response => response.json())
                .then(function(mails) {
                    mails.forEach(function(mail) {
                        var notyf = new Notyf();

                        notyf.success({
                            className: 'toast-custom-notyf',
                            duration: 8000,
                            dismissible: true,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                            background: 'blue',
                            icon: false,
                            message: '<strong>Mail to: ' + mail.to[0]['name'] + '<br><br><strong>' + mail.subject + '</strong><br><br>' + mail.body
                        });
                    });
                })
                setTimeout(getMails, 2500);
            }
            getMails();
        });
    </script>
@endpush

