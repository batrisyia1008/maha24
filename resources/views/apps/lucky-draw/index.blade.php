@extends('layouts.master')

@section('title-mini4wd', 'Lucky Draw')

@push('onpagecss')
    <style>
        body {
            background-image: url({{ asset('assets/images/maha/maha-2024-image-slice-06.png') }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-attachment: scroll;
            min-height: 100vh;
        }
        .button-xxl {
            padding: 1em;
            font-size: 1.25rem;
        }
        .hidden { display: none; }
        .scrolling-animation {
            animation: scroll 2s linear infinite;
        }
        @keyframes scroll {
            from { transform: translateY(100%); }
            to { transform: translateY(-100%); }
        }
        .display-shuffle {
            height:150px;
            font-size: 3em;
            font-weight: 700;
        }
    </style>
@endpush

@push('onpagescript')
<audio id="soundEffect" class="hidden" src="{{ asset('assets/sounds/winner.mp3') }}"></audio>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        function adjustWelcomeBodyHeight() {
            var borderHeight = $('.header-bg-image').height();
            var remToPx = parseFloat(getComputedStyle(document.documentElement).fontSize);
            var additionalHeight = 6 * remToPx;
            $('#lucky-draw-body').css('height', 'calc(100vh - ' + (borderHeight + additionalHeight) + 'px)');
        }

        adjustWelcomeBodyHeight();

        $(window).resize(function() {
            adjustWelcomeBodyHeight();
        });

        const display = document.getElementById('display');
        const startShuffle = document.getElementById('startShuffle');
        const soundEffect = document.getElementById('soundEffect');
        const routeUrl = "{{ route('maha.lucky.draw.name') }}";
        let participantNames = [];
        let shuffleTimeout;
        let soundPlayed = false;

        function fetchNames() {
            return $.get(routeUrl)
                .done(function(data) {
                    participantNames = data.map(item => item.formatted_name);

                    if (participantNames.length > 0) {
                        const randomIndex = Math.floor(Math.random() * participantNames.length);
                        display.innerHTML = participantNames[randomIndex];
                    }
                })
                .fail(function() {
                    Swal.fire('Error', 'Failed to fetch names.', 'error');
                });
        }

        function playSound() {
            if (!soundPlayed) {
                soundEffect.play();
                soundPlayed = true;
            }
        }

        function startShuffling() {
            if (participantNames.length === 0) {
                Swal.fire('Oops...', 'No names to shuffle!', 'info');
                return;
            }

            startShuffle.setAttribute('disabled', true);
            soundPlayed = false; // Reset sound flag for the new shuffle

            fetchNames().then(() => {
                let shuffledNames = shuffleArray(participantNames);
                clearTimeout(shuffleTimeout);

                const startTime = Date.now();
                const maxDuration = 3000; // 1 minute in milliseconds
                let index = 0;

                function updateDisplay() {
                    if (Date.now() - startTime > maxDuration) {
                        display.innerHTML = shuffledNames[0];
                        playSound();
                        startShuffle.removeAttribute('disabled');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Congratulations',
                            text: `'${shuffledNames[0]}'`,
                            showConfirmButton: true,
                            timer: 3000
                        });
                        return;
                    }

                    if (index < shuffledNames.length) {
                        let rand = Math.floor(Math.random() * shuffledNames.length);
                        display.innerHTML = `<span class="scrolling-animation">${shuffledNames[rand]}</span>`;
                        index++;
                        setTimeout(updateDisplay, 100);
                    } else {
                        display.innerHTML = shuffledNames[0];
                        playSound();
                        startShuffle.removeAttribute('disabled');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Congratulations',
                            text: `'${shuffledNames[0]}'`,
                            showConfirmButton: true,
                            timer: 3000
                        });
                    }
                }

                updateDisplay();
            });
        }

        startShuffle.addEventListener('click', function(event) {
            event.preventDefault();
            startShuffling();
        });

        function shuffleArray(array) {
            let shuffledArr = [...array];
            for (let i = shuffledArr.length - 1; i > 0; i--) {
                let rand = Math.floor(Math.random() * (i + 1));
                [shuffledArr[i], shuffledArr[rand]] = [shuffledArr[rand], shuffledArr[i]];
            }
            return shuffledArr;
        }

        fetchNames();
    });
</script>
@endpush

@section('page-minicup')

    <div id="lucky-draw-body" class="container py-sm-4 my-sm-4 py-4 my-4 d-sm-flex d-flex justify-content-center align-items-center">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-3 col-5">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-03.png') }}" alt="" class="img-fluid">
                </div>
            </div>

            <div class="row justify-content-center maha100th-logo">
                <div class="col-md-12 col-12 py-sm-3 my-sm-3 py-3 my-3">
                    <img src="{{ asset('assets/images/maha/maha-2024-image-slice-02.png') }}" alt="" class="img-fluid mx-auto d-block maha100th-logo-img">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 pt-3 mt-3">

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body display-shuffle d-flex justify-content-center align-items-center">
                                    <div id="display"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 my-3"></div>

                    <div class="row justify-content-center">
                        <div class="col-md-12 pt-sm-3 mt-sm-3 pt-3 mt-3 text-center">
                            <a id="startShuffle" href="" class="btn button-xxl px-5 btn-maha-green">SHUFFLE</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

