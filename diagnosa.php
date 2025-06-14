<?php
$gejala = $conn->query("SELECT * FROM gejala");
$gejala_list = [];
while ($row = $gejala->fetch_assoc()) {
  $gejala_list[] = $row;
}
?>

<!-- ✅ STYLE Modern + Fade + Progress Info -->
<style>
  body {
    background-color: #f9fafc;
    font-family: 'Inter', sans-serif;
    color: #2b2b2b;
  }

  .diagnosa-container {
    max-width: 700px;
    margin: 60px auto;
    padding: 40px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.05);
    text-align: center;
  }

  .diagnosa-title {
    font-size: 1.6rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #1a73e8;
  }

  .question {
    font-size: 1.2rem;
    margin: 20px 0;
    transition: all 0.3s ease;
    opacity: 1;
  }

  .question.fade-out {
    opacity: 0;
  }

  .progress-info {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 5px;
  }

  .btn-diagnosa {
    border: none;
    border-radius: 30px;
    padding: 12px 28px;
    font-weight: 500;
    font-size: 1rem;
    margin: 10px 5px;
    transition: all 0.2s ease;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
  }

  .btn-yes {
    background-color: #1a73e8;
    color: white;
  }

  .btn-no {
    background-color: #e0e0e0;
    color: #333;
  }

  .btn-diagnosa:hover {
    transform: scale(1.05);
  }

  .progress-line {
    width: 100%;
    height: 8px;
    background: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    margin-top: 10px;
  }

  .progress-fill {
    height: 100%;
    background: linear-gradient(to right, #4facfe, #00f2fe);
    width: 0%;
    transition: width 0.3s ease;
  }
</style>

<!-- ✅ UI Container -->
<div class="diagnosa-container">
  <div class="diagnosa-title">Konsultasi Tanaman Padi</div>
  
  <div id="progressStatus" class="progress-info">Memuat...</div>
  <div id="question" class="question">Memuat pertanyaan...</div>

  <div>
    <button class="btn-diagnosa btn-yes" onclick="jawab(true)">Ya</button>
    <button class="btn-diagnosa btn-no" onclick="jawab(false)">Tidak</button>
  </div>

  <form id="form-diagnosa" method="POST" action="index.php?page=diagnosa&action=hasil"></form>

  <div class="progress-line mt-4">
    <div id="progressFill" class="progress-fill"></div>
  </div>
</div>

<!-- ✅ SCRIPT: Fade + Indicator -->
<script>
  const gejala = <?= json_encode($gejala_list) ?>;
  let index = 0;

  const form = document.getElementById("form-diagnosa");
  const questionEl = document.getElementById("question");
  const progressFill = document.getElementById("progressFill");
  const progressStatus = document.getElementById("progressStatus");

  function tampilkan() {
    questionEl.classList.add("fade-out");

    setTimeout(() => {
      if (index < gejala.length) {
        // Tampilkan pertanyaan baru
        questionEl.innerHTML = `🌾 Apakah tanaman mengalami:<br><strong>${gejala[index].nmgejala}</strong>`;
        progressStatus.innerText = `Pertanyaan ${index + 1} dari ${gejala.length}`;
        progressFill.style.width = ((index / gejala.length) * 100) + "%";
      } else {
        // Selesai
        questionEl.innerHTML = `<span style="color:#1a73e8;"><strong>Analisa selesai!</strong><br>Mengirim hasil ke sistem...</span>`;
        progressStatus.innerText = ``;
        progressFill.style.width = "100%";
        setTimeout(() => form.submit(), 800);
      }
      questionEl.classList.remove("fade-out");
    }, 200);
  }

  function jawab(isYes) {
    if (isYes) {
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "gejala[]";
      input.value = gejala[index].idgejala;
      form.appendChild(input);
    }
    index++;
    tampilkan();
  }

  // Mulai tampilkan pertama kali
  tampilkan();
</script>
