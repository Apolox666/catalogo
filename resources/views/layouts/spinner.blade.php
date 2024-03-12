@push('js')
<script>
    window.addEventListener('beforeunload', function() {
        showLoading('Loading...');
    });

    window.addEventListener('load', function() {
        closeSwalWhilePageLoaded();
    });

    const showLoading = function(message=null) {
        let text = "<b>Be patient.</b><br/>"
        text += (message && message.length>0) ? message : 'This might take a few moments to load.'
        swal({
            title: 'sdfdsfdsf',
            text: text,
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        })
    };

    function closeSwalWhilePageLoaded(){
        setTimeout(() => {
            swal.close();
        }, 500);
    }
</script>
@endpush