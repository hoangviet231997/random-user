<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Winning lottery program</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid mt-5">
        @yield('content')
    </div>
    <div id="loading">
    </div>
    {{-- <div class="modal fade" id="giainhat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="w-100" src="/img/gioi-thieu-xe-mercedes-c200-exclusive.jpg" alt="">
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        function showLoading() {
            let loading = document.getElementById('loading');
            loading.style.display = 'block';
        }

        function hideLoading() {
            let loading = document.getElementById('loading');
            loading.style.display = 'none';
        }

        hideLoading();

        function playAudio() {
            document.getElementById("myAudio").play();
        }

        function pauseAudio() {
            document.getElementById("myAudio").pause();
        }

    </script>

    <script>
        var user = [];
        axios.get('/users').then((res) => {
            user = res.data;
        }).catch((err) => {});

        setInterval(() => {
            axios.get('/users').then((res) => {
                user = res.data;
            }).catch((err) => {});
        }, 2500);

        let userPrize = [];
        setInterval(() => {
            axios.get('/get-user-prize').then((res) => {
                userPrize = res.data;
            }).catch((err) => {});
        }, 2500);

        setInterval(() => {
            axios.get('/get-all-user-prize').then((res) => {
                console.log('data_prize');
                let data = res.data;
                let tr = '';
                data.map((e, i) => {
                    tr += `
                            <tr>
                                <td>${i + 1}</td>
                                <td>${e.code}</td>
                                <td>${e.username}</td>
                                <td>${e.prize_name}</td>
                            </tr>
                        `;
                });
                $('#user_lucky').html(tr);
            }).catch((err) => {
                console.error(err);
            });
        }, 2500);

        let date_prize_1 = "<?php echo $date_prize_1[0]->date_start; ?>";
        let date_prize_2 = "<?php echo $date_prize_2[0]->date_start; ?>";
        let date_prize_3 = "<?php echo $date_prize_3[0]->date_start; ?>";

        let arr = [];
        var ran_num;

        function randomNumber() {
            ran_num = setInterval(() => {
                let now = moment().format('YYYY-MM-DD HH:mm');
                let index = random(99, 00);

                if (now >= date_prize_1 && userPrize.first.length < 1) {
                    console.log(1);
                    document.getElementById("random").innerHTML = user[index].code;
                } else if (now >= date_prize_2 && userPrize.runner_up.length < 2) {
                    console.log(2);
                    document.getElementById("random").innerHTML = user[index].code;
                } else if (now >= date_prize_3 && userPrize.consolation.length < 10) {
                    console.log(3);
                    document.getElementById("random").innerHTML = user[index].code;
                } else if (userPrize.first.length > 0 && userPrize.runner_up.length > 1 && userPrize.consolation.length > 9) {
                    console.log(4);
                    for (let i = 0; i < arr.length; i++) {
                        clearInterval(arr[i]);
                    }
                    document.getElementById("random").innerHTML = '000000';
                }
            }, 300);
            arr.push(ran_num);
        }

        randomNumber();

        var ran_prize_1 = setInterval(() => {
            let now = moment().format('YYYY-MM-DD HH:mm');
            let date_prize_1 = "<?php echo $date_prize_1[0]->date_start; ?>";
            let id_prize_1 = "<?php echo $date_prize_1[0]->id; ?>";

            var index = random(99, 00);
            var code = user[index].code;
            var nameUser = user[index].username;

            if (now >= date_prize_1) {
                console.log('now >= date_prize_1');

                if (userPrize.first.length > 0) {
                    console.log('userPrize.first clear');
                    clearInterval(ran_prize_1);
                    clearInterval(ran_num);
                    document.getElementById("random").innerHTML = '000000';
                }

                document.getElementById("name_prize").innerHTML = 'First Prize';
                axios.post('/users', {
                    code: code,
                    prize_id: id_prize_1
                }).then(function(response) {
                    console.log('prize_1 save ok');
                }).catch(function(error) {
                    console.log(error);
                });
            }

        }, 10000);

        randomNumber();

        var ran_prize_2 = setInterval(() => {
            let now = moment().format('YYYY-MM-DD HH:mm');
            let date_prize_2 = "<?php echo $date_prize_2[0]->date_start; ?>";
            let id_prize_2 = "<?php echo $date_prize_2[0]->id; ?>";

            var index = random(99, 00);
            var code = user[index].code;
            var nameUser = user[index].username;

            if (now >= date_prize_2) {
                console.log('now >= date_prize_2');
                if (userPrize.runner_up.length > 1) {
                    console.log('userPrize.runner_up clear');
                    clearInterval(ran_prize_2);
                    clearInterval(ran_num);
                    document.getElementById("random").innerHTML = '000000';
                }

                document.getElementById("name_prize").innerHTML = 'Runner Up Prize';
                axios.post('/users', {
                    code: code,
                    prize_id: id_prize_2
                }).then(function(response) {
                    console.log('prize_2 ok');
                }).catch(function(error) {
                    console.log(error);
                });
            }


        }, 10000);

        var ran_prize_3 = setInterval(() => {
            let now = moment().format('YYYY-MM-DD HH:mm');
            let date_prize_3 = "<?php echo $date_prize_3[0]->date_start; ?>";
            let id_prize_3 = "<?php echo $date_prize_3[0]->id; ?>";

            var index = random(99, 00);
            var code = user[index].code;
            var nameUser = user[index].username;

            if (now >= date_prize_3) {
                console.log('now >= date_prize_3');

                if (userPrize.consolation.length > 9) {
                    console.log('userPrize.consolation clear');
                    clearInterval(ran_prize_3);
                    clearInterval(ran_num);
                    document.getElementById("random").innerHTML = '000000';
                }

                document.getElementById("name_prize").innerHTML = 'Consolation Prize';
                axios.post('/users', {
                    code: code,
                    prize_id: id_prize_3
                }).then(function(response) {
                    console.log('prize_3 ok');
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }, 10000);

    </script>
</body>

</html>
