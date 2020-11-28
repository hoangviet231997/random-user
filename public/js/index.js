function random(max, min) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function setTimePrizeFirst() {
    let time_prize_1 = document.getElementById('time_prize_1').value;
    time_prize_1 = moment(time_prize_1).format('YYYY-MM-DD HH:mm');

    axios.post('/prizes', { prize: 1, date: time_prize_1 }).then((res) => {
        console.log(res);
        window.location.reload();
    }).catch((err) => {
        console.error(err);
    });
}

function setTimePrizeRunnerUp() {
    let time_prize_2 = document.getElementById('time_prize_2').value;
    time_prize_2 = moment(time_prize_2).format('YYYY-MM-DD HH:mm');

    axios.post('/prizes', { prize: 2, date: time_prize_2 }).then((res) => {
        console.log(res);

        window.location.reload();
    }).catch((err) => {
        console.error(err);
    });
}

function setTimePrizeConsolation() {
    let time_prize_3 = document.getElementById('time_prize_3').value;
    time_prize_3 = moment(time_prize_3).format('YYYY-MM-DD HH:mm');

    axios.post('/prizes', { prize: 3, date: time_prize_3 }).then((res) => {
        console.log(res);
        window.location.reload();
    }).catch((err) => {
        console.error(err);
    });
}
