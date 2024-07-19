<!-- Libs JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.28.3/dist/apexcharts.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/toolbar/prism-toolbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js">
</script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

{{-- lottie icon --}}
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

<!-- Theme JS -->
<!-- build:js @@webRoot/assets/js/theme.min.js -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/feather.js') }}"></script>
<script src="{{ asset('js/sidebarMenu.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "search": "",
                "searchPlaceholder": "Search...",
                "decimal": ",",
                "thousands": ".",
            },
        });

        $('.dataTables_filter input[type="search"]').css({
            "marginBottom": "10px"
        });
    });
</script>


<!-- endbuild -->
