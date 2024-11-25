@extends('layouts.admin')

@section('main-content')
    <h1>QR Code Scanner</h1>
    <div id="reader" style="width:500px"></div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            $.ajax({
                url: "{{ _route('tickets.read') }}",
                type: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({
                    ticket: decodedText
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    alert('Bilet başarıyla okutuldu. Aktivite: ' + JSON.stringify(data));
                },
                error: function(error) {
                    console.error(error);
                    alert(error.responseJSON.errors.id[0]);
                }
            });
        }

        function onScanError(errorMessage) {
            // Handle scan error
            //console.log(`Scan error: ${errorMessage}`);
        }

        // Start the scanner
        const html5QrCode = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: 250 };

        html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess, onScanError)
            .catch(err => {
                //console.log(`Unable to start scanning, error: ${err}`);
            });
    </script>
@endpush