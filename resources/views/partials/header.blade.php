<div style="width: 100%; height: 4em; display: flex; align-items: center; justify-content: center;">
  <span id="cd-days">00</span>:
  <span id="cd-hours">00</span>:
  <span id="cd-minutes">00</span>:
  <span id="cd-seconds">00</span>
</div>

<script>
  let timer = function(date) {
    if (!date) {
      document.getElementById('cd-days').innerHTML = "00";
      document.getElementById('cd-hours').innerHTML = "00";
      document.getElementById('cd-minutes').innerHTML = "00";
      document.getElementById('cd-seconds').innerHTML = "00";
      return;
    }

    let timer = Math.round(new Date(date).getTime() / 1000) - Math.round(new Date().getTime() / 1000);
    let minutes, seconds;
    setInterval(function() {
      if (--timer < 0) {
        timer = 0;
      }
      days = parseInt(timer / 60 / 60 / 24, 10);
      hours = parseInt((timer / 60 / 60) % 24, 10);
      minutes = parseInt((timer / 60) % 60, 10);
      seconds = parseInt(timer % 60, 10);
      days = days < 10 ? "0" + days : days;
      hours = hours < 10 ? "0" + hours : hours;
      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;
      document.getElementById('cd-days').innerHTML = days;
      document.getElementById('cd-hours').innerHTML = hours;
      document.getElementById('cd-minutes').innerHTML = minutes;
      document.getElementById('cd-seconds').innerHTML = seconds;
    }, 1000);
  }

  async function getData() {
    try {
      const res = await fetch('/api/timer');
      const json = await res.json();

      if (!json || !json.created_at) {
        timer(null);
        return;
      }


      const deadline = new Date(json.created_at);
      deadline.setDate(deadline.getDate() + 7);

      timer(deadline);
    } catch (error) {
      console.log(error)
    }
  }

  getData()

</script>
