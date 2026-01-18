<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preferences & Reservation Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Lora:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        :root {
            --bg-dark: #0f1d24;      /* Background paling belakang */
            --card-blue: #1a3a4a;    /* Background form utama */
            --input-deep: #1a4f66;   /* Background kotak input (inset) */
            --accent-gold: #e2c275;  /* Warna emas garis & teks */
            --text-light: #f8dd9d;
            --btn-white: #ffffff;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Lora', serif;
            background-color: var(--bg-dark);
            background-image: linear-gradient(rgba(15, 29, 36, 0.8), rgba(15, 29, 36, 0.8)),
                url('https://media.istockphoto.com/id/1170342049/id/foto/pemandangan-populer-di-meja-makanan-restoran-mewah-dengan-makanan-lezat-makanan-berbaring.jpg?s=612x612&w=0&k=20&c=-DsnPg6I2ciScCM3bkDk671muN3f-BpNkMzr4u8kdRQ='),
                radial-gradient(circle at top right, #1a3a4a 0%, #0c161b 100%);
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            color: var(--text-light);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        /* OUTER FRAME (Kotak di belakang) */
        .outer-frame {
            background-color: #0c161b;
            padding: 12px;
            border: 1px solid rgba(226, 194, 117, 0.2);
            box-shadow: 0 20px 60px rgba(0,0,0,0.7);
            width: 100%;
            max-width: 500px;
            border-radius: 2px;
        }

        /* CONTAINER UTAMA */
        .reservation-container {
            background-color: var(--card-blue);
            border: 4px double var(--accent-gold);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        /* HEADER DENGAN AKSEN SEGITIGA */
        .header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 2px solid var(--accent-gold);
            position: relative;
        }
        .header::before { content: ""; position: absolute; top: 0; left: 0; border-style: solid; border-width: 15px 15px 0 0; border-color: var(--accent-gold) transparent transparent transparent; }
        .header::after { content: ""; position: absolute; top: 0; right: 0; border-style: solid; border-width: 15px 0 0 15px; border-color: var(--accent-gold) transparent transparent transparent; }

        .header h2 { font-family: 'Playfair Display', serif; color: var(--accent-gold); font-size: 1.5rem; }
        .header p { font-size: 0.85rem; color: var(--text-light); opacity: 0.8; margin-top: 5px; }

        .form-content { padding: 25px; }

        /* FORM CARD (Kotak input masuk ke dalam) */
        .form-group-card {
            background-color: var(--input-deep);
            padding: 18px;
            margin-bottom: 20px;
            border-radius: 4px;
            box-shadow: none;
            border: 1px solid rgba(226, 194, 117, 0.5);
        }

        label {
            display: block;
            color: var(--accent-gold);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #2d4a58;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input:focus { outline: none; border-color: var(--accent-gold); box-shadow: 0 0 5px rgba(226, 194, 117, 0.4); }

        .row-group { display: flex; gap: 12px; }
        .col { flex: 1; }

        /* ACTIVITIES SECTION */
        .activity-controls { display: flex; gap: 8px; margin-bottom: 15px; }
        .btn-add {
            background: var(--accent-gold);
            color: var(--bg-dark);
            border: none;
            padding: 0 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .activity-list { list-style: none; margin-bottom: 15px; }
        .activity-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255,255,255,0.05);
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 8px;
            border-left: 3px solid var(--accent-gold);
        }

        .btn-remove { background: none; border: none; color: var(--danger); cursor: pointer; font-size: 1rem; }

        .total-section {
            border-top: 1px solid rgba(226, 194, 117, 0.3);
            padding-top: 15px;
            display: flex;
            justify-content: space-between;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--accent-gold);
        }

        /* FOOTER & TOMBOL */
        .form-footer {
            background-color: var(--input-deep);
            padding: 25px;
            border-top: 4px double var(--accent-gold);
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background-color: var(--btn-white);
            color: var(--bg-dark);
            border: none;
            border-radius: 4px;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover { background-color: var(--accent-gold); }

        /* VALIDASI ERROR */
        .error-msg { color: var(--danger); font-size: 0.75rem; margin-top: 5px; display: none; }
        .input-error { border: 2px solid var(--danger) !important; }

        /* MODAL */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.85); display: flex; justify-content: center; align-items: center;
            z-index: 1000; opacity: 0; visibility: hidden; transition: 0.3s;
        }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal {
            background: var(--card-blue); padding: 40px; border: 2px solid var(--accent-gold);
            text-align: center; border-radius: 2px; max-width: 400px;
        }
    </style>
</head>
<body>

<div class="outer-frame">
    <div class="reservation-container">
        <header class="header">
            <h2>Preferences & Reservation</h2>
            <p>Lengkapi detail di bawah ini untuk memesan.</p>
        </header>

        <form id="reservationForm">
            @csrf
            <input type="hidden" name="activities_data" id="activitiesDataInput">

            <div class="form-content">
                <div class="form-group-card">
                    <label>Name under reservation:</label>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap" required />
                    <div class="error-msg" id="error-name">Nama wajib diisi.</div>
                </div>

                <div class="form-group-card">
                    <div class="row-group">
                        <div class="col">
                            <label>Date of Service:</label>
                            <input type="date" name="date" required />
                            <div class="error-msg" id="error-date">Pilih tanggal.</div>
                        </div>
                        <div class="col">
                            <label>Time:</label>
                            <input type="time" name="time" required />
                            <div class="error-msg" id="error-time">Pilih waktu.</div>
                        </div>
                    </div>
                </div>

                <div class="form-group-card">
                    <label>Occasion Type:</label>
                    <select name="occasion" required>
                        <option value="" disabled selected>Pilih jenis acara</option>
                        <option value="birthday">Birthday</option>
                        <option value="anniversary">Anniversary</option>
                        <option value="business">Business Meeting</option>
                        <option value="casual">Casual Dining</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="error-msg" id="error-occasion">Pilih jenis acara.</div>
                </div>

                <div class="form-group-card">
                    <label>Event Location:</label>
                    <input type="text" name="location" placeholder="Contoh: Main Hall, Private Room A" required />
                    <div class="error-msg" id="error-location">Lokasi wajib diisi.</div>
                </div>

                <div class="form-group-card">
                    <label>Special Notes / Comments:</label>
                    <textarea name="notes" placeholder="Contoh: Alergi makanan, permintaan posisi meja, atau ucapan selamat ulang tahun..." rows="3"
                    style="width: 100%; padding: 12px; border: 1px solid #2d4a58; border-radius: 4px; background-color: #fff; color: #333; font-family: 'Lora', serif; font-size: 0.95rem; resize: vertical;"></textarea>
                </div>

                <div class="form-group-card">
                    <label>Activities:</label>
                    <div class="activity-controls">
                        <select id="activitySelect" style="flex: 2;">
                            <option value="0" disabled selected>Pilih Aktivitas</option>
                            <option value="75000">Decoration - Rp 75.000</option>
                            <option value="100000">Buffet Extra - Rp 100.000</option>
                            <option value="150000">Live Music - Rp 150.000</option>
                            <option value="300000">Private Room - Rp 300.000</option>
                            <option value="500000">Dinner Package - Rp 500.000</option>
                        </select>
                        <input type="number" id="activityQty" value="1" min="1" style="flex: 0.5;">
                        <button type="button" class="btn-add" id="btnAddActivity"><i class="fas fa-plus"></i></button>
                    </div>

                    <ul class="activity-list" id="activityList">
                        <li id="emptyMsg" style="text-align: center; opacity: 0.5; font-size: 0.8rem;">Belum ada aktivitas dipilih.</li>
                    </ul>

                    <div class="total-section">
                        <span>Total</span>
                        <span id="grandTotal">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit" id="submitBtn">Confirm Reservation</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="successModal">
    <div class="modal">
        <i class="fas fa-check-circle" style="font-size: 4rem; color: var(--accent-gold); margin-bottom: 20px;"></i>
        <h3 style="color: var(--accent-gold);">Reservasi Berhasil!</h3>
        <p style="margin: 20px 0;">Detail reservasi Anda telah kami terima. Kami akan menghubungi Anda segera untuk konfirmasi akhir.</p>
        <button class="btn-submit" style="font-size: 1.1rem; padding: 10px;" onclick="location.reload()">Selesai</button>
    </div>
</div>

<script>
    const STORE_URL = "{{ route('reservation.store') }}";
    
    const state = {
        activities: [],
        formatter: new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 })
    };

    // DOM Elements
    const btnAdd = document.getElementById("btnAddActivity");
    const activitySelect = document.getElementById("activitySelect");
    const activityQty = document.getElementById("activityQty");
    const activityList = document.getElementById("activityList");
    const emptyMsg = document.getElementById("emptyMsg");
    const grandTotalEl = document.getElementById("grandTotal");
    const form = document.getElementById("reservationForm");
    const modal = document.getElementById("successModal");
    const submitBtn = document.getElementById("submitBtn");
    const activitiesDataInput = document.getElementById("activitiesDataInput");

    // FUNGSI ADD ACTIVITY
    btnAdd.addEventListener("click", () => {
        const price = parseInt(activitySelect.value);
        const nameText = activitySelect.options[activitySelect.selectedIndex].text;
        const qty = parseInt(activityQty.value);

        if (price === 0) return alert("Pilih aktivitas!");

        state.activities.push({
            id: Date.now(),
            name: nameText.split(" - ")[0],
            price: price,
            qty: qty,
            total: price * qty
        });

        renderActivities();
    });

    function removeActivity(id) {
        state.activities = state.activities.filter(a => a.id !== id);
        renderActivities();
    }

    function renderActivities() {
        activityList.innerHTML = "";
        let currentTotal = 0;

        if (state.activities.length === 0) {
            activityList.innerHTML = '<li id="emptyMsg" style="text-align: center; opacity: 0.5; font-size: 0.8rem;">Belum ada aktivitas dipilih.</li>';
        } else {
            state.activities.forEach(item => {
                currentTotal += item.total;
                const li = document.createElement("li");
                li.className = "activity-item";
                li.innerHTML = `
                    <div>
                        <div style="font-weight: 500;">${item.name}</div>
                        <div style="font-size: 0.75rem; opacity: 0.7;">${item.qty} x ${state.formatter.format(item.price)}</div>
                    </div>
                    <div style="display:flex; align-items:center; gap:15px;">
                        <span style="font-weight:600; color:var(--accent-gold);">${state.formatter.format(item.total)}</span>
                        <button type="button" class="btn-remove" onclick="removeActivity(${item.id})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                activityList.appendChild(li);
            });
        }
        grandTotalEl.textContent = state.formatter.format(currentTotal);
        document.getElementById("activitiesDataInput").value = JSON.stringify(state.activities);
    }

    // FUNGSI SUBMIT DENGAN VALIDASI LARAVEL
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        if (state.activities.length === 0) {
            alert("Mohon tambahkan minimal satu aktivitas.");
            return;
        }

        // Reset UI
        submitBtn.innerText = "Memproses...";
        submitBtn.disabled = true;
        document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
        document.querySelectorAll('input, select').forEach(el => el.classList.remove('input-error'));

        try {
            const formData = new FormData(form);
            const response = await fetch(STORE_URL, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();

            if (!response.ok) {
                if (result.errors) {
                    for (const [field, messages] of Object.entries(result.errors)) {
                        const input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('input-error');
                            const errDiv = input.parentElement.querySelector('.error-msg') || input.closest('.form-group-card').querySelector('.error-msg');
                            if (errDiv) {
                                errDiv.innerText = messages[0];
                                errDiv.style.display = 'block';
                            }
                        }
                    }
                }
            } else {
                document.getElementById("successModal").classList.add("active");
                form.reset();
            }
        } catch (error) {
            alert("Gagal mengirim data.");
        } finally {
            submitBtn.innerText = "Confirm Reservation";
            submitBtn.disabled = false;
        }
    });
</script>
</body>
</html>