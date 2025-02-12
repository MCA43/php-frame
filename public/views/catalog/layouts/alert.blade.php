{{--Pozisyonlar--}}
{{--bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center--}}
@php
    $alert        = get_flash_data('alert');
    $welcome_user = get_flash_data("welcome_user")
@endphp

@if (!empty($alert))
    @if($alert["type"] === "success")
        <script>
            iziToast.success({
                timeout: 5000,
                title: '{{ $alert["title"] }}',
                message: '{{ $alert["text"] }}',
                @if(isset($alert["position"]))
                position: '{{ $alert["position"] }}',
                @else
                position: 'topCenter',
                @endif
                color: '#00ff00'
            })
            @if($alert["audio"])
            var audio = new Audio('{{ uploads_url("audios/".$alert["audio"]) }}');
            audio.play();
            @endif
        </script>
    @elseif($alert["type"] === "warning")
        <script>
            iziToast.warning({
                timeout: 5000,
                title: '{{ $alert["title"] }}',
                message: '{{ $alert["text"] }}',
                @if(isset($alert["position"]))
                position: '{{ $alert["position"] }}',
                @else
                position: 'topCenter',
                @endif
                color: '#ffb900'
            })
            @if($alert["audio"])
            var audio = new Audio('{{ uploads_url("audios/".$alert["audio"]) }}');
            audio.play();
            @endif
        </script>
    @elseif($alert["type"] === "info")
        <script>
            iziToast.info({
                timeout: 5000,
                title: '{{ $alert["title"] }}',
                message: '{{ $alert["text"] }}',
                @if(isset($alert["position"]))
                position: '{{ $alert["position"] }}',
                @else
                position: 'topCenter',
                @endif
                color: '#40b9f1'
            })
            @if($alert["audio"])
            var audio = new Audio('{{ uploads_url("audios/".$alert["audio"]) }}');
            audio.play();
            @endif
        </script>
    @else
        <script>
            iziToast.error({
                timeout: 5000,
                title: '{{ $alert["title"] }}',
                message: '{{ $alert["text"] }}',
                @if(isset($alert["position"]))
                position: '{{ $alert["position"] }}',
                @else
                position: 'topCenter',
                @endif
                theme: 'dark',
                color: '#d51818'
            })
            @if($alert["audio"])
            var audio = new Audio('{{ uploads_url("audios/".$alert["audio"]) }}');
            audio.play();
            @endif
        </script>
    @endif
@endif


@if(!empty($welcome_user))
    <script>
        iziToast.info({
            timeout: 5000,
            image: '{{  get_picture("users", $welcome_user["image"]) }}',
            imageWidth: 51,
            title: 'Hoşgeldin',
            message: '<b style="color#FF4EA504">{{ $welcome_user["name"] }}</b> Bu Gün Nasılsın',
            position: 'topRight',
            theme: 'dark',
            color: '#1c1c1c',
            icon: ''
        });
        @if(isset($alert["audio"]))
        var audio = new Audio('{{ uploads_url("audios/".$alert["audio"] ?? 'success.wav') }}');
        audio.play();
        @endif
    </script>
@endif