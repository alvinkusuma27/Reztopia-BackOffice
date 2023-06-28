<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <style>
        body{
            background:#F6FBFD;

        }

        .navbar{
            background-color: #FFF;
        }

        .sidebar {
          background-color: #FFF;
          width: 110px;
          height: 100vh;
            box-shadow: 6px 8px 14px 0px rgba(192, 192, 192, 0.12);
            position: fixed;
            display: flex;
            align-items: center;
        }

        .icon{
            margin:auto;
        }

        .logo {
          background-color: #007bff;
          height: 80px;
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .logout{
            position: fixed;
            bottom: 0;
            margin-left:10px;
            margin-bottom:50px;
        }

        .logo img {
          width: 60px;
          height: 60px;
          object-fit: cover;
        }

        .container{
            margin-top:120px;
            margin-left:140px;
            margin-right:140px;
         
        }

        .navbar-brand img{
            margin-left: 50px;
        }
        
        .card{
          width: 374px;

        }
        .name{
          color: #272727; 
          font-size: 20px; 
     
          font-weight: 600; l
          ine-height: 20px; 
          word-wrap: break-word
        }
        .table-cust{
          color: #272727; 
          font-size: 16px; 
  
          font-weight: 500; 
          line-height: 20px; 
          word-wrap: break-word
        }

        .time{
          margin-top:2px;
          text-align: center;
          color: white;
          font-size: 16px;
          padding-top: 3px;
        }

        .confirm-btn button{
          border:none;
          background:none;
          color:white;
        }
        .confirm-btn{
          text-align: center;
          padding-top:3px;
          border-radius: 3px;
        }
        .time{
          width: 63px; 
          height: 30px; 
          background: #6597BF; 
          border-radius: 15px
        }
        
        .total{
          color: #272727; 
          font-size: 16px; 
          font-weight: 500; 
          line-height: 20px; 
          word-wrap: break-word
        }

        .name-food{
          color: #272727; 
          font-size: 20px; 
          font-weight: 600; 
          line-height: 20px; 
          word-wrap: break-word
        }

        .desc-food{
          color: #272727; 
          font-size: 14px; 
          font-weight: 400; 
          line-height: 20px;
          word-wrap: break-word
        }

        .icon a{
          text-decoration: none;
        }


    </style>
</head>
<body>

<nav class="navbar fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="https://i.ibb.co/KKRc356/rp-horiz-3.png" alt="Bootstrap" width="131" height="38">
    </a>
  </div>
</nav>

<div class="container-fluid">
    <div class="row">
      <div class="col-3 sidebar">
        <div class="icon">
        <div class="stock text-center">
                <a href="" style="color:#C6D9E8">
                <svg width="57" height="57" viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="material-symbols:food-bank-rounded">
                    <path id="Vector" d="M14.25 50.4099C12.9437 50.4099 11.8259 49.9452 10.8965 49.0158C9.9655 48.0848 9.5 46.9662 9.5 45.6599V24.2849C9.5 23.5328 9.66862 22.8203 10.0059 22.1474C10.3415 21.4745 10.8063 20.9203 11.4 20.4849L25.65 9.79741C26.4813 9.16408 27.4312 8.84741 28.5 8.84741C29.5688 8.84741 30.5187 9.16408 31.35 9.79741L45.6 20.4849C46.1938 20.9203 46.6592 21.4745 46.9965 22.1474C47.3322 22.8203 47.5 23.5328 47.5 24.2849V45.6599C47.5 46.9662 47.0353 48.0848 46.1059 49.0158C45.1749 49.9452 44.0563 50.4099 42.75 50.4099H14.25ZM23.75 33.7849V42.0974C23.75 42.4141 23.8687 42.6912 24.1062 42.9287C24.3437 43.1662 24.6208 43.2849 24.9375 43.2849C25.2542 43.2849 25.5312 43.1662 25.7688 42.9287C26.0063 42.6912 26.125 42.4141 26.125 42.0974V33.7849C27.1146 33.7849 27.9553 33.4382 28.6473 32.7447C29.3407 32.0527 29.6875 31.212 29.6875 30.2224V24.2849C29.6875 23.9682 29.5688 23.6912 29.3313 23.4537C29.0938 23.2162 28.8167 23.0974 28.5 23.0974C28.1833 23.0974 27.9062 23.2162 27.6687 23.4537C27.4312 23.6912 27.3125 23.9682 27.3125 24.2849V30.2224H26.125V24.2849C26.125 23.9682 26.0063 23.6912 25.7688 23.4537C25.5312 23.2162 25.2542 23.0974 24.9375 23.0974C24.6208 23.0974 24.3437 23.2162 24.1062 23.4537C23.8687 23.6912 23.75 23.9682 23.75 24.2849V30.2224H22.5625V24.2849C22.5625 23.9682 22.4438 23.6912 22.2063 23.4537C21.9688 23.2162 21.6917 23.0974 21.375 23.0974C21.0583 23.0974 20.7812 23.2162 20.5437 23.4537C20.3062 23.6912 20.1875 23.9682 20.1875 24.2849V30.2224C20.1875 31.212 20.5342 32.0527 21.2277 32.7447C21.9197 33.4382 22.7604 33.7849 23.75 33.7849ZM34.4375 43.2849C34.7542 43.2849 35.0312 43.1662 35.2688 42.9287C35.5063 42.6912 35.625 42.4141 35.625 42.0974V24.5224C35.625 24.2057 35.5063 23.9287 35.2688 23.6912C35.0312 23.4537 34.7542 23.3349 34.4375 23.3349C33.3292 23.3349 32.4583 23.7901 31.825 24.7005C31.1917 25.611 30.875 26.6599 30.875 27.8474V33.7849C30.875 34.1016 30.9937 34.3787 31.2312 34.6162C31.4688 34.8537 31.7458 34.9724 32.0625 34.9724H33.25V42.0974C33.25 42.4141 33.3687 42.6912 33.6062 42.9287C33.8438 43.1662 34.1208 43.2849 34.4375 43.2849Z" fill="#C6D9E8"/>
                    </g>
                </svg>
                Terima
                </a>
          </div>
          <div class="detail text-center mt-3">
                <a href="/pesanan" style="color:#6597BF">
                <svg width="57" height="57" viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="material-symbols:checklist-rtl-rounded">
                    <path id="Vector" d="M7.125 21.9099C6.45208 21.9099 5.88842 21.6819 5.434 21.2259C4.978 20.7715 4.75 20.2078 4.75 19.5349C4.75 18.862 4.978 18.2975 5.434 17.8415C5.88842 17.3871 6.45208 17.1599 7.125 17.1599H23.75C24.4229 17.1599 24.9874 17.3871 25.4434 17.8415C25.8978 18.2975 26.125 18.862 26.125 19.5349C26.125 20.2078 25.8978 20.7715 25.4434 21.2259C24.9874 21.6819 24.4229 21.9099 23.75 21.9099H7.125ZM7.125 40.9099C6.45208 40.9099 5.88842 40.6819 5.434 40.2259C4.978 39.7715 4.75 39.2078 4.75 38.5349C4.75 37.862 4.978 37.2975 5.434 36.8415C5.88842 36.3871 6.45208 36.1599 7.125 36.1599H23.75C24.4229 36.1599 24.9874 36.3871 25.4434 36.8415C25.8978 37.2975 26.125 37.862 26.125 38.5349C26.125 39.2078 25.8978 39.7715 25.4434 40.2259C24.9874 40.6819 24.4229 40.9099 23.75 40.9099H7.125ZM37.2281 24.9974L32.1219 19.8912C31.6865 19.4558 31.4688 18.9016 31.4688 18.2287C31.4688 17.5558 31.6865 17.0016 32.1219 16.5662C32.5573 16.1308 33.1115 15.913 33.7844 15.913C34.4573 15.913 35.0115 16.1308 35.4469 16.5662L38.8312 19.9505L47.2625 11.5193C47.7375 11.0443 48.2917 10.8163 48.925 10.8353C49.5583 10.8559 50.1125 11.1037 50.5875 11.5787C51.0229 12.0537 51.2406 12.6078 51.2406 13.2412C51.2406 13.8745 51.0229 14.4287 50.5875 14.9037L40.5531 24.9974C40.0781 25.4724 39.524 25.7099 38.8906 25.7099C38.2573 25.7099 37.7031 25.4724 37.2281 24.9974ZM37.2281 43.9974L32.1219 38.8912C31.6865 38.4558 31.4688 37.9016 31.4688 37.2287C31.4688 36.5558 31.6865 36.0016 32.1219 35.5662C32.5573 35.1308 33.1115 34.913 33.7844 34.913C34.4573 34.913 35.0115 35.1308 35.4469 35.5662L38.8312 38.9505L47.2625 30.5193C47.7375 30.0443 48.2917 29.8163 48.925 29.8353C49.5583 29.8559 50.1125 30.1037 50.5875 30.5787C51.0229 31.0537 51.2406 31.6078 51.2406 32.2412C51.2406 32.8745 51.0229 33.4287 50.5875 33.9037L40.5531 43.9974C40.0781 44.4724 39.524 44.7099 38.8906 44.7099C38.2573 44.7099 37.7031 44.4724 37.2281 43.9974Z" fill="#6597BF"/>
                    </g>
                 </svg>
                 Detail
                </a>
          </div>
          <div class="history text-center mt-3">
                <a href="/history" style="color:#C6D9E8">
                <svg width="57" height="57" viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="ic:round-history">
                    <path id="Vector" d="M31.4925 7.6599C19.4038 7.3274 9.50001 17.0412 9.50001 29.0349H5.24876C4.18001 29.0349 3.65751 30.3174 4.41751 31.0537L11.0438 37.7036C11.5188 38.1786 12.255 38.1786 12.73 37.7036L19.3563 31.0537C19.5204 30.8862 19.6313 30.674 19.6749 30.4436C19.7186 30.2133 19.6931 29.9751 19.6017 29.7593C19.5103 29.5434 19.357 29.3594 19.1611 29.2305C18.9653 29.1016 18.7357 29.0335 18.5013 29.0349H14.25C14.25 19.7724 21.8025 12.2912 31.1125 12.4099C39.9475 12.5287 47.3813 19.9624 47.5 28.7974C47.6188 38.0837 40.1375 45.6599 30.875 45.6599C27.0513 45.6599 23.5125 44.3537 20.71 42.1449C20.2551 41.7865 19.6844 41.6079 19.1063 41.6429C18.5283 41.678 17.9833 41.9242 17.575 42.3349C16.5775 43.3324 16.6488 45.0187 17.765 45.8736C21.4964 48.8245 26.1178 50.4236 30.875 50.4099C42.8688 50.4099 52.5825 40.5061 52.25 28.4174C51.9413 17.2787 42.6313 7.96865 31.4925 7.6599ZM30.2813 19.5349C29.3075 19.5349 28.5 20.3424 28.5 21.3161V30.0562C28.5 30.8874 28.9513 31.6712 29.6638 32.0987L37.0738 36.4924C37.9288 36.9912 39.0213 36.7062 39.52 35.8749C40.0188 35.0199 39.7338 33.9274 38.9025 33.4287L32.0625 29.3674V21.2924C32.0625 20.3424 31.255 19.5349 30.2813 19.5349Z" fill="#C6D9E8"/>
                    </g>
                </svg>
                Riwayat
                </a>
          </div>
          <div class="logout">
               <a href="">
               <svg width="57" height="58" viewBox="0 0 57 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="LogOut">
                    <g id="Group">
                    <path id="Vector" fill-rule="evenodd" clip-rule="evenodd" d="M24.0777 4.84554C25.1415 4.52642 26.2652 4.4604 27.359 4.65276C28.4529 4.84512 29.4866 5.29053 30.3777 5.95343C31.2688 6.61633 31.9926 7.47836 32.4913 8.47072C32.99 9.46309 33.2498 10.5583 33.25 11.6689V46.4009C33.2498 47.5115 32.99 48.6067 32.4913 49.5991C31.9926 50.5915 31.2688 51.4535 30.3777 52.1164C29.4866 52.7793 28.4529 53.2247 27.359 53.4171C26.2652 53.6094 25.1415 53.5434 24.0777 53.2243L9.82775 48.9493C8.36024 48.5091 7.07372 47.6075 6.15904 46.3784C5.24437 45.1493 4.75025 43.658 4.75 42.1259V15.9439C4.75025 14.4118 5.24437 12.9206 6.15904 11.6914C7.07372 10.4623 8.36024 9.56077 9.82775 9.12054L24.0777 4.84554ZM35.625 10.0349C35.625 9.40503 35.8752 8.80093 36.3206 8.35554C36.766 7.91014 37.3701 7.65991 38 7.65991H45.125C47.0147 7.65991 48.8269 8.41058 50.1631 9.74678C51.4993 11.083 52.25 12.8952 52.25 14.7849V17.1599C52.25 17.7898 51.9998 18.3939 51.5544 18.8393C51.109 19.2847 50.5049 19.5349 49.875 19.5349C49.2451 19.5349 48.641 19.2847 48.1956 18.8393C47.7502 18.3939 47.5 17.7898 47.5 17.1599V14.7849C47.5 14.155 47.2498 13.5509 46.8044 13.1055C46.359 12.6601 45.7549 12.4099 45.125 12.4099H38C37.3701 12.4099 36.766 12.1597 36.3206 11.7143C35.8752 11.2689 35.625 10.6648 35.625 10.0349ZM49.875 38.5349C50.5049 38.5349 51.109 38.7851 51.5544 39.2305C51.9998 39.6759 52.25 40.28 52.25 40.9099V43.2849C52.25 45.1746 51.4993 46.9869 50.1631 48.3231C48.8269 49.6592 47.0147 50.4099 45.125 50.4099H38C37.3701 50.4099 36.766 50.1597 36.3206 49.7143C35.8752 49.2689 35.625 48.6648 35.625 48.0349C35.625 47.405 35.8752 46.8009 36.3206 46.3555C36.766 45.9101 37.3701 45.6599 38 45.6599H45.125C45.7549 45.6599 46.359 45.4097 46.8044 44.9643C47.2498 44.5189 47.5 43.9148 47.5 43.2849V40.9099C47.5 40.28 47.7502 39.6759 48.1956 39.2305C48.641 38.7851 49.2451 38.5349 49.875 38.5349ZM21.375 26.6599C20.7451 26.6599 20.141 26.9101 19.6956 27.3555C19.2502 27.8009 19 28.405 19 29.0349C19 29.6648 19.2502 30.2689 19.6956 30.7143C20.141 31.1597 20.7451 31.4099 21.375 31.4099H21.3774C22.0073 31.4099 22.6114 31.1597 23.0568 30.7143C23.5022 30.2689 23.7524 29.6648 23.7524 29.0349C23.7524 28.405 23.5022 27.8009 23.0568 27.3555C22.6114 26.9101 22.0073 26.6599 21.3774 26.6599H21.375Z" fill="#FC6262"/>
                    <path id="Vector_2" d="M38 29.0349H49.875M49.875 29.0349L45.125 24.2849M49.875 29.0349L45.125 33.7849" stroke="#FC6262" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    </g>
                 </svg>
               </a>
          </div>
        </div>
      </div>
      <div class="col-9">
        <!-- Konten halaman -->
        <div class="container">
        <div class="card-container d-flex gap-3" id="card-container">
          <div class="card" id="card-0">
            <div class="card-body">
              <div class="head d-flex justify-content-between">
                <div class="customer">
                  <div class="name">
                    Arief
                  </div>
                  <div class="table-cust">
                    Meja: 3
                  </div>
                </div>
                <div class="confirm d-flex gap-4">
                  <div class="time" id="time-0">
                    <span id="minutes-0">00</span>:<span id="seconds-0">00</span>
                  </div>
                  <div class="confirm-btn" style="width: 109px; height: 34px; background: #00FB0A" data-card-index="0">
                    <form action="/pesanan" method="post">
                    @csrf
                      <button type="button">
                        Konfirmasi
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="Rectangle20 mt-3 mb-3" style="width: 100%; height: 4px; background: #6597BF"></div>
              <div class="menu-list d-flex gap-3">
                <div class="total">
                  1
                </div>
                <div class="food">
                  <div class="name-food">
                    Vanilla Ice cream
                  </div>
                  <div class="desc-food">
                    Cone all
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card" id="card-1">
            <div class="card-body">
              <div class="head d-flex justify-content-between">
                <div class="customer">
                  <div class="name">
                    Waluyo
                  </div>
                  <div class="table-cust">
                    Meja: 4
                  </div>
                </div>
                <div class="confirm d-flex gap-4">
                  <div class="time" id="time-1">
                    <span id="minutes-1">00</span>:<span id="seconds-1">00</span>
                  </div>
                  <div class="confirm-btn" style="width: 109px; height: 34px; background: #00FB0A" data-card-index="1">
                    <form action="/pesanan" method="post">
                      @csrf
                      <button type="button">
                        Konfirmasi
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="Rectangle20 mt-3 mb-3" style="width: 100%; height: 4px; background: #6597BF"></div>
              <div class="menu-list d-flex gap-3">
                <div class="total">
                  1
                </div>
                <div class="food">
                  <div class="name-food">
                    Vanilla Ice cream
                  </div>
                  <div class="desc-food">
                    Cone all
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body>

<script>

window.onload = function() {
  var cardCount = 2; // Jumlah card yang ada
  var intervals = []; // Array untuk menyimpan interval timers

  function startTimer(index) {
    var storedTime = localStorage.getItem(`card-${index}`);
    var seconds = 0;
    var minutes = 0;
    var appendMinutes = document.getElementById(`minutes-${index}`);
    var appendSeconds = document.getElementById(`seconds-${index}`);
    var timeDiv = document.getElementById(`time-${index}`);
    var interval;

    if (storedTime) {
      var timeData = JSON.parse(storedTime);
      minutes = timeData.minutes;
      seconds = timeData.seconds;
      appendMinutes.textContent = minutes < 10 ? "0" + minutes : minutes;
      appendSeconds.textContent = seconds <= 9 ? "0" + seconds : seconds;
    }

    function updateTimer() {
      seconds++;
      if (seconds <= 9) {
        appendSeconds.textContent = "0" + seconds;
      } else {
        appendSeconds.textContent = seconds;
      }
      if (seconds > 59) {
        minutes++;
        appendMinutes.textContent = minutes < 10 ? "0" + minutes : minutes;
        seconds = 0;
        appendSeconds.textContent = "00";
      }
      if (seconds > 1800) {
        timeDiv.style.backgroundColor = "#FF0707";
      }

      // Simpan data waktu ke penyimpanan browser
      var timeData = {
        minutes: minutes,
        seconds: seconds
      };
      localStorage.setItem(`card-${index}`, JSON.stringify(timeData));
    }

    interval = setInterval(updateTimer, 1000);
    intervals.push(interval); // Tambahkan interval ke array intervals
  }

  // Tambahkan event listener pada tombol "Konfirmasi" di setiap card
  var confirmButtons = document.getElementsByClassName("confirm-btn");
  for (var i = 0; i < confirmButtons.length; i++) {
    confirmButtons[i].addEventListener("click", function() {
      var cardIndex = this.dataset.cardIndex;
      console.log("Konfirmasi card dengan index:", cardIndex);
      // Lakukan tindakan yang diinginkan saat tombol "Konfirmasi" ditekan

      // Hapus kartu saat tombol "Konfirmasi" ditekan
      document.getElementById(`card-${cardIndex}`).remove();
      // remove local storage
      // for (var i = 0; i < cardCount; i++) {
      //   localStorage.removeItem(`card-${i}`);
      // }
      clearInterval(intervals[cardIndex]); // Hentikan perhitungan waktu dengan menghapus interval yang sesuai dari array intervals
    });
  }

  // Saat halaman dimuat, cek penyimpanan browser untuk mengatur ulang timer
  for (var i = 0; i < cardCount; i++) {
    startTimer(i);
  }
};

</script>

</html>